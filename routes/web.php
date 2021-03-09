<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
/*  
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('setLocale:en')->name('home');
Route::get('login',[ApisController::class,'login']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("sendMail",function(){
    //Mail::to("sudhanshu.mcodeinfosoft@gmail.com")->Send(new sendMail()); 
    $details['email'] = 'sudhanshu.mcodeinfosoft@gmail.com';
  
    dispatch(new SendEmailJob($details))->delay(Carbon::now()->addSeconds(5));
  
  //  dd('done');
    return "mail sent ";
});