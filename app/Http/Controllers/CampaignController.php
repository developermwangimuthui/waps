<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function index(Request $request)
    {
       return view('campaign.index');
    }
}
