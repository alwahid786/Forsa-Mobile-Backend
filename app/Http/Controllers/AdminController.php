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
use App\Models\Size;
use App\Models\Brand;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    use ResponseTrait;

    // Add Banner API
    public function addBanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_images' => 'required|array',
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        foreach ($request->banner_images as $banner) {
            $bannerimage = new Banner;
            $bannerimage->banner_image = $banner;
            $bannerimage->save();
            $success[] = $bannerimage;
        }

        return $this->sendResponse($success, 'Banners added successfully');
    }

    // Add Size API
    public function addSize(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        if ($request->has('id') && !empty($request->id)) {
            $size = Size::find($request->id);
        } else {
            $size = new Size();
        }
        $size->size = $request->title;
        $size->category = $request->category;
        $success = $size->save();
        if ($success) {
            return $this->sendResponse($size, 'Size added successfully');
        } else {
            return $this->sendError('Something went wrong, Try again later!');
        }
    }

    // Get Sizes 
public function getSizes(Request $request)
{
    $query = Size::query();

    if ($request->has('category') && $request->category != '') {
     
        $query->where('category_id', $request->category);
    }
    
    $sizes = $query->get();

    foreach ($sizes as $size) {
        $size->type = (preg_match('/^[A-Z]+$/', $size->size)) ? 0 : 1;
    }

    return $this->sendResponse($sizes, 'List of Sizes');
}


    // get list of banners 
    public function allBanners()
    {
        $banners = Banner::all();
        return $this->sendResponse($banners, 'Banners List');
    }

    // get list of brands 
    public function brands()
    {
        $brands = Brand::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        $topBrands = $brands->take(5); // Get the top 5 most used brands
        $remainingBrands = $brands->slice(5); // Get the rest of the brands

        $sortedBrands = $topBrands->concat($remainingBrands);
        return $this->sendResponse($sortedBrands, 'List of all Brands');
    }
}
