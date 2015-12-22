<?php
use App\Models\Role_Permission;

class Permission_Check{
    static public function getPermission(){
        $RP_obj = Role_Permission::with('getPermission')
            ->where('role_id', Auth::user()->role_id)
            ->get();
        $arry = array();
        foreach ($RP_obj as $index) {
            array_push($arry, $index->getPermission->name);
        }
        return $arry;
    }
}