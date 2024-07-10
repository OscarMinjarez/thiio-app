<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Profile\PasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("auth/register", [AuthController::class, "register"]);
Route::post("auth/login", [AuthController::class, "login"]);
Route::post("auth/verify_user_email", [AuthController::class, "verify_user_email"]);
Route::post("auth/resend_email_verification_link", [AuthController::class, "resend_email_verification_link"]);

Route::middleware(["auth"])->group(function () {
    Route::post("/change_user_password", [PasswordController::class, "change_user_password"]);
});