<?php

use App\Http\Controllers\Api\Admin\ZoneController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Location\LocationController;
use Illuminate\Support\Facades\Route;


//Auth
Route::post('/register',[AuthController::class,'register']);
Route::post('/verify',[AuthController::class,'verify']);
Route::post('/send-code',[AuthController::class,'sendCode']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/rest-password',[AuthController::class,'restPassword']);
//End Auth


//  Route::get('/user', function (Request $request) {
//         return $request->user();
//     })->middleware('auth:sanctum');


  Route::prefix('zone')->group(function(){
        Route::post('create',[ZoneController::class,'createZone']);
    });






    Route::get('get-zone',[ZoneController::class,'getAllZones']);

Route::middleware(['set.local','auth:sanctum'])->group(function(){
    


  
    // Route::get('all-zone',[LocationController::class,'']);

});

