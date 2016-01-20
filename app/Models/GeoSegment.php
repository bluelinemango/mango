<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoSegment extends Model
{
    protected $table='geosegment';

    public function getParent(){
        return $this->belongsTo('App\Models\GeoSegmentList','geosegmentlist_id');
    }

}
