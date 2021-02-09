<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use Illuminate\Database\Eloquent\SoftDeletes;
class DriverPhoto extends Model
{
    use HasFactory,SoftDeletes,UsesUUID;
    public function driver(){
        return $this->belongsTo(Driver::class);
    }
}
