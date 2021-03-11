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

/*$redis = Redis::connection("cache");

  $redis->set('test12344555', 'Taylor test test12344555');

if($redis->get("test12344555")){
$name = $redis->get('test12344555');

  return $name;
}else{
  return "not found";
}*/
session(['key12' => 'value']);
session()->forget("key12");
$data = session()->all();
     return view("welcome");
});

Auth::routes();
Route::get("addpost",[App\Http\Controllers\PostController::class, 'add_posts']);
Route::get("getPosts",[App\Http\Controllers\PostController::class, 'getPosts']);
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