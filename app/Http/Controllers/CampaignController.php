<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignVehicle;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function index(Request $request)
    {
        $campaigns = Campaign::with('campaignVehicles', 'customer')->get();

        $allCampaignCount = $this->allCampaignsCount();
        return view('campaign.index', compact('allCampaignCount','campaigns'));
    }
    public function allCampaignsCount()
    {
        return Campaign::with('campaignVehicles')->where([
            ['status', '=', 1],
        ])->count();
    }
    public function create()
    {
        $drivers = Driver::with('user', 'vehicles')->get();
        // dd($drivers);
        $customers = Customer::with('user')->get();
        return view('campaign.create', compact('customers', 'drivers'));
    }
    public function store(Request $request)
    {
        $campaign = new Campaign();
        $campaign->customer_id = $request->customer_id;
        $campaign->name = $request->name;
        $campaign->goal = $request->goal;
        $campaign->status = 1;
        if ($campaign->save()) {
            $campaign_vehicles = new CampaignVehicle();
            $campaign_vehicles->campaign_id = $campaign->id;
            $campaign_vehicles->vehicle_id = $request->vehicle_id;
        }
        if ($campaign_vehicles->save()) {
            return redirect()->route('campaign.index')->with(['success' => 'Campaign Created Succesfully']);
        } else {

            return redirect()->route('campaign.index')->with(['error' => 'Campaign not Created']);
        }
    }

}
