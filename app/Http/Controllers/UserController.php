<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Banner;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use ResponseTrait;

    // Get dashboard data for User 
    public function dashboardData(Request $request)
    {
        $banners = Banner::all();
        $categories = Category::all();
        $brands = Product::groupBy('brand')->pluck('brand');
        $success = [];
        $success['banners'] = $banners;
        $success['categories'] = $categories;
        $success['brands'] = $brands;
        return $this->sendResponse($success, 'User Dashboard data.');
    }
}
