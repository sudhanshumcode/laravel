<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
  public function getCitesByStateId($id){
      $cites=City::where("state_id","=","$id")->get(['id','name']);
      return response()->json(['cites'=>$cites,"status"=>200]);
  }

  public function getCitesByCountryId($id){
    $cites=City::where("country_id","=","$id")->get(['id', 'name']);
    return response()->json(['cites'=>$cites,"status"=>200]);
  }
  public function getCityDetailsById($id, $arr=[]){
    $getCol='*';
   
    if($arr){
      $getCol=$arr;
    }
    $cites=City::where("id","=","$id")->get($getCol);
  
    if(isset($arr) && count($arr)==1){
      $cites=$cites[0][$arr[0]];
    }else{
      $cites=$cites[0];
    }
    
    return $cites;
  }
}
