<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Helpers\Helper;

class AuthController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $token = $this->userService->loginUser($request->all());
            if (!$token) {
                return Helper::responseErrorAPI(
                    Response::HTTP_UNAUTHORIZED,
                    User::ERR_LOGIN_FAILED,
                    'Login failed'
                );
            }
            $result = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => auth()->user()
            ];
            return Helper::responseOkAPI(
                Response::HTTP_OK,
                $result
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
