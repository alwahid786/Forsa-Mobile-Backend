<?php

namespace App\Repositories;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Models\Order;
use Carbon\Carbon;

class DashboardRepository implements DashboardRepositoryInterface
{

    public function revenueGraph()
    {

        $orderModel = new Order;

        $months = range(1, 12);

        $dataForTwelveMonths = [];

        foreach ($months as $month) {

            $query = $orderModel::where('status', 1)->whereMonth('created_at', $month)->sum('total');


            $monthName = Carbon::createFromDate(null, $month)->format('M');

            $dataForTwelveMonths[$monthName] = $query;
            $profit[$monthName] = round(($query * 17)/100);
        }

        $data = ['monthly_total_amount' => $dataForTwelveMonths, 'profit' => $profit];

        return $data;

    }

}
