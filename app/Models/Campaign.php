<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table='campaign';

    public static $rule=array(
        'name'=>'required',
        'advertiser_domain_name'=>'required',
        'max_impression'=>'required|numeric|min:1',
        'daily_max_impression'=>'required|numeric|min:1',
        'max_budget'=>'required|numeric|min:1',
        'daily_max_budget'=>'required|numeric|min:1',
        'cpm'=>'required|numeric|min:1',
        'date_range'=>'required'

    );

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }

    public function Targetgroup(){
        return $this->hasMany('App\Models\Targetgroup');
    }
}
