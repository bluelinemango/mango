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

}
