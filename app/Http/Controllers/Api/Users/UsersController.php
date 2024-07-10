<?php

namespace App\Http\Controllers\Api\Users;

use App\Customs\Services\UsersService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(private UsersService $users_service) {
        
    }

    public function get_users() {
        return $this->users_service->get_users();
    }
}
