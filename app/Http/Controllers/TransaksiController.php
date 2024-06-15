<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionPenjualanRequest;
use App\Services\Response;
use App\Services\TransactionService;
use App\Exceptions\ApplicationException;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenjualanExport;

class TransaksiController extends Controller
{

    private $transactionService;
    public function __construct(){
        $this->transactionService = new TransactionService();
    }

    public function index(Request $request)
    {
        //Query param
        $tanggal            = $request->tanggal_transaksi;
        $product            = $request->product_id;
        $user               = $this->transactionService->index($tanggal,$product);
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

    public function download(Request $request)
    {
        $data               = $this->transactionService->report($request);
        return Excel::download(new PenjualanExport($data), 'report-penjualan-'.$request->tanggal_transaksi.'-'.$request->product_id.'.xls');
    }


}
