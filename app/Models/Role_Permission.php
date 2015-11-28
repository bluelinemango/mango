<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_Permission extends Model
{
    protected $table = 'role_permission_mapping';

    public function getPermission(){
        return $this->belongsTo('App\Models\Permission','permission_id');
    }
}
