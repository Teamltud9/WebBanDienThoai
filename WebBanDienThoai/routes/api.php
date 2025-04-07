<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/brand', [BrandController::class, 'getAllBrand']);
Route::get('/products', [ProductController::class, 'getAll']);
Route::get('/products/filter', [ProductController::class, 'filter']);
Route::get('/products/{productId}', [ProductController::class, 'getById']);
Route::get('/search', [ProductController::class, 'search']);

// Public review routes
Route::get('/reviews', [ReviewController::class, 'getAll']);
Route::get('/reviews/{previewId}', [ReviewController::class, 'getById']);
Route::get('/reviews/product/{productId}', [ReviewController::class, 'getByProductId']);
Route::get('/reviews/user/{userId}', [ReviewController::class, 'getByUserId']);


Route::middleware(['checkToken'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/user/update', [UserController::class, 'updateProfile']);
    
    // Authenticated user review routes
    Route::post('/reviews', [ReviewController::class, 'create']);
    Route::put('/reviews/{previewId}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{previewId}', [ReviewController::class, 'delete']);
    Route::post('/like/{productId}', [ProductController::class, 'likeProduct']);
    Route::get('/like', [ProductController::class, 'getLikedProducts']);
});

Route::middleware(['checkToken', 'role:Admin'])->group(function () {
    Route::delete('/user/delete/{userId}', [UserController::class, 'deleteUser']);
    Route::post('/brand', [BrandController::class, 'createBrand']);
    Route::post('/brand/update/{brandId}', [BrandController::class, 'updateBrand']);
    Route::delete('/brand/delete/{brandId}', [BrandController::class, 'deleteBrand']);

    Route::get('/user', [UserController::class, 'getAllUser']);
    //Product Routes
    Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'create']);
        Route::post('/{productId}', [ProductController::class, 'update']);
        Route::delete('/{productId}', [ProductController::class, 'delete']);
    });
});
//Cart Routes
Route::middleware(['checkToken', 'role:User'])->group(function () {

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'getCart']);
        Route::post('/add/{productId}', [CartController::class, 'addToCart']);
        Route::put('/update/{productId}', [CartController::class, 'updateCart']);
        Route::delete('/delete/{productId}', [CartController::class, 'removeFromCart']);
        Route::delete('/clear', [CartController::class, 'clearCart']);
        Route::post('/checkout', [CartController::class, 'checkout']);

        Route::get('/history', [CartController::class, 'orderHistory']);
    });
});