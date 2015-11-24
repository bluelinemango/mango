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
    public function Model(){
        return $this->hasMany('App\Models\ModelTable');
    }
    public function GeoSegment(){
        return $this->hasMany('App\Models\GeoSegmentList');
    }
    public function BWList(){
        return $this->hasMany('App\Models\BWList');
    }
    public function Creative(){
        return $this->hasMany('App\Models\Creative');
    }


}
