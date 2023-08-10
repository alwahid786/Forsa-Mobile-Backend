<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function listOfAllVendor(Request $request)
    {
        $vendor = $this->user->allVendor();
        return view('pages.admin.vendor.vendor', ['vendor' => $vendor]);
    }

    public function listOfAllUsers(Request $request)
    {
        $user = $this->user->allUser();
        return view('pages.admin.user.user', ['users' => $user]);
    }

    public function vendorDetail(Request $request, $id)
    {
        $vendorDetail = $this->user->viewDetail($id);
        return view('pages.admin.vendor.vendor_detail', ['vendorDetail'=> $vendorDetail]);
    }

    public function userDetail(Request $request, $id)
    {
        $userDetail = $this->user->viewDetail($id);
        return view('pages.admin.user.user_detail', ['userDetail'=> $userDetail]);
    }

}
