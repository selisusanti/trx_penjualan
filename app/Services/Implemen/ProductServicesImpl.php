<?php

namespace App\Services\Implemen;


interface ProductServicesImpl{

    public function index();
    public function save($data);
    public function detail($id);
    public function update($request, $id);
    public function delete($id);
     
}
