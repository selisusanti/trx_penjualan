<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\LoginRequest;
use App\Services\Response;
use App\Services\UserStageServices;
use App\Exceptions\ApplicationException;
use DB;

class AuthController extends Controller
{

    private $userStageServices;
    public function __construct(){
        $this->userStageServices = new UserStageServices();
    }

    public function register(UserStoreRequest $request)
    {

        DB::beginTransaction();
        try {
            $input              = $request->all();
            $input['password']  = bcrypt($input['password']);
            $user               = $this->userStageServices->save($input);
            $success['token']   = $user->createToken('MyApp')->plainTextToken;
            $success['data']    = $user;
            DB::commit();
            return Response::success($success,'Sukses Simpan Data');
        } catch (Exception $e) {
            DB::rollBack();
            throw new ApplicationException("user.failure_save_user");
        }

    }


    public function login(LoginRequest $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name']  =  $user;
            return Response::success($success,'Login Success');
        } 
        else{ 
            return Response::error('Check Email dan Password!');
        } 

    }


}
