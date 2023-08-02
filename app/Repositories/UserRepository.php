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

}
