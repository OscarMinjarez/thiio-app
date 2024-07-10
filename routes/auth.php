<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Profile\PasswordController;
use App\Http\Controllers\Api\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::post("auth/register", [AuthController::class, "register"]);
Route::post("auth/login", [AuthController::class, "login"]);
Route::post("auth/verify_user_email", [AuthController::class, "verify_user_email"]);
Route::post("auth/resend_email_verification_link", [AuthController::class, "resend_email_verification_link"]);

Route::middleware(["auth"])->group(function () {
    Route::post("/change_user_password", [PasswordController::class, "change_user_password"]);
    Route::post("auth/logout", [AuthController::class, "logout"]);
    Route::get("/users", [UsersController::class, "get_users"]);
});