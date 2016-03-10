<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Permission_Check;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $permission;

    public function __construct(){
        $this->permission= Permission_Check::getPermission();
    }
    protected function user_company(){
        $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
//        $arr=array();
//        foreach($usr_company as $index){
//            array_push($arr,$index->id);
//        }
        return $usr_company;
    }
    protected function date_validation($date){
        if(!strpos($date,'-')){
            return false;
        }
        $date_range=explode('-',$date);
        if(!preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/', str_replace(' ','',$date_range[0])) or !preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/', str_replace(' ','',$date_range[1]))){
            return false;
        }
        $d1=explode('/',$date_range[0]);
        $d2=explode('/',$date_range[1]);
        if(!checkdate((int)$d1[0],(int)$d1[1],(int)$d1[2]) or !checkdate((int)$d2[0],(int)$d2[1],(int)$d2[2])){
            return false;
        }
        return true;
    }

}
