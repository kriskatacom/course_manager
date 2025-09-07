<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Users\ResetPasswordForm;
use Illuminate\Support\Facades\Route;

Route::get("/", [IndexController::class, "home"])->name("home");

Route::group(["prefix" => "users"], function () {
    Route::get("/register", [UserController::class, "register"])->name("users.register")->middleware("guest");
    Route::get("/login", [UserController::class, "login"])->name("users.login")->middleware("guest");
    Route::get("/profile", [UserController::class, "profile"])->name("users.profile.show")->middleware("auth");

    Route::get("/forgot-password", [UserController::class, "forgotPassword"])->name("password.request");
    Route::get('/reset-password/{token}', [UserController::class, "resetPassword"])->name('password.reset')->middleware('guest');

    Route::delete("/logout", [UserController::class, "logout"])->name("users.logout")->middleware("auth");
});

Route::group([
    "prefix" => "admin",
    "middleware" => ["auth", "can:access-admin"]
], function () {
    Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");
    
    Route::group(["prefix" => "users"], function () {
        Route::get("/", [UserController::class, "all"])->name("admin.users.index");
    });
});
