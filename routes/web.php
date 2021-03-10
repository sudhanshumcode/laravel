<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
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
  //$redis=Redis::make("redis");
 // $redis = Redis::connection(6379)->publish('test-channel', json_encode(['foo' => 'bar']));

$redis = Redis::connection("cache");

  $redis->set('test123', 'Taylor test');

if($redis->get("test123")){
$name = $redis->get('test123');

  return $name;
}else{
  return "not found";
}
    // view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('setLocale:en')->name('home');
Route::get('login',[ApisController::class,'login']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth:api')->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("sendMail",function(){
    //Mail::to("sudhanshu.mcodeinfosoft@gmail.com")->Send(new sendMail()); 
    $details['email'] = 'sudhanshu.mcodeinfosoft@gmail.com';
  
    dispatch(new SendEmailJob($details))->delay(Carbon::now()->addSeconds(5));
  
  //  dd('done');
    return "mail sent ";
});

Route::group(['prefix' => 'user',"middleware"=>"auth:api"], function() {
  Route::get('/', function() {
      return response()->json(request()->user());
  });
});