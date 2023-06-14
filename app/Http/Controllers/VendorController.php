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
use App\Models\Location;
use App\Models\Withdraw;
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
        $thirdLastMonthIncome = Order::whereDate('created_at', '>=', Carbon::now()->subMonth(2))->where(['status' => 5, 'vendor_id' => $loginUserId])->sum('total');
        $lastMonthIncome = Order::whereDate('created_at', '>=', Carbon::now()->subMonth(1))->where(['status' => 5, 'vendor_id' => $loginUserId])->sum('total');
        $incomeDifference = $lastMonthIncome - $thirdLastMonthIncome;
        if ($lastMonthIncome > 0) {
            if ($thirdLastMonthIncome > 0) {
                $lastMonth = ($incomeDifference / $thirdLastMonthIncome) * 100;
                $lastMonthPercentage = round($lastMonth, 2);
            } else {
                $lastMonthPercentage = 100;
            }
        } else {
            $lastMonthPercentage = -100;
        }

        // Balance Calculations 
        $totalBalance = Order::where([['vendor_id', '=', $loginUserId], ['status', '!=', 6]])->sum('total');
        $totalWithdraws = Withdraw::where('vendor_id', $loginUserId)->sum('amount');
        $withdrawAvailable = $totalBalance - $totalWithdraws;

        $lastWithdraw = Withdraw::where('vendor_id', $loginUserId)->orderBy('created_at', 'DESC')->first('amount');
        if (!empty($lastWithdraw)) {
            $lastWithdraw = $lastWithdraw->amount; // Get last withdraw 
        }
        // Get current Month Percentage
        $currentMonthIncome = Order::whereMonth('created_at', '=', Carbon::now()->month)
            ->where(['status' => 5, 'vendor_id' => $loginUserId])
            ->sum('total');
        $currentIncomeDifference = $currentMonthIncome - $lastMonthIncome;
        if ($currentMonthIncome > 0) {
            if ($lastMonthIncome > 0) {
                $lastMonth = ($currentIncomeDifference / $lastMonthIncome) * 100;
                $currentMonthPercentage = round($lastMonth, 2);
            } else {
                $currentMonthPercentage = 100;
            }
        } else {
            $currentMonthPercentage = -100;
        }

        $allWithdraws = Withdraw::where('vendor_id', $loginUserId)->get();
        if (count($allWithdraws) > 0) {
            foreach ($allWithdraws as $withdraw) {
                $withdraw['time'] = date('h:i A', strtotime($withdraw->created_at));
                $withdraw['date'] = date('M d, Y', strtotime($withdraw->created_at));
            }
        }

        // Create graph data 
        $graphData = $this->getPreviousMonthsInfo($months, $loginUserId);

        // Create Response 
        $success = [];
        $success['lastMonthIncome'] = $lastMonthIncome;
        $success['graphData'] = $graphData;
        $success['lastMonthPercentage'] = $lastMonthPercentage;
        $success['lastMonthIncome'] = $lastMonthIncome;
        $success['currentMonthPercentage'] = $currentMonthPercentage;
        $success['currentMonthIncome'] = $currentMonthIncome;
        $success['totalBalance'] = $totalBalance;
        $success['lastWithdraw'] = $lastWithdraw ?? 0;
        $success['withdrawAvailable'] = $withdrawAvailable;
        $success['totalStock'] = $totalStock;
        $success['availableStock'] = $availableStock;
        $success['soldStock'] = $soldStock;
        $success['products'] = $products;
        $success['withdraws'] = $allWithdraws;
        return $this->sendResponse($success, 'Dashboard Data');
    }

    // Function for getting Graph data 
    public function getPreviousMonthsInfo($duration, $loginUserId)
    {
        $months = [];

        for ($i = 0; $i < $duration; $i++) {
            $month = Carbon::now()->subMonths($i)->format('M');
            $orders = Order::whereMonth('created_at', $month)->where(['status' => 5, 'vendor_id' => $loginUserId])->get();
            dd($orders);
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

    // Add Update Location for Vendor 
    public function addUpdateLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $request->merge(['user_id' => auth()->user()->id]);
        $data = $request->except('_token');
        $status = Location::updateOrCreate(['user_id'=> auth()->user()->id], $data);
        if ($status) {
            $location = Location::where('user_id', auth()->user()->id)->get();
            return $this->sendResponse($location, 'Location Added Successfully');
        }
        return $this->sendError('Something went wrong. Try again later');
    }
}
