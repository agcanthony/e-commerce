<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/add-to-cart', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'view']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/cart/count', [CartController::class, 'getCartCount']);
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/remove', [CartController::class, 'remove']);
});