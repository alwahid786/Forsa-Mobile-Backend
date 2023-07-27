<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{

    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {

        $this->authRepository = $authRepository;

    }

    public function login(Request $request)
    {

        if($request->isMethod('post'))
        {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);


            $result = $this->authRepository->login($request);

            if($result == true)
            {

                return redirect()->back()->with('message', "Login Successfully");

            }

            return redirect()->back()->with('error', "Wrong Credientials");

        }

        return view('pages.admin.auth.login');

    }

}
