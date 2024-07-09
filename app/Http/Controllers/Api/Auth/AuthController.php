<?php

namespace App\Http\Controllers\Api\Auth;

use App\Customs\Services\EmailVerificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private EmailVerificationService $emailVerificationService) {
        
    }

    /**
     * Login method
     */
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

    /**
     * Register method
     */
    public function register(RegisterRequest $request) {
        $user = User::create($request->validated());
        if (!$user) {
            return response()->json([
                "status" => "failed",
                "message" => "An error ocurre while trying to create user"
            ], 500);
        }
        $this->emailVerificationService->send_verification_link($user);
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
}
