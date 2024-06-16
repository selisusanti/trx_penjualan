<?php

namespace App\Services;

use App\Services\Implemen\ProductServicesImpl;
use App\Exceptions\ApplicationException;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;


class ProductServices implements ProductServicesImpl{

    public function index(){
        $data = Product::query()->paginate();
        return $data;
    }

    public function save($input){

        if($input->hasFile('picture'))
        {
            $path = Storage::putFile("/public/images/produk", $input->file('picture'));
        }else{
            $path = "";
        }

        $save               = Product::create([
            'code'=> $input['code'],
            'product_name'=> $input['product_name'],
            'description'=> $input['description'],
            'price'=> $input['price'],
            'stock'=> $input['stock'],
            'picture'=> $path,
            'insert_by'=> auth()->user()->id,
            'suplier_id'=> $input['suplier_id'],
        ]);

        return $save;
    }

    public function detail($id){
        $save               = Product::with(['insert_by','suplier'])->findOrFail($id);
        return $save;
    }
    
    public function update($request, $id){
        $Product      = Product::where('id',$id)->first();
        if (empty($Product)){
            throw new ApplicationException("errors.entity_not_found", ['entity' => 'Product', 'id' => $id]);
        }else{
            if($request->hasFile('picture'))
            {
                $path = Storage::putFile("/public/images/produk", $request->file('picture'));
                $Product->update([
                    'picture'=> $path,
                ]); 
            }
            $update_user = $Product->update([
                'code'=> $request['code'],
                'product_name'=> $request['product_name'],
                'description'=> $request['description'],
                'price'=> $request['price'],
                'stock'=> $request['stock'],
                'suplier_id'=> $request['suplier_id'],
            ]); 
            return Product::with(['insert_by','suplier'])->findOrFail($id);
        }
    }

    public function delete($id){
        $transaction  = Transaction::where('product_id',$id)
                        ->first();
        if(!empty($transaction)){
            throw new ApplicationException("errors.delete_product", ['entity' => 'Product', 'id' => $id]);
        }

        $Product      = Product::where('id',$id)->first();
        if (empty($Product)){
            throw new ApplicationException("errors.entity_not_found", ['entity' => 'Product', 'id' => $id]);
        }else{
            $delete       = $Product->delete();
            return $delete;
        }
    }

}
