<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DashboardRepositoryInterface;

class DashboardController extends Controller
{

    /**
     * create a contructor for dashboard interface
     *
     * @return \Illuminate\Http\Response
    */

    private $dashboardQuery;

    public function __construct(DashboardRepositoryInterface $dashboardQuery)
    {
        $this->dashboardQuery = $dashboardQuery;
    }

    /**
     * Dashboard Data
     *
     * @return \Illuminate\Http\Response
    */

    public function dashboard(){

        $data['total_users'] = User::where('is_business', '0')->where('user_type', '!=', 'admin')->count();

        $data['total_vendors'] = User::where('is_business', '1')->count();

        $data['total_products'] = Product::count();

        $data['topProducts'] = Product::withCount('orders')
            ->whereHas('orders')
            ->with('vendor')
            ->orderByDesc('orders_count')
            ->limit(10)->get();

        // Revenue Graph

        $data['revnueGraph'] = $this->dashboardQuery->revenueGraph();

        return view('pages.admin.dashboard.dashboard', $data);
    }
}
