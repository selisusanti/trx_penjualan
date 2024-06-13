<?php

namespace App\Services\Implemen;


interface SuplierServicesImpl{

    public function index();
    public function save($input);
    public function update($request, $id);
    public function delete($data);
     
}
