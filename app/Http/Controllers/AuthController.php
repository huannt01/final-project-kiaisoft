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
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->userService = $userService;
    }

    public function register(UserRegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = $this->userService->registerUser($validated);
        } catch (\Exception $e) {
            return Helper::responseErrorAPI(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'E1010',
                $e->getMessage(),
                $data = []
            );
        }
        return Helper::responseOkAPI(
            Response::HTTP_OK,
            $user
        );
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
