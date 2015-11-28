<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Targetgroup extends Model
{
    protected $table = "targetgroup";

    public function getCampaign(){
        return $this->belongsTo('App\Models\Campaign','campaign_id');
    }
}
