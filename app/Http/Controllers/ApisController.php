<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Redis;
use Validator;

class ApisController extends Controller
{
	public function index(){
		return ["staus"=>"sss"];
	}
   
	public function register(Request $request){
			
			$validator=Validator::make($request->all(),[
				"name" =>"required",
				"email" => "required|email|user.email",
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
			return response()->json($res,200);
	}
	
	public function login(Request $request){
		if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
			$user=Auth::user();
			$res["name"]=$user->name;
			$res["token"]=$user->createToken("MyApp")->accessToken;
			return response()->json($res,200);
			
		}else{
			return response()->json(['error'=>'Unauthenticated'],203);
		}
	}
}
