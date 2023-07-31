<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['total_users'] = User::where('is_business', '0')->where('user_type', '!=', 'admin')->count();
        $data['total_vendors'] = User::where('is_business', '1')->count();
        $data['total_products'] = Product::count();
        $data['topProducts'] = Product::withCount('orders')
        ->whereHas('orders')
        ->with('vendor')
        ->orderByDesc('orders_count')
        ->limit(10)->get();
        return view('pages.admin.dashboard.dashboard', $data);    
    }
}
