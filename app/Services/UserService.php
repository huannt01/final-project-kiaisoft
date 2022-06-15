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

    public function getUser()
    {
        return $this->userRepository->getUser();
    }

    public function userLogout()
    {
        return $this->userRepository->userLogout();
    }
}
