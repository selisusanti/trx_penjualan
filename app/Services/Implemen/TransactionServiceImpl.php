<?php

namespace App\Services\Implemen;


interface TransactionServiceImpl{

    public function index($tanggal,$product);
    public function penjualan($data);
    public function report($request);
     
}
