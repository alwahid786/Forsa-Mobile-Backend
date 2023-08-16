<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Exception;
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

    public function products(){
        try{
            $products = Product::withCount('orders')
            // ->whereHas('orders')
            ->with('vendor')->get();
            return view('pages.admin.products.products', ['products'=> $products]);
        } catch (Exception $e) {
            return redirect('dashboard')->with('error', 'Some thing went wrong');

        }
    }
    
    public function productDetails($id){
        try{
            $request = Request::create('/some-uri', 'GET', [
                'product_id' => $id
            ]);
        $productController = new ProductController();
        $product = $productController->productDetail($request);

        $content = $product->getContent();
        // $dashResponseBody = $product->body();
        $data = json_decode(
            $content,
            true
        );
        // dd($data['data']['productDetail']);
        if($data['success']==false){
            return redirect('products')->with('error', 'Some thing went wrong');
        }
        return view('pages.admin.products.product_details', ['product'=> $data['data']['productDetail']]);
        } catch (Exception $e) {
            return redirect('dashboard')->with('error', 'Some thing went wrong');

        }
    }

}
