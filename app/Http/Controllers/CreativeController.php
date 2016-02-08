<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Creative;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CreativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_CREATIVE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $creative = Creative::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                }else{
                    $usr_company = $this->user_company();
                    $creative = Creative::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                }
                return view('creative.list')->with('creative_obj',$creative);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }
    public function CreativeAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
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
                    return view('creative.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function add_creative(Request $request){
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
                        $size = $request->input('size_width') . 'x' . $request->input('size_height');
                        $creative = new Creative();
                        $creative->name = $request->input('name');
                        $creative->advertiser_domain_name = $request->input('advertiser_domain_name');
                        $creative->description = $request->input('description');
                        $creative->advertiser_id = $request->input('advertiser_id');
                        $creative->size = $size;
                        $creative->status = $active;
                        $creative->ad_tag = $request->input('ad_tag');
                        $creative->ad_type = $request->input('ad_type');
                        $creative->api = json_encode($request->input('api'));
                        $creative->landing_page_url = $request->input('landing_page_url');
                        $creative->preview_url = $request->input('preview_url');
                        $creative->attributes = $request->input('attributes');
                        $creative->save();
                        $audit= new AuditsController();
                        $audit->store('creative',$creative->id,null,'add');
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/creative/crt'.$creative->id.'/edit'))->withErrors(['success' => true, 'msg' => "Creative added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }


    public function CreativeEditView($clid,$advid,$crtid){
        if(!is_null($crtid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $creative_obj = Creative::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($crtid);
                    } else {
                        $usr_company = $this->user_company();
                        $creative_obj = Creative::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($crtid);
                        if (!$creative_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('creative.edit')
                        ->with('api_select', json_decode($creative_obj->api))
                        ->with('creative_obj', $creative_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_creative(Request $request){
//        return dd($request->all());
//        return dd(json_encode($request->input('api')));
        if(Auth::check()){
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $creative_id = $request->input('creative_id');
                    $creative=Creative::find($creative_id);
                    if($creative){
                        $size = $request->input('size_width').'x'.$request->input('size_height');
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }

                        $data=array();
                        $audit= new AuditsController();
                        if($creative->name != $request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$creative->name);
                            array_push($data,$request->input('name'));
                            $creative->name=$request->input('name');
                        }
                        if ($creative->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $creative->status);
                            array_push($data, $active);
                            $creative->name = $active;
                        }
                        if($creative->ad_type!=$request->input('ad_type')){
                            array_push($data,'Ad Type');
                            array_push($data,$creative->ad_type);
                            array_push($data,$request->input('ad_type'));
                            $creative->ad_type=$request->input('ad_type');
                        }
                        if($creative->api!=json_encode($request->input('api'))){
                            array_push($data,'API');
                            array_push($data,$creative->api);
                            array_push($data,json_encode($request->input('api')));
                            $creative->api=json_encode($request->input('api'));
                        }
                        if($creative->advertiser_domain_name!=$request->input('advertiser_domain_name')){
                            array_push($data,'Domain Name');
                            array_push($data,$creative->advertiser_domain_name);
                            array_push($data,$request->input('advertiser_domain_name'));
                            $creative->advertiser_domain_name=$request->input('advertiser_domain_name');
                        }
                        if($creative->description!=$request->input('description')){
                            array_push($data,'Description');
                            array_push($data,$creative->description);
                            array_push($data,$request->input('description'));
                            $creative->description=$request->input('description');
                        }
                        if($creative->landing_page_url!=$request->input('landing_page_url')){
                            array_push($data,'Landing Page URL');
                            array_push($data,$creative->landing_page_url);
                            array_push($data,$request->input('landing_page_url'));
                            $creative->landing_page_url=$request->input('landing_page_url');
                        }
                        if($creative->preview_url!=$request->input('preview_url')){
                            array_push($data,'Preview URL');
                            array_push($data,$creative->preview_url);
                            array_push($data,$request->input('preview_url'));
                            $creative->preview_url=$request->input('preview_url');
                        }
                        if($creative->attributes!=$request->input('attributes')){
                            array_push($data,'Attributes');
                            array_push($data,$creative->attributes);
                            array_push($data,$request->input('attributes'));
                            $creative->attributes=$request->input('attributes');
                        }
                        if($creative->ad_tag!=$request->input('ad_tag')){
                            array_push($data,'AD Tag');
                            array_push($data,$creative->ad_tag);
                            array_push($data,$request->input('ad_tag'));
                            $creative->ad_tag=$request->input('ad_tag');
                        }
                        if($creative->size!=$size){
                            array_push($data,'Size');
                            array_push($data,$creative->size);
                            array_push($data,$size);
                            $creative->size=$size;
                        }
                        $audit->store('creative',$creative_id,$data,'edit');
                        $creative->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Creative Edited Successfully']);
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
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $creative_id=substr($request->input('id'),3);
                    if (User::isSuperAdmin()) {
                        $creative=Creative::find($creative_id);
                    }else{
                        $usr_company = $this->user_company();
                        $creative=Creative::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($creative_id);
                        if (!$creative) {
                            return $msg=(['success' => false, 'msg' => "Some things went wrong"]);
                        }
                    }
                    if ($creative) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($creative->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $creative->name);
                            array_push($data, $request->input('name'));
                            $creative->name = $request->input('name');
                        }
                        $audit->store('creative', $creative_id, $data, 'edit');
                        $creative->save();
                        return $msg=(['success' => true, 'msg' => "your Creative Saved successfully"]);
                    }
                    return $msg=(['success' => false, 'msg' => "Please Select a Creative First"]);
                }
                return $msg=(['success' => false, 'msg' => "Please Check your field"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity=Creative::find($id);
                } else {
                    $usr_company = $this->user_company();
                    $entity = Creative::whereHas('getAdvertiser' , function ($q) use($usr_company) {
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
                    $audit->store('creative',$id,$data,'edit');
                    $entity->save();
                    return $msg;
                }
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }

}
