<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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

                return redirect('dashboard')->with('success', 'Logged In Successfully');

            }

            return redirect()->back()->with('error', "Wrong Credientials");

        }

        return view('pages.admin.auth.login');

    }

    public function logout(){
        Auth::logout();
        return redirect('login')->with('success', 'Logged Out Successfully');
    }

}
