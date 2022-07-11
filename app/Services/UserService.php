<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser($data)
    {
        $data = array_merge($data, ['password' => bcrypt($data['password'])]);
        return $this->userRepository->register($data);
    }

    public function getUserVerify($id)
    {
        return $this->userRepository->getUserVerify($id);
    }

    public function loginUser($data)
    {
        return $this->userRepository->login($data);
    }

    public function getUser()
    {
        return Auth::user();
    }

    public function userLogout($id)
    {
        return Auth::logout();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }
}
