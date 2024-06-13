<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductSaveRequest;
use App\Services\Response;
use App\Services\ProductServices;
use App\Exceptions\ApplicationException;
use DB;

class ProductController extends Controller
{

    private $productServices;
    public function __construct(){
        $this->productServices = new ProductServices();
    }

    public function store(ProductSaveRequest $request)
    {

        return "ok";

    }


}
