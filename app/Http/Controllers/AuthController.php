<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        try {
            $user = $this->userService->getUser();
            return Helper::responseOkAPI(
                Response::HTTP_OK,
                $user
            );
        } catch (\Exception $e) {
            return Helper::responseErrorAPI(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                User::ERR_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }

    public function logout()
    {
        try {
            $this->userService->userLogout();

            return Helper::responseOkAPI(
                Response::HTTP_OK,
                'User logged out successfully'
            );
        } catch (\Exception $e) {
            return Helper::responseErrorAPI(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                User::ERR_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
}
