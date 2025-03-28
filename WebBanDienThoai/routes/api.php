<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/brand', [BrandController::class, 'getAllBrand']);

Route::middleware(['checkToken'])->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/user/update', [UserController::class, 'updateProfile']);
    

});

Route::middleware(['checkToken','role:Admin'])->group(function () {
    Route::delete('/user/delete/{userId}', [UserController::class, 'deleteUser']);
    Route::post('/brand', [BrandController::class, 'createBrand']);
    Route::post('/brand/update/{brandId}', [BrandController::class, 'updateBrand']);
    Route::delete('/brand/delete/{brandId}', [BrandController::class, 'deleteBrand']);
});