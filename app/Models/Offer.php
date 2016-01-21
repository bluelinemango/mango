<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offer';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }
}
