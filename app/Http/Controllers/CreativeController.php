<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Creative;
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
            if(1==1){ //permission goes here
                $creative=Creative::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->get();
//                return dd($targetgroup);
                return view('creative.list')->with('creative_obj',$creative)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to(url('/user/login'));
        }
    }
    public function CreativeAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if (1 == 1) { //      permission goes here
                    $chkUser = Advertiser::with('GetClientID')->find($advid);
                    if (count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                        return view('creative.add')->with('advertiser_obj', $advertiser_obj)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
            }
        }
    }

    public function add_creative(Request $request){
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
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
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/creative/crt'.$creative->id.'/edit'))->withErrors(['success' => true, 'msg' => "Creative added successfully"]);
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
//            }
//            return \Redirect::back()->withErrors(['success'=>false,'msg'=> 'ﮐﺪ اﻣﻨﯿﺘﯽ ﺭا ﻭاﺭﺩ ﮐﻨﯿﺪ']);
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to(url('/user/login'));
        }
    }


    public function CreativeEditView($clid,$advid,$crtid){
        if(!is_null($crtid)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $creative_obj = Creative::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($crtid);
//                    return dd($targetgroup_obj);
                        return view('creative.edit')->with('creative_obj', $creative_obj)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
            }
        }
    }

    public function edit_creative(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $creative_id = $request->input('creative_id');
                    $creative=Creative::find($creative_id);
                    if($creative){
                        $size = $request->input('size_width').'x'.$request->input('size_height');
                        $creative->name=$request->input('name');
                        $creative->advertiser_domain_name=$request->input('advertiser_domain_name');
                        $creative->description=$request->input('description');
                        $creative->landing_page_url=$request->input('landing_page_url');
                        $creative->preview_url=$request->input('preview_url');
                        $creative->attributes=$request->input('attributes');
                        $creative->ad_tag=$request->input('ad_tag');
                        $creative->size=$size;
                        $creative->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Creative Edited Successfully']);
                    }
                }else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
                }
            }else{
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
            }

        }else{
            return Redirect::to(url('/user/login'));
        }
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
