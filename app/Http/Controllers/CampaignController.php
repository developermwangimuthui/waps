<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignDriver;
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
        $activeCampaignsCount = $this->activeCampaignsCount();
        $finishedCampaignsCount = $this->finishedCampaignsCount();
        return view('campaign.index', compact('allCampaignCount', 'campaigns', 'finishedCampaignsCount', 'activeCampaignsCount'));
    }
    public function allCampaignsCount()
    {
        return Campaign::with('campaignVehicles')->count();
    }
    public function activeCampaignsCount()
    {
        return Campaign::with('campaignVehicles')->where([
            ['status', '=', 1],
        ])->count();
    }
    public function finishedCampaignsCount()
    {
        return Campaign::with('campaignVehicles')->where([
            ['status', '=', 2],
        ])->count();
    }
    public function create()
    {
        $drivers_with_campaigns = CampaignDriver::pluck('driver_id');
        // dd($drivers_with_campaigns);
        $user_type = 2;
        $drivers =  Driver::whereHas('user', function($q) use($user_type){

            $q->where('user_type', '=', $user_type);

        })->whereNotIn('id', $drivers_with_campaigns)->
        where('status',1)->get();
        $customers = Customer::with('user')->get();
        return view('campaign.create', compact('customers', 'drivers'));
    }
    public function edit($campaign_id)
    {


        $campaigns = Campaign::with('customer', 'campaignVehicles')->where('id', $campaign_id)->get();

        $drivers_with_campaigns = CampaignDriver::pluck('driver_id');
        // dd($drivers_with_campaigns);
        $user_type = 2;
        $alldrivers = Driver::whereHas('user', function($q) use($user_type){

            $q->where('user_type', '=', $user_type);

        })->whereNotIn('id', $drivers_with_campaigns)->
        where('status',1)->get();

        // dd($alldrivers);
        $campaign_drivers_id = CampaignDriver::where('campaign_id', $campaign_id)->pluck('driver_id');
        $customers = Customer::with('user')->get();
        return view('campaign.edit', compact('customers', 'campaign_drivers_id', 'campaigns', 'alldrivers'));
    }
    public function store(Request $request)
    {
        $driver_ids = $request->driver_id;

        $campaign = new Campaign();
        $campaign->customer_id = $request->customer_id;
        $campaign->name = $request->name;
        $campaign->goal = $request->goal;
        $campaign->status = 1;
        if ($campaign->save()) {
            foreach ($driver_ids as $driver_id) {

                $campaign_drivers = new CampaignDriver();
                $campaign_drivers->campaign_id = $campaign->id;
                $campaign_drivers->driver_id = $driver_id;
                $campaign_drivers->save();
            }
        }
        if ($campaign_drivers->save()) {
            return redirect()->route('campaign.index')->with(['success' => 'Campaign Created Succesfully']);
        } else {

            return redirect()->route('campaign.index')->with(['error' => 'Campaign not Created']);
        }
    }
    public function show($campaign_id)
    {

        $distanceCovered = new DistanceController();
        $distanceCovered = $distanceCovered->getCampaignDistanceCovered($campaign_id);
        // dd($distanceCovered);

        $campaigns = Campaign::with('customer', 'campaignVehicles')->where('id', $campaign_id)->get();

        $campaign_drivers_id = CampaignDriver::where('campaign_id', $campaign_id)->pluck('driver_id');
        // dd($campaign_drivers_id);

        return view('campaign.show', compact('campaigns', 'campaign_drivers_id', 'distanceCovered'));
    }
    public function update(Request $request, $campaign_id)
    {
        // new driver
        $driver_ids = $request->driver_id;
        // existing driver
        $driver_user_ids = $request->driver_user_id;
// both new and existing drivers
        if ($driver_user_ids != null && $driver_ids != null) {
            $current_campaign_drivers_ids = [];
            foreach ($driver_user_ids as $driver_user_id) {
                $current_campaign_drivers_ids[] = Driver::where('user_id', $driver_user_id)->pluck('id')->first();
            }

            if ($current_campaign_drivers_ids != null && $driver_ids != null) {

                $merged = [];
                $merged = array_merge($current_campaign_drivers_ids, $driver_ids);

                if (Campaign::where('id', $campaign_id)->update([
                    'name' => $request->name,
                    'customer_id' => $request->customer_id,
                    'goal' => $request->goal,
                ])) {



                    foreach ($merged as $driver_id) {
                        CampaignDriver::where('campaign_id', $campaign_id,)
                            ->delete();
                    }
                    foreach ($merged as $driver_id) {
                        $campaign_drivers = new CampaignDriver();
                        $campaign_drivers->campaign_id = $campaign_id;
                        $campaign_drivers->driver_id = $driver_id;
                        $campaign_drivers->save();
                    }


                    return redirect()->route('campaign.index')->with(['success' => 'Campaign Updated Succesfully']);
                } else {
                    return redirect()->back()->with(['error' => 'Campaign not Updated']);
                }
            }
            // only current drivers
        } elseif ($driver_user_ids != null && $driver_ids == null) {

            $current_campaign_drivers_ids = [];
            foreach ($driver_user_ids as $driver_user_id) {
                $current_campaign_drivers_ids[] = Driver::where('user_id', $driver_user_id)->pluck('id')->first();
            }


            if ($current_campaign_drivers_ids != null && $driver_ids == null) {

                if (Campaign::where('id', $campaign_id)->update([
                    'name' => $request->name,
                    'customer_id' => $request->customer_id,
                    'goal' => $request->goal,
                ])) {



                    foreach ($current_campaign_drivers_ids as $driver_id) {
                        CampaignDriver::where('campaign_id', $campaign_id,)
                            ->delete();
                    }
                    foreach ($current_campaign_drivers_ids as $driver_id) {
                        $campaign_drivers = new CampaignDriver();
                        $campaign_drivers->campaign_id = $campaign_id;
                        $campaign_drivers->driver_id = $driver_id;
                        $campaign_drivers->save();
                    }


                    return redirect()->route('campaign.index')->with(['success' => 'Campaign Updated Succesfully']);
                } else {
                    return redirect()->back()->with(['error' => 'Campaign not Updated']);
                }
            }

            // only new drivers
        } elseif ($driver_user_ids == null && $driver_ids != null) {



            if (Campaign::where('id', $campaign_id)->update([
                'name' => $request->name,
                'customer_id' => $request->customer_id,
                'goal' => $request->goal,
            ])) {



                foreach ($driver_ids as $driver_id) {
                    CampaignDriver::where('campaign_id', $campaign_id,)
                        ->delete();
                }
                foreach ($driver_ids as $driver_id) {
                    $campaign_drivers = new CampaignDriver();
                    $campaign_drivers->campaign_id = $campaign_id;
                    $campaign_drivers->driver_id = $driver_id;
                    $campaign_drivers->save();
                }


                return redirect()->route('campaign.index')->with(['success' => 'Campaign Updated Succesfully']);
            } else {
                return redirect()->back()->with(['error' => 'Campaign not Updated']);
            }
        }else{


            return redirect()->back()->with(['error' => 'Select Drivers for this Campaign']);


        }
    }
}
