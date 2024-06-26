<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SuplierSaveRequest;
use App\Http\Requests\SuplierUpdateRequest;
use App\Http\Requests\ImportSuplierRequest;
use App\Services\Response;
use App\Services\SuplierServices;
use App\Exceptions\ApplicationException;
use App\Models\Suplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SuplierImport;
use DB;

class SuplierController extends Controller
{

    private $suplierServices;
    public function __construct(){
        $this->suplierServices = new SuplierServices();
    }

    public function index()
    {

        $user        = $this->suplierServices->index();
        return Response::success($user,'Sukses ambil data');

    }

    public function detail($id)
    {
        DB::beginTransaction();
        try {
            $user               = $this->suplierServices->detail($id);
            return Response::success($user,'Sukses get detail data');
        } catch (Exception $e) {
            throw new ApplicationException("user.failure_save_user");
        }
    }

    public function store(SuplierSaveRequest $request)
    {

        DB::beginTransaction();
        try {
            $input              = $request->all();
            $user               = $this->suplierServices->save($input);
            DB::commit();
            return Response::success($user,'Sukses Simpan Data');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("eror disini");
            throw new ApplicationException("user.failure_save_user");
        }

    }


    public function update(SuplierUpdateRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $user               = $this->suplierServices->update($request, $id);
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
            $user               = $this->suplierServices->delete($id);
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
            $save = Excel::import(new SuplierImport,$request->file('file'));
            return Response::success($save,'Import Data Success');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return Response::error($failures);
        }
    }



}
