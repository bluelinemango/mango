<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Audits;
use App\Models\Creative;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;



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
                    $audit= Audits::with('getUser')->where('entity_type','creative')->orderBy('created_at','DESC')->get();
                }else{
                    $usr_company = $this->user_company();
                    $creative = Creative::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    $audit= Audits::with('getUser')->where('entity_type','creative')->whereIn('user_id', $usr_company)->orderBy('created_at','DESC')->get();
                }
                $audit_obj= array();
                if($audit) {
                    $sub = new AuditsController();
                    $audit_obj = $sub->SubAudit($audit);
                }
                return view('creative.list')
                    ->with('audit_obj',$audit_obj)
                    ->with('creative_obj',$creative);
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
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    if($advertiser_obj) {
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
                        return Redirect::to(url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/creative/crt'.$creative->id.'/edit'))->withErrors(['success' => true, 'msg' => "Creative added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function CreativeEditView($clid,$advid,$crtid,$clone=0){
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
                    $api_select=array();
                    if(!is_null(json_decode($creative_obj->api))){
                        $api_select = json_decode($creative_obj->api);
                    }
                    return view('creative.edit')
                        ->with('api_select', $api_select)
                        ->with('clone', $clone)
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
                    if (User::isSuperAdmin()) {
                        $creative=Creative::find($creative_id);
                    } else {
                        $usr_company = $this->user_company();
                        $creative = Creative::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($creative_id);
                        if (!$creative) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
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
                            $creative->status = $active;
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

    public function UploadCreative(Request $request){

        if(Auth::check()){
            if(in_array('ADD_EDIT_CREATIVE',$this->permission)) {
                if($request->hasFile('upload')) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    if($advertiser_obj) {
                        $destpath=public_path();
                        $extension = $request->file('upload')->getClientOriginalExtension(); // getting image extension
                        $fileName = str_random(32).'.'.$extension;
                        $request->file('upload')->move($destpath.'/cdn/test/', $fileName);
                        Config::set('excel.import.startRow',12);
                        $upload = Excel::load('public/cdn/test/' . $fileName, function ($reader) {
                        })->get();
                        $t = array();
                        foreach ($upload[0] as $key => $value) {
                            array_push($t, $key);
                        }

                        if ($t[1] != 'name' or $t[2] != 'ad_tag' or $t[3] != 'landing_page_url'or $t[4] != 'preview_url' or $t[5] != 'size' or $t[6] != 'attributes' or $t[7] != 'advertiser_domain_name' or $t[8] != 'status' or $t[9] != 'api' or $t[10] != 'ad_type') {
                            File::delete($destpath . '/cdn/test/' . $fileName);
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please be sure that file is correct'])->withInput();
                        }
                        $bad_input=array();
                        $count=0;
                        foreach ($upload as $test) {
                            $flg=0;
                            $creative = new Creative();
                            if($test['name']=='' or $test['ad_tag']=='' or  $test['landing_page_url']=='' or $test['preview_url']=='' or $test['size']=='' or $test['attributes']=='' or $test['advertiser_domain_name']=='' or $test['status']=='' or $test['api']=='' or $test['ad_type']=='' ) {
                                array_push($bad_input, $test['name']);
                                continue;
                            }
                            if(strcasecmp($test['status'], 'active')!=0 and strcasecmp($test['status'], 'inactive')!=0){
                                array_push($bad_input,$test['name']);
                                continue;
                            }
                            $api=explode(',',$test['api']);

                            if(is_array($api)) {
                                foreach ($api as $index) {
                                    if (strcasecmp($index, 'VPAID_1.0') != 0 and strcasecmp($index, 'VPAID_2.0') != 0 and strcasecmp($index, 'MRAID-1') != 0 and strcasecmp($index, 'ORMMA') != 0 and strcasecmp($index, 'MRAID-2') != 0) {
                                        array_push($bad_input,$test['name']);
                                        $flg=1;
                                    }
                                }
                                if($flg==1){
                                    $flg=0;
                                    continue;
                                }
                            }else{
                                array_push($bad_input,$test['name']);
                                continue;
                            }
                            if(strcasecmp($test['ad_type'], 'IFRAME')!=0 and strcasecmp($test['ad_type'], 'JAVASCRIPT')!=0 and strcasecmp($test['ad_type'], 'XHTML_BANNER_AD')!=0 and strcasecmp($test['ad_type'], 'XHTML_TEXT_AD')!=0){
                                array_push($bad_input,$test['name']);
                                return dd('ss2');
                                continue;
                            }
                            $size=explode('x',$test['size']);
                            if(!is_array($size) or count($size)<>2 or (is_array($size) and count($size)==2 and !is_numeric($size[0])) or (is_array($size) and count($size)==2 and !is_numeric($size[1]))){
                                array_push($bad_input,$test['name']);
                                continue;
                            }
                            $creative->name = $test['name'];
                            $creative->ad_tag = $test['ad_tag'];
                            $creative->landing_page_url = $test['landing_page_url'];
                            $creative->preview_url = $test['preview_url'];
                            $creative->size = $size[0].'x'.$size[1];
                            $creative->attributes = $test['attributes'];
                            $creative->advertiser_domain_name = $test['advertiser_domain_name'];
                            $creative->status = ucwords(strtolower($test['status']));
                            $creative->api = '['.strtoupper(implode(',',$api)).']';
                            $creative->ad_type = strtoupper($test['ad_type']);
                            $creative->advertiser_id = $request->input('advertiser_id');
                            $creative->save();
                            $count++;
                        }
                        $audit=new AuditsController();
                        $audit->store('creative',0,$count,'bulk_add');
                        $msg = "Creatives added successfully";
                        if(count($bad_input)>0){
                            $msg.=" exept: ";
                            foreach($bad_input as $index){
                                $msg .=$index.',';
                            }
                        }
                        return Redirect::back()->withErrors(['success' => true, 'msg' => $msg]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select Advertiser First'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select a file'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

}
