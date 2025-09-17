<?php

use App\Http\Controllers\Api\Admin\AreaController;
use App\Http\Controllers\Api\Admin\ZoneController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\LocationController;
use App\Http\Controllers\Public\ExploreController;
use App\Http\Controllers\Public\FilterController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;




//Auth
Route::post('/register',[AuthController::class,'register']);
Route::post('/verify',[AuthController::class,'verify']);
Route::post('/send-code',[AuthController::class,'sendCode']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/rest-password',[AuthController::class,'restPassword']);
//End Auth



Route::middleware(['set.locale','auth:sanctum'])->group(function(){
    
        Route::get('/',[ZoneController::class,'index'])->prefix('zone');
        Route::post('/',[ZoneController::class,'areaByZone'])->prefix('zone');



    Route::get('/',[HomeController::class,'index']);
    Route::get('/{id}',[HomeController::class,'product'])->where('id','[0-9]+');
    Route::get('/{name}',[HomeController::class,'search'])->where('name','[\p{Arabic}a-zA-Z\- ]+');   
    Route::post('/',[HomeController::class,'productBySearch']);   

    Route::prefix('location')->group(function (){
        Route::get('/',[LocationController::class,'index']);
        Route::post('/',[LocationController::class,'store']);
        Route::get('/{id}',[LocationController::class,'edit']);
        Route::put('/{id}',[LocationController::class,'update']);
        Route::delete('/{id}',[LocationController::class,'delete']);

    });

     Route::prefix('explore')->group(function (){
        Route::get('/',[ExploreController::class,'index']);
        Route::get('/{id}',[ExploreController::class,'productsByCategoryId'])->where('id','[0-9]+');
        Route::get('/{name}',[ExploreController::class,'findCategoryByName'])->where('name','[\p{Arabic}a-zA-Z\- ]+');   
    });

        Route::prefix('filter')->group(function (){
        Route::get('/',[FilterController::class,'index']);
        Route::post('/',[FilterController::class,'product']);
        
    });







    





  

});

