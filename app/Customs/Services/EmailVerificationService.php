<?php

namespace App\Customs\Services;

use App\Models\EmailVerificationToken;
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

    public function generate_verification_link(string $email): string {
        $check_token_exists = EmailVerificationToken::where("email", $email)->first();
        if ($check_token_exists) {
            $check_token_exists->delete();
        }
        $token = Str::uuid();
        $url = config("app.url") . "?token=" . $token . "&email=" . $email;
        $save_token = EmailVerificationToken::create([
            "email" => $email,
            "token" => $token,
            "expired_at" => now()->addMinutes(5)
        ]);
        return $url;
    }
}