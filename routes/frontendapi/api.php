<?php
use App\Http\Controllers\CityController; 
use App\Http\Controllers\CountryController; 
use App\Http\Controllers\StateController;
use App\Http\Controllers\FrontendUserController;
use App\Http\Controllers\ArticleController;

Route::group(['prefix'=>"frontendapi"],function(){

    Route::get("getCitesByStateId/{id}",[CityController::class,'getCitesByStateId']);
    Route::get("getCitesByCountryId/{id}",[CityController::class,'getCitesByCountryId']);
    Route::get("getallcountry",[CountryController::class,'getAllCountry']);
    Route::get("getallcountry/{id}",[CountryController::class,'getAllCountryDetailById']);
    Route::get("getStateBycountryId/{id}",[StateController::class,'getStateBycountryId']);
    Route::get("getStateDetails/{id}",[StateController::class,'getStateDetails']);
    Route::post("register",[FrontendUserController::class,'UserRegister']);
    Route::post("login",[FrontendUserController::class,'UserLogin']);
    
    Route::group(["middleware"=>["admin.auth","auth:api"]],function(){
        Route::get('article',[ArticleController::class,'index']);
        Route::get('article/{id}',[ArticleController::class,'show']);
        Route::post('article',[ArticleController::class,'create']);
        Route::put('article/{id}',[ArticleController::class,'update']);
        Route::delete('article/{id}',[ArticleController::class,'destroy']);
        Route::get("getUserDetails/{id}",[FrontendUserController::class,'UserDetails']);
         Route::post("updateUserDetails/{id}",[FrontendUserController::class,'updateUserData']);
    });
    
    
    
});

?>