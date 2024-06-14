<?php

namespace App\Services;

use App\Services\Implemen\ProductServicesImpl;
use App\Exceptions\ApplicationException;
use App\Models\Product;


class ProductServices implements ProductServicesImpl{

    public function index(){
        $data = Product::query()->paginate();
        return $data;
    }

    public function save($input){
        $save               = Product::create([
            'code'=> $input['code'],
            'product_name'=> $input['product_name'],
            'description'=> $input['description'],
            'price'=> $input['price'],
            'stock'=> $input['stock'],
            'picture'=> $input['picture'] ?? '',
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
            $update_user = $Product->update([
                'code'=> $request['code'],
                'product_name'=> $request['product_name'],
                'description'=> $request['description'],
                'price'=> $request['price'],
                'stock'=> $request['stock'],
                'picture'=> $request['picture'] ?? '',
                'suplier_id'=> $request['suplier_id'],
            ]); 
            return Product::with(['insert_by','suplier'])->findOrFail($id);
        }
    }

    public function delete($id){
        $Product      = Product::where('id',$id)->first();
        if (empty($Product)){
            throw new ApplicationException("errors.entity_not_found", ['entity' => 'Product', 'id' => $id]);
        }else{
            $delete       = $Product->delete();
            return $delete;
        }
    }

}
