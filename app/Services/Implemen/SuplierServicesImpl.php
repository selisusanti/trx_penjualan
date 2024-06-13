<?php

namespace App\Services\Implemen;


interface SuplierServicesImpl{

    public function index();
    public function save($input);
    public function detail($id);
    public function update($request, $id);
    public function delete($data);
     
}
