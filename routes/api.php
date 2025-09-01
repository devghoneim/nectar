<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register',[AuthController::class,'register']);
Route::post('/verify',[AuthController::class,'verify']);
Route::post('/send-code',[AuthController::class,'sendCode']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/rest-password',[AuthController::class,'restPassword']);


Route::middleware('set.local')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

});

