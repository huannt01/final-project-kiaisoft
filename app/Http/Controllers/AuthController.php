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

        $validated = $request->validated();

        try {
            $token = $this->userService->loginUser($validated);
            $result = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => auth()->user()
            ];
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
            $result
        );
    }

    public function profile()
    {
        try {
            $user = $this->userService->getUser();
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

    public function logout()
    {
        try {
            $this->userService->userLogout();
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
            'User logged out successfully'
        );
    }
}
