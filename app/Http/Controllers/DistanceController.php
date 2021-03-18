<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\CampaignDriver;
use App\Models\TravelHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
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
    public function getMonthlyCampaignDistanceCovered($campaign_id,$month)
    {
        $distance = [];
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::whereMonth('updated_at', $month)->where('campaign_id', $campaign_id)->pluck('latitude');

        // dd($latitudes);
        $longitude = TravelHistory::whereMonth('updated_at', $month)->where('campaign_id', $campaign_id)->pluck('longitude');

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
        }
        $distance_covered = array_sum ($distance);
        return $distance_covered;
    }
    public function getDailyCampaignDistanceCovered($campaign_id,$day)
    {
        $distance = [];
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::whereMonth('updated_at', $day)->where('campaign_id', $campaign_id)->pluck('latitude');

        // dd($latitudes);
        $longitude = TravelHistory::whereMonth('updated_at', $day)->where('campaign_id', $campaign_id)->pluck('longitude');

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
        }
        $distance_covered = array_sum ($distance);
        return $distance_covered;
    }
    public function getCampaignDistanceCovered($campaign_id)
    {
        $distance = [];
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('latitude');

        // dd($latitudes);
        $longitude = TravelHistory::where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('longitude');

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
        }
        $distance_covered = array_sum ($distance);
        return $distance_covered;
    }
    public function getDriverCampaignDistanceCovered($driver_id,$campaign_id)
    {
        $distance = [];
        // $driver_id = '29fec41d-47c4-4590-aa46-206dd5832b08';
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::where('driver_id', $driver_id)->where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('latitude');
        $longitude = TravelHistory::where('driver_id', $driver_id)->where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('longitude');
        // dd($latitudesCount);
        // dd($latitudes,$longitude);
        // dd($longitude);
        // dd(sizeof($latitudes));

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
            // dd($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1]);
        }

        $distance_covered = array_sum ($distance);
        // dd($distance_covered);
        if (Str::startsWith(request()->path(), 'api')) {
            return response([
                'error' => False,
                'message' => 'Success',
                'distance_covered' => $distance_covered
            ], Response::HTTP_OK);

        }
        return $distance_covered;
    }
    public function getDriverCampaignDistanceCoveredApi(Request $request)
    {

        $driver_id = Driver::where('user_id', Auth::user()->id)->pluck('id')->first();
        $campaign_id = CampaignDriver::where('driver_id', $driver_id)->pluck('campaign_id')->first();
        $distance = [];
        // $driver_id = '29fec41d-47c4-4590-aa46-206dd5832b08';
        $latitudesCount = TravelHistory::pluck('latitude')->count();
        $latitudes = TravelHistory::where('driver_id', $driver_id)->where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('latitude');
        $longitude = TravelHistory::where('driver_id', $driver_id)->where('campaign_id', $campaign_id)->orderBy('created_at', 'DESC')->pluck('longitude');
        // dd($latitudesCount);
        // dd($latitudes,$longitude);
        // dd($longitude);
        // dd(sizeof($latitudes));

        for ($i = 0; $i < sizeof($latitudes) - 1; $i++) {

            $distance[] = $this->distance($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1], "K");
            // dd($latitudes[$i], $longitude[$i], $latitudes[$i + 1], $longitude[$i + 1]);
        }

        $distance_covered = array_sum ($distance);
        // dd($distance_covered);
        if (Str::startsWith(request()->path(), 'api')) {
            return response([
                'error' => False,
                'message' => 'Success',
                'distance_covered' => $distance_covered
            ], Response::HTTP_OK);

        }
        return $distance_covered;
    }

    public function campaignMapMarker($campaign_id){
        $campaignLocation = TravelHistory::where('campaign_id', $campaign_id)->get();
        $map_markes = array ();
        foreach ($campaignLocation as $key => $location) {
            $map_markes[] = (object)array(
                'lng' => $location->longitude,
                'lat' => $location->latitude,
            );
        }
        return response()->json($map_markes);
    }
    public function drivercampaignMapMarker($driver_id,$campaign_id){
        $campaignLocation = TravelHistory::where('campaign_id', $campaign_id)->where('driver_id',$driver_id)->get();
        $map_markes = array ();
        foreach ($campaignLocation as $key => $location) {
            $map_markes[] = (object)array(
                'lng' => $location->longitude,
                'lat' => $location->latitude,
            );
        }
        return response()->json($map_markes);
    }
}
