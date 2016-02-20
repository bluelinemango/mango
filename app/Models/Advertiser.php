<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    protected $table='advertiser';

    public function GetClientID(){
        return $this->belongsTo('App\Models\Client','client_id');
    }

    public function Campaign(){
        return $this->hasMany('App\Models\Campaign');
    }
    public function Segment(){
        return $this->hasMany('App\Models\Segment');
    }
    public function Model(){
        return $this->hasMany('App\Models\ModelTable');
    }
    public function GeoSegment(){
        return $this->hasMany('App\Models\GeoSegmentList','advertiser_id');
    }
    public function BidProfile(){
        return $this->hasMany('App\Models\Bid_Profile','advertiser_id');
    }
    public function BWList(){
        return $this->hasMany('App\Models\BWList','advertiser_id');
    }
    public function Creative(){
        return $this->hasMany('App\Models\Creative');
    }


}
