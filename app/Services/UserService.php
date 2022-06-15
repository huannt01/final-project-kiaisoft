<?php

namespace App\Services;

use App\Repositories\UserRepository;

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

    public function loginUser($data)
    {
        return $this->userRepository->login($data);
    }

    public function getUser()
    {
        return $this->userRepository->getUser();
    }

    public function userLogout()
    {
        return $this->userRepository->userLogout();
    }
}
