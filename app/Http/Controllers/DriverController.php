<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{

    public function index(Request $request)
    {
        $drivers = Driver::with('driverPhotos','vehicles','driverLicenses','user')->get();
        
        return view('driver.index');
    }
}
