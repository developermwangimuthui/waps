<?php

namespace App\Http\Controllers;

use App\Models\CampaignDriver;
use App\Models\Driver;
use App\Models\DriverMovement;
use App\Models\TravelHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TravelHistoryController extends Controller
{
    public function getLongitudeLatitude(Request $request)
    {

        $driver_id = Driver::where('user_id', Auth::user()->id)->pluck('id')->first();
        $campaign_id = CampaignDriver::where('driver_id', $driver_id)->pluck('campaign_id')->first();

                // getting auth user after auth login
                $user = Auth::user();
                //Create a log that the user has visited the site
                visitor()->visit();
        //    dd($campaign_id);
        if ($campaign_id != null) {
            $travel_histories = new TravelHistory();
            $travel_histories->driver_id  = Driver::where('user_id', Auth::user()->id)->pluck('id')->first();
            $travel_histories->longitude = $request->longitude;
            $travel_histories->campaign_id = $campaign_id;
            $travel_histories->latitude = $request->latitude;
            $travel_histories->type = $request->type;
            if ($travel_histories->save()) {
                $drivermovement = new DriverMovement();
                $drivermovement->driver_id  = Driver::where('user_id', Auth::user()->id)->pluck('id')->first();
                $drivermovement->longitude = $request->longitude;
                $drivermovement->latitude = $request->latitude;
                $drivermovement->type = $request->type;
            }

            if ($drivermovement->save()) {
                return response([
                    'error' => false,
                    'message' => 'Location taken succesfully!',
                ], Response::HTTP_CREATED);
            }
        } else {
            $drivermovement = new DriverMovement();
            $drivermovement->driver_id  = Driver::where('user_id', Auth::user()->id)->pluck('id')->first();
            $drivermovement->longitude = $request->longitude;
            $drivermovement->latitude = $request->latitude;
            $drivermovement->type = $request->type;
            if ($drivermovement->save()) {
                return response([
                    'error' => false,
                    'message' => 'Location taken succesfully!',
                ], Response::HTTP_CREATED);
            }
        }
    }
}
