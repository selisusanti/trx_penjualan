<?php

namespace App\Services;

use App\Services\Implemen\TransactionServiceImpl;
use App\Exceptions\ApplicationException;
use App\Models\Transaction;
use App\Models\Product;
use App\Http\Helpers\EventLog;
use DB;


class TransactionService implements TransactionServiceImpl{

    public function index($tanggal,$product){
        $data = Transaction::query()
                ->with(['product'])
                ->when($tanggal, function ($q) use ($tanggal) {
                    $q->where('transaction_date', $tanggal);
                })
                ->when($product, function ($q) use ($product) {
                    $q->where('product_id', $product);
                })->paginate();
        return $data;
    }

    public function penjualan($request){
        $data_product      = Product::where('id',$request['product_id'])->first();

        if (empty($data_product)){
            throw new ApplicationException("errors.entity_not_found", ['entity' => 'Suplier', 'id' => $request['product_id']]);
        }
        elseif($data_product->stock < $request['quantity']){
            throw new ApplicationException("errors.stock_not_enough", ['entity' => 'Product', 'id' => $request['product_id']]);
        }else{
            DB::beginTransaction();
            try {
                $sisa_stok      = $data_product->stock - $request['quantity'];
                $update_user    = $data_product->update([
                        'stock'=> $sisa_stok,
                ]); 

                $save           = Transaction::with(['product'])->create([
                    'quantity'=> $request['quantity'],
                    'product_id'=> $request['product_id'],
                    'users_id'=> auth()->user()->id,
                    'transaction_date'=> now(),
                ]);


                $dataraw = '';
                $reason  = 'Transaksi penjualan';
                $trxid   = $save->id;
                $model   = 'penjualan';
                EventLog::insertLog($trxid, $reason, $dataraw,$model);
                DB::commit();
                return $save;
            } catch (Exception $e) {
                DB::rollBack();
                throw new ApplicationException("error.gagal_save_penjualan");
            }

        }
    }

    public function report($request){
        $tanggal            = $request['tanggal_transaksi'];
        $product            = $request['product_id'];
        $data = Transaction::query()
                ->with(['product'])
                ->when($tanggal, function ($q) use ($tanggal) {
                    $q->where('transaction_date', $tanggal);
                })
                ->when($product, function ($q) use ($product) {
                    $q->where('product_id', $product);
                })
                ->get();
        return $data;
    }
}
