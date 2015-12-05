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
    public function getBWList(){
        return $this->hasMany('App\Models\Targetgroup_Bwlist_Map');
    }
    public function getCreative(){
        return $this->hasMany('App\Models\Targetgroup_Creative_Map');
    }

}
