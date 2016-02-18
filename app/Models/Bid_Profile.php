<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid_Profile extends Model
{
    protected $table='bid_profile';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }

    public function getEntries(){
        return $this->hasMany('App\Models\Bid_Profile_Entry','bid_profile_id');
    }

}
