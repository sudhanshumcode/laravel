<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Redis;
use Validator;
use Carbon\Carbon;
use \App\Models\Posts;

class ApisController extends Controller
{
	public function index(){
		return ["staus"=>"sss"];
	}
   
	public function register(Request $request){
			
			
			$validator=Validator::make($request->all(),[
				"name" =>"required",
				"email" => "required|email",
				'password' =>"required",
				'c_password' =>"required",
			]);
			if($validator->fails()){
					return response()->json($validator->errors(),202);
			}
			
			$userdata=$request->all();
			$userdata['password']=bcrypt($userdata['password']);
			$user=User::create($userdata);
			$res["name"]=$user->name;
			
			$res["token"]=$user->createToken("MyApp")->accessToken;
			$redis = Redis::connection("cache");
			$redis->set($user->id, $res["token"]);

			return response()->json($res,200);
	}
	
	public function login(Request $request){
		if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
			$user=Auth::user();
			$res["name"]=$user->name;
			$redis = Redis::connection("cache");
			//$res["token"]=$user->createToken("MyApp")->accessToken;
		
			
		
			if($redis->get($user->id)){
				if($user->tokenExpired()){
					$res["token"]=$user->createToken("MyApp")->accessToken;;
					$redis->set($user->id, $res["token"]);
	
			$current_date_time = Carbon::now()->toDateTimeString();
			$user->update(array("token_expire_at"=>$current_date_time));

				}else{
					$res["token"]=$redis->get($user->id);
				}
			}else{
				$res["token"]=$user->createToken("MyApp")->accessToken;;
				$redis->set($user->id, $res["token"]);

				$current_date_time = Carbon::now()->toDateTimeString();
				$user->update(array("token_expire_at"=>$current_date_time));
			}
			//$res["token"]=$user->createToken("MyApp")->accessToken;;
/*$objToken = $user->createToken('MyApp');

$res["token"] = $objToken->accessToken;
$redis->set($user->id, $res["token"]);
$res["expiration"] = $objToken->token->expires_at->diffInSeconds(Carbon::now());
*/
			return response()->json($res,200);
			
		}else{
			return response()->json(['error'=>'Unauthenticated'],203);
		}
	}

	public function getPosts(){
        
		$posts= DB::table('posts')->get();
/*$post=Posts::Find("3");
		$post->post_title="new qwe 123";
		$post->save();
		*/
		 return ["post"=>$posts,"hhh"=>'re']; 
	 }
}
