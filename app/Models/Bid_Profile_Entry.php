<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid_Profile_Entry extends Model
{
    protected $table='bid_profile_entry';
    public function getParent(){
        return $this->belongsTo('App\Models\Bid_Profile','bid_profile_id');
    }

}
