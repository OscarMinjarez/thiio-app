<?php

namespace App\Customs\Services;

use App\Models\EmailVerificationToken;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EmailVerificationService {

    public function send_verification_link(object $user): void {
        Notification::send(
            $user,
            new EmailVerificationNotification($this->generate_verification_link($user->email))
        );
    }

    public function resend_link(string $email) {
        $user = User::where("email", $email)->first();
        if (!$user) {
            return response()->json([
                "status" => "failed",
                "message" => "User not found"
            ]);
        }
        $this->send_verification_link($user);
        return response()->json([
            "status" => "succes",
            "message" => "Verification link sent successfully"
        ]);
    }

    public function verify_token(string $email, string $token) {
        $token = EmailVerificationToken::where("email", $email)->where("token", $token)->first();
        if (!$token) {
            response()->json([
                "status" => "failed",
                "message" => "Invalid token"
            ])->send();
            exit;
        }
        if ($token->expired_at <= now()) {
            $token->delete();
            response()->json([
                "status" => "failed",
                "message" => "Token expired"
            ])->send();
            exit;
        }
        return $token;
    }

    public function check_verified_email(object $user) {
        if ($user->email_verified_at) {
            response()->json([
                "status" => "failed",
                "message" => "Email has already verified"
            ])->send();
            exit;
        }
    }

    public function verify_email(string $email, string $token) {
        $user = User::where("email", $email)->first();
        if (!$user) {
            return response()->json([
                "status" => "failed",
                "message" => "User not found"
            ]);
        }
        $this->check_verified_email($user);
        $verified_token = $this->verify_token($email, $token);
        if ($user->markEmailAsVerified()) {
            $verified_token->delete();
            return response()->json([
                "status" => "success",
                "message" => "Email has been verified"
            ]);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Email verification failed, please try again"
        ]);
    }

    public function generate_verification_link(string $email): string {
        $check_token_exists = EmailVerificationToken::where("email", $email)->first();
        if ($check_token_exists) {
            $check_token_exists->delete();
        }
        $token = Str::uuid();
        $url = config("app.url") . "?token=" . $token . "&email=" . $email;
        EmailVerificationToken::create([
            "email" => $email,
            "token" => $token,
            "expired_at" => now()->addMinutes(5)
        ]);
        return $url;
    }
}