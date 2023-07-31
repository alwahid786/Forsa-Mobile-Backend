<?php

namespace App\Repositories;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function login($request)
    {

        $credentials = $request->only('email', 'password');
        $credentials['user_type'] = 'admin';
        if (Auth::attempt($credentials))
        {

            return true;

        } else {

            return false;

        }

    }
}
