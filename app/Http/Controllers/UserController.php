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
use App\Models\Brand;
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
        $lowestPrice = Product::min('price');
        $highestPrice = Product::max('price');
        $allProducts = Product::with('productImages')->with('brand')->get();
        $saleProducts = Product::where('discount', '!=', null)->with('productImages', 'brand')->get();
        $favouriteProducts = Product::select('products.*', DB::raw('COUNT(*) as count'))
            ->join('favourites', 'favourites.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->orderByDesc('count')
            ->with('productImages', 'brand')
            ->get();
        if ($request->has('category_id')) {
            $saleProducts = Product::where('discount', '!=', null)->where('category_id', $request->category_id)->with('productImages')->get();
            $favouriteProducts = Product::select('products.*', DB::raw('COUNT(*) as count'))
                ->join('favourites', 'favourites.product_id', '=', 'products.id')
                ->groupBy('products.id')
                ->orderByDesc('count')
                ->where('category_id', $request->category_id)
                ->with('productImages')
                ->get();
        }
        $banners = Banner::all();
        $categories = Category::all();
        $brands = Brand::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        $topBrands = $brands->take(5); // Get the top 5 most used brands
        $remainingBrands = $brands->slice(5); // Get the rest of the brands

        $sortedBrands = $topBrands->concat($remainingBrands);
        $success = [];
        $success['lowestPrice'] = $lowestPrice;
        $success['highestPrice'] = $highestPrice;
        $success['banners'] = $banners;
        $success['categories'] = $categories;
        $success['allProducts'] = $allProducts;
        $success['saleProducts'] = $saleProducts;
        $success['popularProducts'] = $favouriteProducts;
        $success['brands'] = $sortedBrands;
        return $this->sendResponse($success, 'User Dashboard data.');
    }

    // Update profile function 
    public function updateProfile(Request $request)
    {
        $data = $request->except('_token');
        if ($request->has('is_business') && !empty($request->is_business)) {
            unset($data['is_business']);
            $profile = BusinessProfile::where('user_id', auth()->user()->id)->update($data);
        } else {
            $profile = User::where('id', auth()->user()->id)->update($data);
        }
        if ($profile) {
            $user = User::where('id', auth()->user()->id)->with('businessProfile')->get();
            return $this->sendResponse($user, 'User Profile updated Successfully!.');
        }
        return $this->sendError('Your Profile cannot be updated at the moment. Please Try again later.');
    }
}
