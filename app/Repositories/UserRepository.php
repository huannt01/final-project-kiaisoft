<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function register($data)
    {
        return $this->model->create($data);
    }

    public function login($data)
    {
        $token = auth()->attempt($data);
        return $token;
    }
}
