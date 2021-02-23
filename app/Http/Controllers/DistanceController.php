<?php

namespace App\Http\Controllers;

use App\Models\TravelHistory;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function todayCampaingDistance()
    {
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
    public function getCampaignDistanceCovered($campaign_id)
    {
        $distance = [];
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('latitude');
        $longitude = TravelHistory::where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('longitude');

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
        }
        $distance_covered = array_sum ($distance);
        return $distance_covered;
    }
    public function getDriverCampaignDistanceCovered($driver_id)
    {
        $distance = [];
        $driver_id = '29fec41d-47c4-4590-aa46-206dd5832b08';
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::where('driver_id', $driver_id)->orderBy('created_at', 'DESC')->pluck('latitude');
        $longitude = TravelHistory::where('driver_id', $driver_id)->orderBy('created_at', 'DESC')->pluck('longitude');
        // dd($latitudesCount);
        // dd(sizeof($latitudes));

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
        }
        $distance_covered = array_sum ($distance);
        return $distance_covered;
    }
}
