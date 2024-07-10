<?php

namespace App\Http\Controllers\Api\Auth;

use App\Customs\Services\EmailVerificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResendEmailVerificationRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private EmailVerificationService $email_verification_service) {
        
    }

    public function login(LoginRequest $request) {
        $token = auth()->attempt($request->validated());
        if (!$token) {
            return response()->json([
                "status" => "failed",
                "message" => "Invalid credentials"
            ], 401);
        }
        return $this->response_with_token($token, auth()->user());
    }

    public function register(RegisterRequest $request) {
        $user = User::create($request->validated());
        if (!$user) {
            return response()->json([
                "status" => "failed",
                "message" => "An error ocurre while trying to create user"
            ], 500);
        }
        $this->email_verification_service->send_verification_link($user);
        $token = auth()->login($user);
        return $this->response_with_token($token, $user);
    }

    public function response_with_token($token, $user) {
        return response()->json([
            "status" => "success",
            "user" => $user,
            "access_token" => $token,
            "type" => "bearer"
        ]);
    }

    public function verify_user_email(VerifyEmailRequest $request) {
        return $this->email_verification_service->verify_email($request->email, $request->token);
    }

    public function resend_email_verification_link(ResendEmailVerificationRequest $request) {
        return $this->email_verification_service->resend_link($request->email);
    }
}
