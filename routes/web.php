<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes', [HomeController::class, 'tes'])->name('tes');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/signup', [AuthController::class, 'signup'])->name('siqnup');
Route::post('/siqnup_process', [AuthController::class, 'signup_process'])->name('signup_process');
Route::post('/signin_process', [AuthController::class, 'signin_process'])->name('signin_process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'as' => 'user.'], function(){
    Route::get('/home', [HomeController::class, 'home'])->name('user_home');
    Route::get('/cake/{id}', [HomeController::class, 'addCart'])->name('add_cart');
    Route::post('/add_cart_process/{id}', [HomeController::class, 'addCartProcess'])->name('add_cart_process');
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/delete_cart/{id}', [HomeController::class, 'deleteCart'])->name('delete_cart');
    Route::post('/checkout_process', [HomeController::class, 'checkout'])->name('checkout_process');
    Route::get('/payment/{order_id}', [HomeController::class, 'payment'])->name('payment');
    Route::post('/payment_process/{order_id}', [HomeController::class, 'payment_process'])->name('payment_process');
    Route::get('/order_status', [HomeController::class, 'order_status'])->name('order_status');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function(){
    Route::get('/dashboard', [AdminController::class, 'home'])->name('admin_home');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('add_product');
    Route::post('/add_product_process', [AdminController::class, 'addProductProcess'])->name('add_product_process');
    Route::get('/edit_product/{id}', [AdminController::class, 'editProduct'])->name('edit_product');
    Route::post('/edit_product_process/{id}', [AdminController::class, 'editProductProcess'])->name('edit_product_process');
});
