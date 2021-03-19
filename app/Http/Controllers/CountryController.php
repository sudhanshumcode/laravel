<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
class CountryController extends Controller
{
   public function getAllCountry(){
        //$country=Country::get(["id",'name']);
        $country=DB::table("countries")
                ->join("cities","cities.country_id","=","countries.id")
                ->distinct()
                ->get(["countries.id",'countries.name']);
    return response()->json(["country"=>$country,"status"=>"200"]);
   }
   public function getAllCountryDetailById($id){
    $country=Country::where("id",'=',"$id")->get();
    return response()->json(["country"=>$country,"status"=>"200"]);
    }
    public function getCountryDetailsById($id,$arr=[]){
        $getCol='*';
       
        if($arr){
          $getCol=$arr;
        }
        $country=Country::where("id","=","$id")->get($getCol);
      
        if(isset($arr) && count($arr)==1){
          $country=$country[0][$arr[0]];
        }else{
          $country=$country[0];
        }
        
        return $country;
      }
}
