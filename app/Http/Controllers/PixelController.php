<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Pixel;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PixelController extends Controller
{

public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_PIXEL', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $pixel_obj = Pixel::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                }else{
                    $usr_company = $this->user_company();
                    $pixel_obj = Pixel::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                }
                return view('pixel.list')->with('pixel_obj',$pixel_obj);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }
    public function PixelAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($advid);
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('pixel.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function add_pixel(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $rndstr=new AuditsController();
                        $pixel = new Pixel();
                        $pixel->name = $request->input('name');
                        $pixel->status = $active;
                        $pixel->advertiser_id = $request->input('advertiser_id');
                        $pixel->version = 'version1';
                        $pixel->part_a = $rndstr->randomStr();
                        $pixel->part_b = $rndstr->randomStr();
                        $pixel->save();
                        $audit= new AuditsController();
                        $audit->store('pixel',$pixel->id,null,'add');
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/pixel/pxl'.$pixel->id.'/edit'))->withErrors(['success' => true, 'msg' => "Pixel added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }


    public function PixelEditView($clid,$advid,$pxlid){
        if(!is_null($pxlid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $pixel_obj = Pixel::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($pxlid);
                    } else {
                        $usr_company = $this->user_company();
                        $pixel_obj = Pixel::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($pxlid);
                        if (!$pixel_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('pixel.edit')->with('pixel_obj', $pixel_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_pixel(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $pixel_id = $request->input('pixel_id');
                    $pixel=Pixel::find($pixel_id);
                    if($pixel){
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $data=array();
                        $audit= new AuditsController();
                        if($pixel->name != $request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$pixel->name);
                            array_push($data,$request->input('name'));
                            $pixel->name=$request->input('name');
                        }
                        if ($pixel->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $pixel->status);
                            array_push($data, $active);
                            $pixel->name = $active;
                        }
                        $audit->store('creative',$pixel_id,$data,'edit');
                        $pixel->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Pixel Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));
    }

    public function jqgrid(Request $request){
        //return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $pixel_id=substr($request->input('id'),3);
                    $chkUser=Pixel::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$pixel_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $pixel=Pixel::find($pixel_id);
                                if($pixel){
                                    $data=array();
                                    $audit= new AuditsController();
                                    if($pixel->name != $request->input('name')){
                                        array_push($data,'name');
                                        array_push($data,$pixel->name);
                                        array_push($data,$request->input('name'));
                                        $pixel->name=$request->input('name');
                                    }
                                    $audit->store('pixel',$pixel_id,$data,'edit');
                                    $pixel->save();
                                    return "ok";
                                }
                                return "false";
                                break;
                        }
                    }
                    return "invalid Creative ID";
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return "don't have permission";
        }
        return Redirect::to(url('/user/login'));
    }

    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity=Pixel::find($id);
                } else {
                    $usr_company = $this->user_company();
                    $entity = Pixel::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->find($id);
                    if(!$entity){
                        return 'please Select your Client';
                    }
                }
                if($entity){
                    $data=array();
                    $audit= new AuditsController();
                    if($entity->status=='Active'){
                        array_push($data,'status');
                        array_push($data,$entity->status);
                        array_push($data,'Inactive');
                        $entity->status='Inactive';
                        $msg='disable';
                    }elseif($entity->status=='Inactive'){
                        array_push($data,'status');
                        array_push($data,$entity->status);
                        array_push($data,'Active');
                        $entity->status='Active';
                        $msg='actived';
                    }
                    $audit->store('pixel',$id,$data,'edit');
                    $entity->save();
                    return $msg;
                }
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }

}
