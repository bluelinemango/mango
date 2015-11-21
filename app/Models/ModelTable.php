<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTable extends Model
{
    protected $table = 'model';

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }

}
