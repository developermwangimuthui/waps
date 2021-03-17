<?php

namespace App\Http\Controllers;

use App\Models\TravelHistory;
use Illuminate\Http\Request;
use DateTime;
use DB;
use Carbon\Carbon;

class ChartController extends Controller
{


    public function getMonths()
    {
        $months = [];
        $distanceMonths = TravelHistory::orderBy('updated_at', 'ASC')->pluck('updated_at');
        $distanceMonths = json_decode($distanceMonths);
        if (!empty($distanceMonths)) {
            foreach ($distanceMonths as $unformatted_date) {
                $date = $unformatted_date;
                $date = new \DateTime($date);
                $month_no = $date->format('m');
                $month_Name = $date->format('M');
                $months[$month_no] = $month_Name;
            }
            # code...
            // dd($months);
        }
        return $months;
    }


    public function getMonthlyDistanceCoverved($month, $campaign_id)
    {
        $distance = new DistanceController();
        $monthlydistanceCovered = $distance->getMonthlyCampaignDistanceCovered($campaign_id,$month);
        return $monthlydistanceCovered;
    }

    public function getMonthlyCampaignDistance($campaign_id)
    {
        $MonthlyDistanceCovervedData = [];
        $finalDataArray = [];
        $month_NameArray = [];
        $months = $this->getMonths();
        if (!empty($months)) {
            foreach ($months as $month_no => $month_Name) {
                $monthlydistanceCovered = $this->getMonthlyDistanceCoverved($month_no, $campaign_id);
                array_push($MonthlyDistanceCovervedData, $monthlydistanceCovered);
                array_push($month_NameArray, $month_Name);
            }
        }
        $month_array = $this->getMonths();
        $max_completed = max($MonthlyDistanceCovervedData);
        $max_completed = round(($max_completed + 10 / 2) / 10) * 10;
        // dd($max_completed);
        $finalDataArray = [
            'months' => $month_NameArray,
            'MonthlyDistanceCovervedData' => $MonthlyDistanceCovervedData,
            'max' => $max_completed,
        ];

        return $finalDataArray;
    }



    // Get daily data

    public function getDays()
    {
        $days = [];
        $distanceDays = TravelHistory::orderBy('updated_at', 'ASC')->pluck('updated_at');
        $distanceDays = json_decode($distanceDays);
        if (!empty($distanceDays)) {
            foreach ($distanceDays as $unformatted_date) {
                $date = $unformatted_date;
                $date = new \DateTime($date);
                $day_no = $date->format('d');
                $day_Name = $date->format('D');
                $days[$day_no] = $day_Name;
            }
            # code...
            // dd($months);
        }
        return $days;
    }
    public function getDailyDistanceCoverved($month, $campaign_id)
    {
        $distance = new DistanceController();
        $dailydistanceCovered = $distance->getDailyCampaignDistanceCovered($campaign_id,$month);
        return $dailydistanceCovered;
    }

    public function getDailyCampaignDistance($campaign_id)
    {
        $DailyDistanceCovervedData = [];
        $finalDataArray = [];
        $day_NameArray = [];
        $days = $this->getDays();
        if (!empty($days)) {
            foreach ($days as $day_no => $day_Name) {
                $monthlydistanceCovered = $this->getDailyDistanceCoverved($day_no, $campaign_id);
                array_push($DailyDistanceCovervedData, $monthlydistanceCovered);
                array_push($day_NameArray, $day_Name);
            }
        }
        $days_array = $this->getDays();
        $max_completed = max($DailyDistanceCovervedData);
        $max_completed = round(($max_completed + 10 / 2) / 10) * 10;
        // dd($max_completed);
        $finalDataArray = [
            'days' => $day_NameArray,
            'DailyDistanceCovervedData' => $DailyDistanceCovervedData,
            'max' => $max_completed,
        ];

        return $finalDataArray;
    }

}
