<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ApisController; 

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('login',[ApisController::class,'login']);
Route::middleware('auth:api')->get("getdata",[ApisController::class, 'index']);
Route::post("register",[ApisController::class, 'register']);
Route::post("login",[ApisController::class, 'login']);
