<?php

namespace App\Services;

use App\Services\Implemen\SuplierServicesImpl;
use App\Exceptions\ApplicationException;
use App\Models\Suplier;


class SuplierServices implements SuplierServicesImpl{

      public function index(){
         $data = Suplier::query()->paginate();
         return $data;
      }

      public function save($input){
         $save               = Suplier::create($input);
         return $save;
      }

      public function detail($id){
         $save               = Suplier::findOrFail($id);
         return $save;
      }

      public function update($request, $id){
         $suplier      = Suplier::where('id',$id)->first();
         if (empty($suplier)){
            throw new ApplicationException("errors.entity_not_found", ['entity' => 'Suplier', 'id' => $id]);
         }else{
            $update_user = $suplier->update([
               'supplier_code'=> $request->supplier_code,
               'name'=> $request->name,
               'address'=> $request->address,
               'pic'=> $request->pic,
               'phone_number'=> $request->phone_number,
               'npwp'=> $request->npwp,
            ]); 
            return Suplier::findOrFail($id);
         }
      }

      public function delete($id){
         $suplier      = Suplier::where('id',$id)->first();
         if (empty($suplier)){
            throw new ApplicationException("errors.entity_not_found", ['entity' => 'Suplier', 'id' => $id]);
         }else{
            $delete       = $suplier->delete();
            return $delete;
         }
      }
}
