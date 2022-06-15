<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Services\UserService;
use App\Helpers\Helper;


class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRegisterRequest $request)
    {
        try {
            $user = $this->userService->registerUser($request->all());
            $user->sendEmailVerificationNotification();

            return Helper::responseOkAPI(
                Response::HTTP_OK,
                [
                    'message' => 'Verification link sent',
                    'user' => $user
                ],
            );
        } catch (\Exception $e) {
            return Helper::responseErrorAPI(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                User::ERR_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
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
