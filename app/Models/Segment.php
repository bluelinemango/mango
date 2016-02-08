<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $table = 'segment';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }
    public function getModel(){
        return $this->belongsTo('App\Models\ModelTable','model_id');
    }

}
