<?php

namespace App\Http\Controllers;

use App\Models\TravelHistory;
use Illuminate\Http\Request;
use DateTime;
use DB;
use App\OrderStatusHistory;
use Carbon\Carbon;
class ChartController extends Controller
{


    public function getWeeks()
    {
        $weeks = [];
        $orderWeeks = TravelHistory::orderBy('updated_at', 'ASC')->pluck('updated_at');
        $orderWeeks = json_decode($orderWeeks);
        if (!empty($orderMonths)) {
            foreach ($orderMonths as $unformatted_date) {

                $date = new \DateTime($unformatted_date);
                $week_no = $date->format('w'); //No of day of the week
                $weeks_Name = $date->format('W'); //No of the week  of the year
                $weeks[$week_no] = $weeks_Name;
                // dd($month_Name);
            }
            # code...
        }
        return $weeks;
    }

    public function getWeeklyDriverDistance($week)
    {
        $completedOrders = TravelHistory::whereBetween('date', [
          Carbon::now()->startOfMonth(),
          Carbon::now()->endOfMonth(),
        ]);
        return $completedOrders;
    }
    public function getWeeklyDriverCampaignDistance($week)
    {

        // dd($month);
        $completedOrders = OrderStatusHistory::whereMonth('date_added', $month)->where('orders_status_id', '=', 4)->count();
        return $completedOrders;
    }
    public function getMonthlyReturnOrdersCount($month)
    {
        $completedOrders = OrderStatusHistory::whereMonth('date_added', $month)->where('orders_status_id', '=', 3)->count();
        return $completedOrders;
    }
    public function getMonthlyPengingOrdersCount($month)
    {
        $completedOrders = OrderStatusHistory::whereMonth('date_added', $month)->where('orders_status_id', '=', 1)->count();
        return $completedOrders;
    }

    public function getMonthlyOrdersData()
    {
        $monthlyCompletedOrderData = [];
        $monthlyPendingOrderData = [];
        $monthlyReturnOrderData = [];
        $monthlyCancelledOrderData = [];
        $finalDataArray = [];
        $month_NameArray = [];
        $months = $this->getMonths();
        if (!empty($months)) {
            foreach ($months as $month_no => $month_Name) {
                $monthlycompletedOrders = $this->getMonthlyCompletedOrdersCount($month_no);
                $monthlyreturnedOrders = $this->getMonthlyReturnOrdersCount($month_no);
                $monthlycancelledOrders = $this->getMonthlyCancelledOrdersCount($month_no);
                $monthlypendingOrders = $this->getMonthlyPengingOrdersCount($month_no);
                array_push($monthlyCompletedOrderData, $monthlycompletedOrders);
                array_push($monthlyReturnOrderData, $monthlyreturnedOrders);
                array_push($monthlyCancelledOrderData, $monthlycancelledOrders);
                array_push($monthlyPendingOrderData, $monthlypendingOrders);
                array_push($month_NameArray, $month_Name);
            }
        }
        $month_array = $this->getMonths();
        $max_completed = max($monthlyCompletedOrderData);
        $max_completed = round(($max_completed + 10 / 2) / 10) * 10;
        // dd($max_completed);
        $finalDataArray = [
            'months' => $month_NameArray,
            'completed_orders_count' => $monthlyCompletedOrderData,
            'cancelled_orders_count' => $monthlyCancelledOrderData,
            'returned_orders_count' => $monthlyReturnOrderData,
            'pending_orders_count' => $monthlyPendingOrderData,
            'max' => $max_completed,
        ];

        return $finalDataArray;
    }
}
