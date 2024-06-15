<?php

namespace App\Services;

use App\Services\Implemen\TransactionServiceImpl;
use App\Exceptions\ApplicationException;
use App\Models\Transaction;
use App\Models\Product;
use DB;


class TransactionService implements TransactionServiceImpl{


    public function index(){
        $data = Transaction::query()->with(['product'])->paginate();
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
                DB::commit();
                return $save;
            } catch (Exception $e) {
                DB::rollBack();
                throw new ApplicationException("error.gagal_save_penjualan");
            }

        }
    }
}
