<?php

use App\Http\Controllers\Api\Admin\BrandController;
use Illuminate\Support\Facades\Route;










Route::middleware(['auth:sanctum','role:owner|admin','set.locale'])->group(function (){
    Route::get('/',[BrandController::class,'getAll']);
     Route::post('/create',[BrandController::class,'create']);

});