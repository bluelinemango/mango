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
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $creative = Creative::with(['getAdvertiser' => function ($q) use($usr_company) {
                        $q->with(['GetClientID' => function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        }]);
                    }])->get();
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
                    $chkUser = Advertiser::with('GetClientID')->find($advid);
                    if (count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                        return view('creative.add')->with('advertiser_obj', $advertiser_obj);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
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
                        $size = $request->input('size_width') . 'x' . $request->input('size_height');
                        $creative = new Creative();
                        $creative->name = $request->input('name');
                        $creative->advertiser_domain_name = $request->input('advertiser_domain_name');
                        $creative->description = $request->input('description');
                        $creative->advertiser_id = $request->input('advertiser_id');
                        $creative->size = $size;
                        $creative->ad_tag = $request->input('ad_tag');
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
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $creative_obj = Creative::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($crtid);
                        return view('creative.edit')->with('creative_obj', $creative_obj);
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_creative(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $creative_id = $request->input('creative_id');
                    $creative=Creative::find($creative_id);
                    if($creative){
                        $size = $request->input('size_width').'x'.$request->input('size_height');

                        $data=array();
                        $audit= new AuditsController();
                        if($creative->name != $request->input('name')){
                            array_push($data,'name');
                            array_push($data,$creative->name);
                            array_push($data,$request->input('name'));
                            $creative->name=$request->input('name');
                        }
                        if($creative->advertiser_domain_name!=$request->input('advertiser_domain_name')){
                            array_push($data,'advertiser_domain_name');
                            array_push($data,$creative->advertiser_domain_name);
                            array_push($data,$request->input('advertiser_domain_name'));
                            $creative->advertiser_domain_name=$request->input('advertiser_domain_name');
                        }
                        if($creative->description!=$request->input('description')){
                            array_push($data,'description');
                            array_push($data,$creative->description);
                            array_push($data,$request->input('description'));
                            $creative->description=$request->input('description');
                        }
                        if($creative->landing_page_url!=$request->input('landing_page_url')){
                            array_push($data,'landing_page_url');
                            array_push($data,$creative->landing_page_url);
                            array_push($data,$request->input('landing_page_url'));
                            $creative->landing_page_url=$request->input('landing_page_url');
                        }
                        if($creative->preview_url!=$request->input('preview_url')){
                            array_push($data,'preview_url');
                            array_push($data,$creative->preview_url);
                            array_push($data,$request->input('preview_url'));
                            $creative->preview_url=$request->input('preview_url');
                        }
                        if($creative->attributes!=$request->input('attributes')){
                            array_push($data,'attributes');
                            array_push($data,$creative->attributes);
                            array_push($data,$request->input('attributes'));
                            $creative->attributes=$request->input('attributes');
                        }
                        if($creative->ad_tag=$request->input('ad_tag')){
                            array_push($data,'ad_tag');
                            array_push($data,$creative->ad_tag);
                            array_push($data,$request->input('ad_tag'));
                            $creative->ad_tag=$request->input('ad_tag');
                        }
                        if($creative->size!=$size){
                            array_push($data,'size');
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
                    $chkUser=Creative::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$creative_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $creative=Creative::find($creative_id);
                                if($creative){
                                    $creative->name=$request->input('name');
                                    $creative->size=$request->input('size');
                                    $creative->save();
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
