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
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class VendorController extends Controller
{
    use ResponseTrait;

    // Get vendor dashboard Data 
    public function dashboardData(Request $request)
    {

        $months = 5;
        if ($request->has('months')) {
            $months = $request->months;
        }
        $loginUserId = auth()->user()->id;
        $products = Product::where('vendor_id', auth()->user()->id)->with('productImages')->get();

        $totalStock = Product::where('vendor_id', $loginUserId)->sum('quantity');
        $availableStock = Product::where('vendor_id', $loginUserId)->sum('remaining_items');
        $soldStock = $totalStock - $availableStock;
        // Last Month Income 
        $lastMonthIncome = Order::whereDate('created_at', '>=', Carbon::now()->subMonth())->where(['status' => 5, 'vendor_id' => $loginUserId])->sum('total');

        // Get Last Month Percentage 
        

        // Create graph data 
        $graphData = $this->getPreviousMonthsInfo($months, $loginUserId);

        // Create Response 
        $success = [];
        $success['lastMonthIncome'] = $lastMonthIncome;
        $success['graphData'] = $graphData;

        $success['products'] = $products;
        $success['totalStock'] = $totalStock;
        $success['availableStock'] = $availableStock;
        $success['soldStock'] = $soldStock;
        return $this->sendResponse($success, 'Dashboard Data');
    }

    // Function for getting Graph data 
    public function getPreviousMonthsInfo($duration, $loginUserId)
    {
        $months = [];

        for ($i = 0; $i < $duration; $i++) {
            $month = Carbon::now()->subMonths($i)->format('F Y');
            $orders = Order::whereMonth('created_at', $month)->where(['status' => 5, 'vendor_id' => $loginUserId])->get();

            $totalIncome = 0;
            $totalProducts = count($orders);

            foreach ($orders as $order) {
                $totalIncome += $order->total;
            }

            $months[] = [
                'month' => $month,
                'total_income' => $totalIncome,
                'total_sold' => $totalProducts,
            ];
        }
        return $months;
    }
}
