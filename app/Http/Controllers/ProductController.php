<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductSaveRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ImportSuplierRequest;
use App\Services\Response;
use App\Services\ProductServices;
use App\Exceptions\ApplicationException;
use DB;
use App\Services\SuplierServices;
use App\Models\Suplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    
    private $productServices;
    public function __construct(){
        $this->productServices = new ProductServices();
    }

    public function index()
    {
        $data        = $this->productServices->index();
        return Response::success($data,'Sukses ambil data');
    }

    public function store(ProductSaveRequest $request)
    {

        DB::beginTransaction();
        try {
            $input              = $request->all();
            $user               = $this->productServices->save($input);
            DB::commit();
            return Response::success($user,'Sukses Simpan Data');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("eror disini");
            throw new ApplicationException("user.failure_save_user");
        }

    }

    public function detail($id)
    {
        DB::beginTransaction();
        try {
            $user               = $this->productServices->detail($id);
            return Response::success($user,'Sukses get detail data');
        } catch (Exception $e) {
            throw new ApplicationException("user.failure_save_user");
        }
    }


    public function update(ProductUpdateRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $user               = $this->productServices->update($request, $id);
            DB::commit();
            return Response::success($user,'Sukses Update Data');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("eror disini");
            throw new ApplicationException("user.failure_save_user");
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user               = $this->productServices->delete($id);
            DB::commit();
            return Response::success($user,'Sukses delete data');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("eror disini");
            throw new ApplicationException("user.failure_save_user");
        }
    }

    public function import(ImportSuplierRequest $request)
    {
        try {
            $save = Excel::import(new ProductImport,$request->file('file'));
            return Response::success($save,'Import Data Success');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return Response::error($failures);
        }
    }

}
