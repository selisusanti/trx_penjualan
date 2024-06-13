<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuplierController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->group( function () {
    Route::get('products', [ProductController::class, 'store']);

    Route::prefix('supliers')->group(function(){
        Route::get('/', [SuplierController::class, 'index']);
        Route::post('/', [SuplierController::class, 'store']);
        Route::put('/{supliers}', [SuplierController::class, 'update']);
        Route::delete('/{supliers}', [SuplierController::class, 'delete']);
        Route::post('/import', [SuplierController::class, 'import']);
    });
});

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
