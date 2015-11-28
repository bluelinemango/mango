<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    //
    protected $table = 'creative';


    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }


}
