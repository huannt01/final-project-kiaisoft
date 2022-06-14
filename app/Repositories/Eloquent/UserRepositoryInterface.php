<?php

namespace App\Repositories\Eloquent;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function login(array $data);
}
