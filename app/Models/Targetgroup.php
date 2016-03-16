<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Targetgroup extends Model
{
    protected $table = "targetgroup";

    public static $rules=array(
        'name'=>'required',
        'advertiser_domain_name'=>'required',
        'iab_category'=>'required',
        'iab_sub_category'=>'required',
        'max_impression'=>'required|numeric|min:1',
        'daily_max_impression'=>'required|numeric|min:1',
        'max_budget'=>'required|numeric|min:1',
        'daily_max_budget'=>'required|numeric|min:1',
        'cpm'=>'required|numeric|min:1',
        'frequency_in_sec'=>'required|numeric|min:1',
        'pacing_plan'=>'required|numeric|min:1',
        'date_range'=>'required'

    );

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
    public function getBidProfile(){
        return $this->hasMany('App\Models\Targetgroup_Bidprofile_Map','bid_profile_id');
    }

}
