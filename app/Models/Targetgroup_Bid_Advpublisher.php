<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Targetgroup_Bid_Advpublisher extends Model
{
    protected $table='targetgroup_bid_advpublisher';

    public function getPublisher(){
        return $this->belongsTo('App\Models\Advertiser_Publisher','advertiser_publisher_id');
    }

}
