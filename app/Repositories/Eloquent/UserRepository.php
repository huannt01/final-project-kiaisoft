<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Repositories\Eloquent\UserRepositoryInterface;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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
        if (!$token) {
            return response()->json([
                'statusCode' => Response::HTTP_UNAUTHORIZED,
                'messsage' => 'Unauthorized'
            ]);
        }
        return $token;
    }
}
