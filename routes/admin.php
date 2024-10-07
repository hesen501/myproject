<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::post('login' ,[LoginController::class,'login']);

//Route::middleware('admin')->group(function (){
    Route::apiResource('cities' ,CityController::class);
//});
