<?php

namespace App\Services;

use App\Services\Implemen\ProductServicesImpl;
use App\Models\Product;


class ProductServices implements ProductServicesImpl{


    public function save($input){
        $save               = Product::create($input);
        return $save;
    }

}
