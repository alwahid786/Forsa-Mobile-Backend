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
use App\Models\Favourite;
use Illuminate\Support\Facades\Mail;
use DB;

class UserController extends Controller
{
    use ResponseTrait;

    // Get dashboard data for User 
    public function dashboardData(Request $request)
    {
        $banners = Banner::all();
        $categories = Category::all();
        $brands = Product::groupBy('brand')->pluck('brand');
        $saleProducts = Product::where('discount', '!=', null)->with('productImages')->get();
        $favouriteProducts = Product::select('products.*', DB::raw('COUNT(*) as count'))
            ->join('favourites', 'favourites.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->orderByDesc('count')
            ->with('productImages')
            ->take(10)
            ->get();
        $success = [];
        $success['banners'] = $banners;
        $success['categories'] = $categories;
        $success['saleProducts'] = $saleProducts;
        $success['popularProducts'] = $favouriteProducts;
        $success['brands'] = $brands;
        return $this->sendResponse($success, 'User Dashboard data.');
    }
}
