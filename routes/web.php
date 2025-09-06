<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, "home"])->name("home");

Route::group(['prefix' => 'users'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('users.register')->middleware("guest");
    Route::get('/login', [UserController::class, 'login'])->name('users.login')->middleware("guest");
    Route::get('/forgot-password', [UserController::class, 'forgot'])->name('users.forgot')->middleware("guest");
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile.show')->middleware("auth");
    
    Route::delete('/logout', [UserController::class, 'logout'])->name('users.logout')->middleware("auth");
});
