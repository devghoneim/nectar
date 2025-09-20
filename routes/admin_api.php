<?php

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\AreaController;
use App\Http\Controllers\Api\Admin\BannerController;
use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\LabelController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SubCategoryController;
use App\Http\Controllers\Api\Admin\ZoneController;
use Illuminate\Support\Facades\Route;










Route::middleware(['auth:sanctum','role:owner|admin','set.locale'])->group(function (){

  Route::get('/',[AdminController::class , 'index'])->name('admin.index');

    Route::prefix('zone')->group(function (){
        Route::get('/',[ZoneController::class,'index']);
        Route::post('/',[ZoneController::class,'store']);
        Route::get('/{id}',[ZoneController::class,'edit']);
        Route::put('/{id}',[ZoneController::class,'update']);
        Route::delete('/{id}',[ZoneController::class,'delete']);

    });

    
      Route::prefix('area')->group(function (){
        Route::get('/',[AreaController::class,'index']);
        Route::post('/',[AreaController::class,'store']);
        Route::get('/{id}',[AreaController::class,'edit']);
        Route::put('/{id}',[AreaController::class,'update']);
        Route::delete('/{id}',[AreaController::class,'delete']);

    });
  
    Route::prefix('brand')->group(function (){
        Route::get('/',[BrandController::class,'index']);
        Route::post('/',[BrandController::class,'store']);
        Route::get('/{id}',[BrandController::class,'edit']);
        Route::put('/{id}',[BrandController::class,'update']);
        Route::delete('/{id}',[BrandController::class,'delete']);

    });

      Route::prefix('category')->group(function (){
        Route::get('/',[CategoryController::class,'index']);
        Route::post('/',[CategoryController::class,'store']);
        Route::get('/{id}',[CategoryController::class,'edit']);
        Route::put('/{id}',[CategoryController::class,'update']);
        Route::delete('/{id}',[CategoryController::class,'delete']);

    });


       Route::prefix('sub-category')->group(function (){
        Route::get('/',[SubCategoryController::class,'index']);
        Route::post('/',[SubCategoryController::class,'store']);
        Route::get('/{id}',[SubCategoryController::class,'edit']);
        Route::put('/{id}',[SubCategoryController::class,'update']);
        Route::delete('/{id}',[SubCategoryController::class,'delete']);

    });


     Route::prefix('banner')->group(function (){
        Route::get('/',[BannerController::class,'index']);
        Route::post('/',[BannerController::class,'store']);
        Route::get('/{id}',[BannerController::class,'edit']);
        Route::put('/{id}',[BannerController::class,'update']);
        Route::delete('/{id}',[BannerController::class,'delete']);

    });

     Route::prefix('label')->group(function (){
        Route::get('/',[LabelController::class,'index']);
        Route::post('/',[LabelController::class,'store']);
        Route::get('/{id}',[LabelController::class,'edit']);
        Route::put('/{id}',[LabelController::class,'update']);
        Route::delete('/{id}',[LabelController::class,'delete']);

    });

      Route::prefix('product')->group(function (){
        Route::get('/',[ProductController::class,'index']);
        Route::post('/',[ProductController::class,'store']);
        Route::get('/{id}',[ProductController::class,'show']);  
        Route::put('/{id}',[ProductController::class,'update']);
        Route::delete('/{id}',[ProductController::class,'delete']);

    });








    





});