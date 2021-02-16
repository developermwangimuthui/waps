<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use HasFactory,SoftDeletes,UsesUUID;


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
