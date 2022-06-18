<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Eloquent\UserRepositoryInterface;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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

    public function getUserVerify($id)
    {
        return $this->model->find($id);
    }

    public function login($data)
    {
        $token = auth()->attempt($data);
        return $token;
    }
}
