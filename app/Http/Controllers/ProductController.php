<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Views;
use App\Models\Favourite;
use App\Models\Chat;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    use ResponseTrait;

    // Add Product 
    public function addProduct(Request $request)
    {
        $id = $request->id;
        $loginUserId = Auth::user()->id;
        // $businessProfile = Auth::user()->buisnessProfile;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'size' => 'required',
            'condition' => 'required',
            'category_id' => 'required|integer',
            'description' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'pick_profile_location' => 'required|boolean',
            'images' => 'required|array'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        if (empty($id)) {
            $product = new Product;
        } else {
            $product =  Product::find($id);
        }
        $product->title = $request->title;
        $product->vendor_id = $loginUserId;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->size = $request->size;
        $product->condition = $request->condition;
        $product->brand = $request->brand;
        $product->price = $request->price;
        if ($request->has('discount')) {
            $discount = ($request->price * $request->discount) / 100;
            $product->discount = $request->discount;
            $product->discount_price = $request->price - $discount;
        }
        if ($request->pick_profile_location == 1) {
            $product->country = auth()->user()->country;
            $product->city = auth()->user()->city;
            $product->location = auth()->user()->location;
        } else {
            $product->country = $request->country;
            $product->city = $request->city;
            $product->location = $request->location;
        }
        $product->quantity = $request->quantity;
        $product->remaining_items = $request->quantity;

        $productresponse = $product->save();
        if ($productresponse) {
            if (isset($request->images) && !empty($request->images)) {
                $images = $request->images;
                ProductImage::where('product_id', $product->id)->delete();
                if (is_array($images) && !empty($images)) {
                    foreach ($images as $image) {
                        $productImage = new ProductImage;
                        $productImage->product_id = $product->id;
                        $productImage->image = $image;
                        $imageResult = $productImage->save();
                        if ($imageResult == false) {
                            return $this->sendError('Something went wrong please contact support.');
                        }
                    }
                }
            }
            $category_name = Category::where('id', $request->category_id)->pluck('category_name')->first();
            $product->categoryname = $category_name;
            $product->images = ProductImage::where('product_id', $product->id)->get();
            $success['product'] = $product;
            if (!isset($id)) {
                return $this->sendResponse($success, 'Product Created Successfully.');
            } else {
                return $this->sendResponse($success, 'Product Updated Successfully.');
            }
        }
    }

    // Product details 
    public function productDetail(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::where('id', $productId)->with('productImages', 'vendor', 'vendor.businessProfile')->first();
        $product = json_decode($product);

        $category = Category::find($product->category_id);
        $product->parentCategoryId = $category->parent_id;

        $views = Views::where('product_id', $productId)->count();
        $favourites = Favourite::where('product_id', $productId)->count();

        $protectionfees = ($product->price * 5) / 100;

        $allProducts = Product::where('vendor_id', $product->vendor_id)->limit(5)->get();
        if (!empty($allProducts)) {
            foreach ($allProducts as $productNew) {
                $productNew['images'] = ProductImage::where('product_id', $productNew->id)->get();
                $productNew['favourites'] = Favourite::where('product_id', $productNew['id'])->count();
            }
        }

        Views::updateOrCreate(['product_id' => $productId, 'user_id' => auth()->user()->id]);
        $carbon = new Carbon($product->created_at);
        $formatted_date = $carbon->format('M d, Y');
        
        $success['productDetail'] = $product;
        if (auth()->user()->is_business === 0) {
            $chat = Chat::where(['client_id' => auth()->user()->id, 'vendor_id' => $product->vendor_id])->orwhere(['client_id' => $product->vendor_id, 'vendor_id' => auth()->user()->id])->first();
            $chat_id = null;
            if (!empty($chat)) {
                $chat_id = $chat->id;
            }
            $success['chat_id'] = $chat_id;
        }
        $success['views'] = $views;
        $success['favourites'] = $favourites;
        $success['buyerProtectionFees'] = $protectionfees + 0.70;
        $success['total'] = $protectionfees + 0.70 + $product->price;
        $success['uploaded'] = $formatted_date;
        $success['products'] = $allProducts;
        return $this->sendResponse($success, 'Product Details');
    }

    // Search Products 
    public function searchProducts(Request $request)
    {
        if ($request->has('name')) {
            $productsData = Product::where('title', 'LIKE', '%' . $request->name . '%');
        } else {
            $productsData = (new Product())->newQuery();
            if ($request->has('country')) {
                $productsData->where('country', $request->country);
            }
            if ($request->has('sub_category')) {
                $productsData->where('category_id', $request->sub_category);
            }
            if (!$request->has('sub_category')) {
                if ($request->has('category')) {
                    $productsData->where('category_id', $request->category);
                }
            }
        }
        $products = $productsData->get();
        if (count($products) > 0) {
            foreach ($products as $product) {
                $product['images'] = ProductImage::where('product_id', $product->id)->get();
            }
            return $this->sendResponse($products, 'Available products matching your search criteria');
        } else {
            if ($request->has('name')) {
                return $this->sendError("No Products found against this search. Use specific name to search for better results.");
            }
            return $this->sendError("No Products found against this filter.");
        }
    }

    // Add to Favourite 
    public function addToFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        $loginUserId = auth()->user()->id;
        $isExists = Favourite::firstWhere([
            'user_id' => $loginUserId,
            'product_id' => $request->product_id,
        ]);
        if (!$isExists) {
            $likeFav = Favourite::create([
                'user_id' => $loginUserId,
                'product_id' => $request->product_id,
            ]);
            if (!$likeFav) {
                return $this->sendError('Something went wrong');
            }
            $favourite = 'red';
            $success['favourite'] = $favourite;
            return $this->sendResponse($success, 'Added to favourites list.');
        } else {
            if (!Favourite::where('id', $isExists->id)->delete()) {
                return $this->sendError('Something went wrong.');
            }
            $favourite = 'white';
            $success['favourite'] = $favourite;
            return $this->sendResponse($success, 'Removed from favourites list.');
        }
    }

    // Fvaourite products List 
    public function favouritesList(Request $request)
    {
        $loginUserId = auth()->user()->id;
        $favourites = Favourite::where('user_id', $loginUserId)->with('product', 'product.productImages')->get();
        if (count($favourites) > 0) {
            return $this->sendResponse($favourites, 'Your favourites list');
        }
        return $this->sendError('No Products found in your Favourites List!');
    }

    // Add Product To Sold Function
    public function addToSoldProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        // Get Product 
        $product = new Product;
        $productData = $product->getProductById($request->product_id);

        $loginUserId = auth()->user()->id;

        if ($productData->vendor_id != $loginUserId) {
            return $this->sendError('Warning! You are not owner of this product.');
        }
        $status = Product::where('id', $request->product_id)->update(['remaining_items' => 0]);
        if ($status) {
            return $this->sendResponse([], 'Your product has been sold Successfully!');
        }
        return $this->sendError('Something went wrong! Try later.');
    }

    // Delete Product Function 
    public function deleteProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        // Get Product 
        $product = Product::find($request->product_id);
        $loginUserId = auth()->user()->id;

        if ($product->vendor_id != $loginUserId) {
            return $this->sendError('Warning! You are not owner of this product, You cannot delete it.');
        }

        // Delete Status 
        $deleteStatus = $product->delete();
        if ($deleteStatus) {
            return $this->sendResponse([], 'Your product has been deleted Successfully!');
        }
        return $this->sendError('Something went wrong! Try later.');
    }
}
