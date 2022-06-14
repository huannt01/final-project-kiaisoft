<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Repositories\Eloquent\UserRepositoryInterface;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function register($data)
    {
        return $this->create($data);
    }

    public function login($data)
    {
        $token = auth()->attempt($data);
        return $token;
    }
}
