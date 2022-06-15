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
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Redis;

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
                $user,
                'Verification-link-sent'
            );
        } catch (\Exception $e) {
            return Helper::responseErrorAPI(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                User::ERR_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }

    public function verify(Request $request)
    {
        try {
            $user = $this->userService->getUserVerify($request->id);
            if ($user->hasVerifiedEmail()) {
                return Helper::responseErrorAPI(
                    Response::HTTP_OK,
                    User::ERR_EMAIL_ALREADY_VERIFIED,
                    'Email already verified'
                );
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            return Helper::responseOkAPI(
                Response::HTTP_OK,
                $user,
                'Email has been verified'
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
