<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DriverPhoto;
use App\Models\DriverLicense;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\SoftDeletes;
class Driver extends Model
{
    use HasFactory,SoftDeletes,UsesUUID;
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory,SoftDeletes,UsesUUID;
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function driverLicenses(){
        return $this->hasMany(DriverLicense::class);
    }
    public function vehiclePhotos(){
        return $this->hasMany(VehiclePhoto::class);
    }
    public function driverPhotos(){
        return $this->hasMany(DriverPhoto::class);
    }
    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
