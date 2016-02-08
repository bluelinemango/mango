<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Targetgroup extends Model
{
    protected $table = "targetgroup";

    public function getCampaign(){
        return $this->belongsTo('App\Models\Campaign','campaign_id');
    }
    public function getGeoSegment(){
        return $this->hasMany('App\Models\Targetgroup_Geosegmentlist_Map');
    }
    public function getSegment(){
        return $this->hasMany('App\Models\Targetgroup_Segment_Map','Segment_id');
    }
    public function getGeoLocation(){
        return $this->hasMany('App\Models\Targetgroup_Geolocation_Map');
    }
    public function getBidhour(){
        return $this->hasOne('App\Models\Targetgroup_Bidhour_Map');
    }
    public function getBidAdvPublisher(){
        return $this->hasMany('App\Models\Targetgroup_Bid_Advpublisher');
    }
    public function getBWList(){
        return $this->hasMany('App\Models\Targetgroup_Bwlist_Map');
    }
    public function getCreative(){
        return $this->hasMany('App\Models\Targetgroup_Creative_Map');
    }

}
