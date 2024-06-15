<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionPenjualanRequest;
use App\Services\Response;
use App\Services\TransactionService;
use App\Exceptions\ApplicationException;
use DB;

class TransaksiController extends Controller
{

    private $transactionService;
    public function __construct(){
        $this->transactionService = new TransactionService();
    }

    public function index()
    {
        $user        = $this->transactionService->index();
        return Response::success($user,'Sukses ambil data');
    }

    public function penjualan(TransactionPenjualanRequest $request)
    {
        try {
            $input       = $request->all();
            $data        = $this->transactionService->penjualan($input);
            return Response::success($data,'Sukses simpan data penjualan');
        } catch (Exception $e) {
            throw new ApplicationException("user.failure_save_user");
        }
    }


}
