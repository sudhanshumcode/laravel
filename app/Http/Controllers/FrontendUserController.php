<?php

namespace App\Http\Controllers;
use  App\Http\Controllers\CityController;
use  App\Http\Controllers\StateController;
use  App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Usermeta;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

use Validator;

class FrontendUserController extends Controller
{
    //private $city;
    
    public function __constructor(){
     
    }
public function UserRegister(Request $req){

   
    
    $validator=Validator::make($req->all(),[
        'name'=>"required",
        'email'=>"required|unique:users|email",
        'password'=>"required",
        'state'=>"required",
        'city'=>"required",
        'country' =>"required"
    ]);
    if($validator->fails()){
        return response()->json(["err"=>$validator->errors()],202);
    }
    $data=$req->all();
    $user['name']=$data['name'];
    $user['password']=bcrypt($data['password']);
    $user['email']=$data['email'];
    $user =User::create($user);
    $user_meta['user_id']=$user->id;
    $user_meta['country']=$data['country'];
    $user_meta['state']=$data['state'];
     $user_meta['city']=$data['city'];
    $usermeta=Usermeta::create($user_meta);
    

    return response()->json(["status"=>"Login"],200);
}
public function userLogin(Request $req){
    $validator=Validator::make($req->all(),[
        "email"=>"required",
        "password"=>"required"
    ]);
    if($validator->fails()){
        return response()->json($validator->errors(),202);
    }
    if(Auth::attempt(["email"=>$req->email,"password"=>$req->password])){
               $user=Auth::User();
               $res["token"]=$user->createToken("MyApp")->accessToken;;
               $cid=DB::table("oauth_access_tokens")->where("user_id",$user->id)->get("id");
                $res["client-screct-id"]=$cid[0]->id;
				$current_date_time = Carbon::now()->toDateTimeString();
				
                $res["status"]="Login Successfully";
        return response()->json($res,200);
    }else{
        return response()->json(["status"=>"Invalid Details"],201);
    }
}
public function UserDetails($id){

    $user=User::find($id);

    $usermeta=Usermeta::where("user_id","=",$id)->get();
    $cityobj=new CityController();
    $stateobj=new StateController();
    $countryobj=new CountryController();

    
    $city_id=$usermeta[0]['city'];
    $state_id=$usermeta[0]['state'];
    $country_id=$usermeta[0]['country'];

   
    $city_name=$cityobj->getCityDetailsById($city_id,['name']);
    $country_name=$countryobj->getCountryDetailsById($country_id,['name']);
    $state_name=$stateobj->getStateDetailsById($state_id,['name']);

    

    $usermeta[0]["city_name"]=$city_name;
    $usermeta[0]["country_name"]=$country_name;
   $usermeta[0]["state_name"]=$state_name;


   return response()->json(["user"=>$user,"usermeta"=>$usermeta],200);  
}
public function updateUserData($id,Request $request){
    
    $validator=Validator::Make($request->all(),[
        'name' =>"required",
        "email"=>"required",
        "state_id"=>"required",
        "country_id"=>"required",
        "city_id"=>"required"
    ]);

    if($validator->fails()){
        return response()->json($validator->errors(),202);
    }

    $data=$request->all();
    $user=User::find($id);
    $userdata['name']=$data['name'];
    $userdata['email']=$data['email'];
    $user->update($userdata);
    $usermeta['state']=$data['state_id'];
    $usermeta['city']=$data['city_id'];
    $usermeta['country']=$data['country_id'];


   $usermeta= Usermeta::where("user_id","=",$id)->update($usermeta);
    
   $usermeta= Usermeta::where("user_id","=",$id)->get();
   return response()->json(['user'=>$user,"usermeta"=>$usermeta],200);
}

}

?>