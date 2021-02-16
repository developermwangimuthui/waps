<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\TravelHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class TravelHistoryController extends Controller
{
    public function getLongitudeLatitude(Request $request){

        $travel_histories = new TravelHistory();
        $travel_histories->driver_id  = Driver::where('user_id',Auth::user()->id)->pluck('id')->first();
        $travel_histories->longitude = $request->longitude;
        $travel_histories->campaign_id = Driver::where('user_id',Auth::user()->id)->get()->first()->campaign->id;
        $travel_histories->latitude = $request->latitude;
        $travel_histories->type = $request->type;
        // dd($travel_histories->campaign_id);
        if ($travel_histories->save()) {
            return response([
                'error' => false,
                'message' => 'Location taken succesfully!',
            ], Response::HTTP_CREATED);

        }

    }
}
