<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audits extends Model
{
    protected $table='audits';

    public function getUser(){
        return $this->belongsTo('App\Models\user','user_id');
    }

}
