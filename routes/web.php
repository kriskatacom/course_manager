<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirect "/" to default locale
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/' . config('app.locale')); // по подразбиране 'bg'
});

/*
|--------------------------------------------------------------------------
| Switch language
|--------------------------------------------------------------------------
*/
Route::get("/switch-language/{locale}", function ($locale) {
    if (!in_array($locale, ["bg","en"])) {
        $locale = config("app.locale");
    }

    $segments = request()->segments();
    if (in_array($segments[0] ?? "", ["bg","en"])) {
        $segments[0] = $locale;
    } else {
        array_unshift($segments, $locale);
    }

    return redirect()->to(implode("/", $segments));
})->name("lang.switch");

/*
|--------------------------------------------------------------------------
| Localized routes
|--------------------------------------------------------------------------
*/
Route::group([
    "prefix" => "{locale}",
    "where" => ["locale" => "bg|en"],
    "middleware" => "setlocale"
], function () {

    // Home
    Route::get("/", [IndexController::class, "home"])->name("home");

    // User routes for guests
    Route::group(["prefix" => "users", "middleware" => "guest"], function () {
        Route::get("/register", [UserController::class, "register"])->name("users.register");
        Route::post("/register", [UserController::class, "store"])->name("users.store");

        Route::get("/login", [UserController::class, "login"])->name("users.login");
        Route::post("/login", [UserController::class, "authenticate"])->name("users.authenticate");

        Route::get("/forgot-password", [UserController::class, "forgotPassword"])->name("password.request");
        Route::post("/forgot-password", [UserController::class, "sendResetLink"])->name("password.email");

        Route::get("/reset-password/{token}/{email}", [UserController::class, "resetPassword"])->name("password.reset");
        Route::post("/reset-password", [UserController::class, "updatePassword"])->name("password.update");
    });

    // User routes for authenticated users
    Route::group(["prefix" => "users", "middleware" => "auth"], function () {
        Route::get("/profile", [UserController::class, "profile"])->name("users.profile.show");
        Route::put("/profile", [UserController::class, "updateProfile"])->name("users.profile.update");
        Route::delete("/logout", [UserController::class, "logout"])->name("users.logout");
    });

    // Admin routes
    Route::group([
        "prefix" => "admin",
        "middleware" => ["auth", "can:access-admin"]
    ], function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");

        Route::prefix("users")->group(function () {
            Route::get("/", [UserController::class, "all"])->name("admin.users.index");
            Route::get("/create", [UserController::class, "create"])->name("admin.users.create");
            Route::get("/{id}/edit", [UserController::class, "edit"])->name("admin.users.edit");
            Route::put("/{id}", [UserController::class, "update"])->name("admin.users.update");
            Route::delete("/{id}", [UserController::class, "destroy"])->name("admin.users.destroy");
        });

        Route::prefix("roles")->group(function () {
            Route::get("/", [RoleController::class, "all"])->name("admin.roles.index");
            Route::get("/{id}/edit", [RoleController::class, "edit"])->name("admin.roles.edit");
            Route::put("/{id}", [RoleController::class, "update"])->name("admin.roles.update");
            Route::delete("/{id}", [RoleController::class, "destroy"])->name("admin.roles.destroy");
        });

        Route::prefix("permissions")->group(function () {
            Route::get("/", [PermissionController::class, "all"])->name("admin.permissions.index");
            Route::get("/{id}/edit", [PermissionController::class, "edit"])->name("admin.permissions.edit");
            Route::put("/{id}", [PermissionController::class, "update"])->name("admin.permissions.update");
            Route::delete("/{id}", [PermissionController::class, "destroy"])->name("admin.permissions.destroy");
        });
    });
});