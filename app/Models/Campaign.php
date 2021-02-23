<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes, UsesUUID;
    public function campaignVehicles()
    {
        return $this->hasMany(CampaignVehicle::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
