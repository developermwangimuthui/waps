<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class CampaignVehicle extends Model
{
    use HasFactory,SoftDeletes,UsesUUID;

    public function campaigns(){
        return $this->belongsTo(Campaign::class);
    }
}
