<?php
 
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
// Route publik (dibatasi 5 request/menit per IP untuk mencegah brute force)
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
 
// Route terproteksi: wajib membawa token Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);
 
    // 1. GET All Products
    Route::get('/products', [ProductController::class, 'index']);
    // 2. POST Product
    Route::post('/products', [ProductController::class, 'store']);
    // 3. GET Single Product
    Route::get('/products/{product}', [ProductController::class, 'show']);
    // 4. PUT Product
    Route::put('/products/{product}', [ProductController::class, 'update']);
    // 5. DELETE Product
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});