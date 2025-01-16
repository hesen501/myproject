<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ParcelController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\TariffController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::post('login' ,[LoginController::class,'login']);

//Route::middleware('admin')->group(function (){
Route::apiResource('cities' ,CityController::class);
Route::apiResource('regions' ,RegionController::class);
Route::apiResource('branches' ,BranchController::class);
Route::put('branches/addworker' ,BranchController::class);
Route::apiResource('countries' ,CountryController::class);
Route::apiResource('warehouses' ,WarehouseController::class);
Route::apiResource('parcels' ,ParcelController::class);
Route::apiResource('packages' ,PackageController::class);
Route::apiResource('tariffs' ,TariffController::class);
//});
