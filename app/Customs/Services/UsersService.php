<?php

namespace App\Customs\Services; 

use App\Models\User;

class UsersService {

    public function get_users() {
        $users = User::select("id", "name", "email", "created_at", "email_verified_at")
                        ->where("email", "!=", auth()->user()->email)
                        ->get();
        return response()->json([
            "status" => "success",
            "users" => $users
        ], 200);
    }
}