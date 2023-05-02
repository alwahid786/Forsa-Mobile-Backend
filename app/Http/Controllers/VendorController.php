<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    use ResponseTrait;

    // Get vendor dashboard Data 
    public function dashboardData(Request $request)
    {
        $loginUserId = auth()->user()->id;
        $products = Product::where('vendor_id', auth()->user()->id)->get();
        if (!empty($products)) {
            foreach ($products as $product) {
                $product['images'] = ProductImage::where('product_id', $product->id)->get();
            }
        }
        $totalStock = Product::where('vendor_id', $loginUserId)->sum('quantity');
        $availableStock = Product::where('vendor_id', $loginUserId)->sum('remaining_items');
        $soldStock = $totalStock - $availableStock;

        $success = [];
        $success['products'] = $products;
        $success['totalStock'] = $totalStock;
        $success['availableStock'] = $availableStock;
        $success['soldStock'] = $soldStock;
        return $this->sendResponse($success, 'Dashboard Data');
    }
}
