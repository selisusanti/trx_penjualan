<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use App\Services\Response;
use App\Services\UserStageServices;
use App\Services\ProductServices;
use App\Exceptions\ApplicationException;
use DB;

class AuthController extends Controller
{

    private $userStageServices;
    private $productServices;
    public function __construct(){
        $this->userStageServices = new UserStageServices();
        $this->productServices = new ProductServices();
    }

    public function register(UserStoreRequest $request)
    {
        // DB::beginTransaction();
        // try {
        //     $input              = $request->all();
        //     $input['password']  = bcrypt($input['password']);
        //     $user               = $this->userStageServices->save($input);
        //     $success['token']   = $user->createToken('MyApp')->plainTextToken;
        //     $success['data']    = $user;

        //     // $product            = $this->productServices->save($input);
        //     DB::commit();
        //     return Response::success($success,'Sukses Simpan Data');
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     throw new ApplicationException("user.failure_save_user");
        // }
        throw new ApplicationException("user.failure_save_user");

    }


}
