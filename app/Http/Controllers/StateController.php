<?php

namespace App\Http\Controllers;

use App\Models\state;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function getStateByCountryId($id){
        $state=State::where("country_id","=","$id")->get(["id","name"]);
        return response()->json(['state'=>$state,"status"=>"200"]);
    }
    public function getStateDetails($id){
        $state=State::where("id","=","$id")->get();
        return response()->json(['state'=>$state,"status"=>"200"]);
    }
    public function getStateDetailsById($id,$arr=[]){
        $getCol='*';
       
        if($arr){
          $getCol=$arr;
        }
        $state=State::where("id","=","$id")->get($getCol);
      
        if(isset($arr) && count($arr)==1){
          $state=$state[0][$arr[0]];
        }else{
          $state=$state[0];
        }
        
        return $state;
      }
}
