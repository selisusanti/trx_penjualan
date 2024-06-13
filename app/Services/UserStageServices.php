<?php

namespace App\Services;

use App\Services\Implemen\UserStageServicesImpl;
use App\Models\User;


class UserStageServices implements UserStageServicesImpl{


    public function save($input){
        $user               = User::create($input);
        return $user;
    }

}
