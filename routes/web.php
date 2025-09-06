<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, "home"])->name("home");
Route::get('/users/login', [IndexController::class, "home"])->name("users.login");
Route::get('/users/register', [IndexController::class, "home"])->name("users.register");
Route::get('/users/logout', [IndexController::class, "home"])->name("users.logout");
