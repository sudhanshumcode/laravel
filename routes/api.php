<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ApisController; 
use App\Http\Controllers\ArticleController; 
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

Route::middleware('auth:api')->get("getdata",[ApisController::class, 'index']);
Route::post("register",[ApisController::class, 'register']);
Route::post("login",[ApisController::class, 'login']);
Route::get('login',[ApisController::class,'login']);
Route::get('getPosts',[ApisController::class,'getPosts'])->middleware('web');
Route::get('article',[ArticleController::class,'index']);
Route::get('article/{id}',[ArticleController::class,'show']);
Route::post('article',[ArticleController::class,'create']);
Route::put('article/{id}',[ArticleController::class,'update']);
Route::delete('article/{id}',[ArticleController::class,'destroy']);




