<?php

namespace App\Http\Controllers\Api\Profile;

use App\Customs\Services\PasswordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function __construct(private PasswordService $password_service) {
        
    }

    public function change_user_password(ChangePasswordRequest $request) {
        return $this->password_service->change_password($request->validated());
    }
}
