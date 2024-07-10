<?php

namespace App\Customs\Services;

use Illuminate\Support\Facades\Hash;

class PasswordService {
    
    private function validate_current_password($current_password) {
        if (!password_verify($current_password, auth()->user()->password)) {
            response()->json([
                "status" => "failed",
                "message" => "Password did not match the current password"
            ])->send();
            exit;
        }
    }

    public function change_password($data) {
        $this->validate_current_password($data["current_password"]);
        $update_password = auth()->user()->update([
            "password" => Hash::make($data["password"])
        ]);
        if (!$update_password) {
            return response()->json([
                "status" => "failed",
                "message" => "An error ocurred while updating the password"
            ]);
        }
        return response()->json([
            "status" => "success",
            "message" => "The password has been changed"
        ]);
    }
}