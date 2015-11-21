<?php
class Permission_Check{
    static public function getPermission(){
        $RP_obj = \App\Models\Role_Permission::with('getPermission')->where('role_id',\Illuminate\Support\Facades\Auth::user()->role_id)->get();
        return $RP_obj;
    }
}