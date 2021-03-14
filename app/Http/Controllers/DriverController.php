<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\DriverMovement;
use App\Models\User;


class DriverController extends Controller
{

    public function index(Request $request)
    {

        $drivers = Driver::with('driverPhotos', 'vehicles', 'driverLicenses', 'user')->where('status', 1)->get();
        // dd($drivers);
        $onlineDrivers = $this->onlineDrivers();
        $onlineDriverscount = $this->onlineDriversCount();
        $offlineDriverscount = $this->offlineDriversCount();
        $allDriversCount = $this->allDriversCount();
        $newDriverRequests = $this->newDriverRequests();
        $newDriverRequestsCount = $this->newDriverRequestsCount();

        return view('driver.index', compact('drivers', 'onlineDriverscount', 'offlineDriverscount', 'allDriversCount', 'newDriverRequests', 'newDriverRequestsCount'));
    }

    public function show(Request $request, $driver_id)
    {

        $drivers = Driver::with('driverPhotos', 'vehicles', 'driverLicenses', 'user', 'vehiclePhotos')->where([
            ['drivers.id', '=', $driver_id],
            // ['drivers.status','=',1],
        ])->get();
        // dd($drivers);
        return view('driver.show', compact('drivers'));
    }

    //Count all Drivers
    public function allDriversCount()
    {
        return User::with('drivers')->where([
            ['user_type', '=', 2],
            ['status', '=', 1],
        ])->count();
    }
    //Count online Drivers
    public function onlineDriversCount()
    {
        return User::with('drivers')
            ->where([
                ['user_type', '=', 2],
                ['status', '=', 1],
            ])->online()
            ->count();
    }
    //Count offline Drivers
    public function offlineDriversCount()
    {
        return User::with('drivers')->where([
            ['user_type', '=', 2],
            ['status', '=', 1],
        ])->count() - $this->onlineDriversCount();
    }
    //Count online Drivers
    public function onlineDrivers()
    {
        return User::with('drivers')->where([
            ['user_type', '=', 2],
            ['status', '=', 1],
        ])
            ->online()
            ->get();
    }

    public function newDriverRequestsCount()
    {
        return User::with('drivers')->where([
            ['user_type', '=', 2],
            ['status', '=', 0],
        ])->count();
    }
    public function newDriverRequests()
    {
        return User::with('drivers')->where([
            ['user_type', '=', 2],
            ['status', '=', 0],
        ])->get();
    }

    public function approveDriver($driver_id)
    {
        $user_id = Driver::where('id', $driver_id)->pluck('user_id')->first();
        Driver::where('id', $driver_id)->update([
            'status' => 1
        ]);
        User::where('id', $user_id)->update([
            'status' => 1
        ]);
        return redirect()->route('driver.index')->with(['success' => 'Driver Approved']);
    }

    public function movementsMapmarker($driver_id)
    {
        $driverLocation = DriverMovement::where('driver_id', $driver_id)->get();
        $map_markes = array();
        foreach ($driverLocation as $key => $location) {
            $map_markes[] = (object)array(
                'lng' => $location->longitude,
                'lat' => $location->latitude,
            );
        }
        // dd($map_markes);
        return response()->json($map_markes);
    }
    public function movements($driver_id)
    {

        $drivers = Driver::with('user')->where([
            ['drivers.id', '=', $driver_id],
            // ['drivers.status','=',1],
        ])->get();
        // dd($drivers);
        return view('driver.movements', compact('drivers'));
    }
    public function campaignMovements($driver_id, $campaign_id)
    {
        $distanceController = new DistanceController();

        $campaign_name = Campaign::where('id', $campaign_id)->pluck('name')->first();
        $driverusers = User::with('drivers')->where([
            ['users.id', '=', $driver_id],
            // ['drivers.status','=',1],
            ])->get();
            // dd($driverusers);
            $driver_id = Driver::where('user_id', $driver_id)->pluck('id')->first();
            $driverDistanceCoveredInCampaign = $distanceController->getDriverCampaignDistanceCovered($driver_id,$campaign_id);
        // dd($drivers);
        return view('driver.campaignmovements', compact('driverusers', 'driver_id', 'campaign_id', 'campaign_name','driverDistanceCoveredInCampaign'));
    }
}
