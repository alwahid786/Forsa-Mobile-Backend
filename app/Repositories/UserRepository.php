<?php

namespace App\Repositories;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function allVendor()
    {
        $query = User::where('user_type', 'vendor')->get();
        return $query;
    }

    public function allUser()
    {
        $query = User::where('user_type', 'user')->get();
        return $query;
    }

}
