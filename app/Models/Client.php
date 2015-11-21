<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='client';

    public function client_user_id(){
        return $this->belongsTo('App\Models\User');
    }

    public function getAdvertiser(){
        return $this->hasMany('App\Models\Advertiser');
    }
}
