<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoSegmentList extends Model
{
    protected $table='geosegmentlist';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }

    public function getGeoEntries(){
        return $this->hasMany('App\Models\GeoSegment','geosegmentlist_id');
    }

}
