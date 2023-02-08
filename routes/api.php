<?php

use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\StoreController;

use App\Http\Controllers\Fruit\IndexController;

use App\Http\Controllers\User\GetUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/* ----------------------- JWT ----------------------- */


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group(['namespace' => 'Fruit', 'prefix' => 'fruits'], function () {
            Route::get('/', [IndexController::class, 'index']);
        }
        );
       
    });
    
});

/* ----------------------- --- ----------------------- */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['namespace' => 'User' , 'prefix' => 'users'], function (){
        Route::post('/', [StoreController::class,'store']);
        Route::post('/getuser', [GetUserController::class, 'index']);
});

