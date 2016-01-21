<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pixel extends Model
{
    protected $table = 'pixel';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }
}
