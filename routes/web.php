<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/signup', [AuthController::class, 'signup'])->name('siqnup');
Route::post('/siqnup_process', [AuthController::class, 'signup_process'])->name('signup_process');
Route::post('/signin_process', [AuthController::class, 'signin_process'])->name('signin_process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'as' => 'user.'], function(){
    Route::get('/sudah_login', [HomeController::class, 'home'])->name('user_home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function(){
    Route::get('/dashboard', [AdminController::class, 'home'])->name('admin_home');
});