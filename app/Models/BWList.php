<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BWList extends Model
{
    protected $table='bwlist';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }

    public function getEntries(){
        return $this->hasMany('App\Models\BWEntries','bwlist_id');
    }

}
