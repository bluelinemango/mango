<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BWEntries extends Model
{
    protected $table='bwentries';

    public function getParent(){
        return $this->belongsTo('App\Models\BWList','bwlist_id');
    }

}
