<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table='campaign';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }

    public function Targetgroup(){
        return $this->hasMany('App\Models\Targetgroup');
    }
}
