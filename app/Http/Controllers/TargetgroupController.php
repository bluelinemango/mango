<?php

namespace App\Http\Controllers;

use App\Models\Targetgroup;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TargetgroupController extends Controller
{


    public function GetView(){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $targetgroup = DB::table('targetgroup')
                    ->join('campaign','targetgroup.campaign_id','=','campaign.id')
                    ->join('advertiser','campaign.advertiser_id','=','advertiser.id')
                    ->join('client','advertiser.client_id','=','client.id')
                    ->select('targetgroup.created_at as tcreated_at','targetgroup.id as tid','targetgroup.name as tname','targetgroup.advertiser_domain_name as tadvertiser_domain_name','targetgroup.*','campaign.*','campaign.id as caid','campaign.name as caname','campaign.created_at as cacreated_at','advertiser.id as aid','advertiser.name as aname','advertiser.*','client.name as cname','client.*')
                    ->where('client.user_id',Auth::user()->id)->get();
//                return dd($targetgroup);
                return view('targetgroup.list')->with('targetgroup_obj',$targetgroup)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to('/user/login');
        }
    }

    public function TargetgroupAddView(){
        if(Auth::check()) {
            if (1 == 1) { //      permission goes here
                $campaign_obj = DB::table('campaign')
                    ->join('advertiser','campaign.advertiser_id','=','advertiser.id')
                    ->join('client','advertiser.client_id','=','client.id')
                    ->select('campaign.id as caid','campaign.name as caname','campaign.*','advertiser.id as aid','advertiser.name as aname','advertiser.created_at as acreated_at','advertiser.*','client.name as cname','client.*')
                    ->where('user_id',Auth::user()->id)->get();
                return view('targetgroup.add')->with('campaign_obj',$campaign_obj)->with('permission',\Permission_Check::getPermission());
            }
        }
    }

    public function add_targetgroup(Request $request){
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $start_date = \DateTime::createFromFormat('m/d/Y', $request->input('start_date'));
                    $end_date = \DateTime::createFromFormat('m/d/Y', $request->input('end_date'));
                    $targetgroup=new Targetgroup();
                    $targetgroup->name=$request->input('name');
                    $targetgroup->max_impression=$request->input('max_impression');
                    $targetgroup->daily_max_impression=$request->input('daily_max_impression');
                    $targetgroup->max_budget=$request->input('max_budget');
                    $targetgroup->daily_max_budget=$request->input('daily_max_budget');
                    $targetgroup->cpm=$request->input('cpm');
                    $targetgroup->advertiser_domain_name=$request->input('advertiser_domain_name');
                    $targetgroup->description=$request->input('description');
                    $targetgroup->campaign_id=$request->input('campaign_id');
                    $targetgroup->pacing_plan=$request->input('pacing_plan');
                    $targetgroup->frequency_in_sec=$request->input('frequency_in_sec');
                    $targetgroup->iab_category=$request->input('iab_category');
                    $targetgroup->iab_sub_category=$request->input('iab_sub_category');
                    $targetgroup->start_date=$start_date;
                    $targetgroup->end_date=$end_date;
                    $targetgroup->save();
                    return Redirect::to(url('/targetgroup/edit/'.$targetgroup->id))->withErrors(['success'=>true,'msg'=>"Target Group added successfully"]);
//            }
//            return \Redirect::back()->withErrors(['success'=>false,'msg'=> 'ﮐﺪ اﻣﻨﯿﺘﯽ ﺭا ﻭاﺭﺩ ﮐﻨﯿﺪ']);
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to('/user/login');
        }
    }


    public function TargetgroupEditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $campaign_obj = DB::table('campaign')
                        ->join('advertiser','campaign.advertiser_id','=','advertiser.id')
                        ->join('client','advertiser.client_id','=','client.id')
                        ->select('campaign.id as caid','campaign.name as caname')
                        ->where('user_id',Auth::user()->id)->get();
                    $targetgroup_obj = Targetgroup::with(['getCampaign'=>function($q){
                        $q->with('getAdvertiser');
                    }])->find($id);
//                    return dd($targetgroup_obj);
                    return view('targetgroup.edit')->with('campaign_obj',$campaign_obj)->with('targetgroup_obj',$targetgroup_obj)->with('permission',\Permission_Check::getPermission());
                }
            }
        }
    }

    public function edit_targetgroup(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $targetgroup_id = $request->input('targetgroup_id');
                    $targetgroup=Targetgroup::find($targetgroup_id);
                    if($targetgroup){
                        $start_date = \DateTime::createFromFormat('m/d/Y', $request->input('start_date'));
                        $end_date = \DateTime::createFromFormat('m/d/Y', $request->input('end_date'));
                        $targetgroup->name=$request->input('name');
                        $targetgroup->max_impression=$request->input('max_impression');
                        $targetgroup->daily_max_impression=$request->input('daily_max_impression');
                        $targetgroup->max_budget=$request->input('max_budget');
                        $targetgroup->daily_max_budget=$request->input('daily_max_budget');
                        $targetgroup->cpm=$request->input('cpm');
                        $targetgroup->advertiser_domain_name=$request->input('advertiser_domain_name');
                        $targetgroup->description=$request->input('description');
                        $targetgroup->campaign_id=$request->input('campaign_id');
                        $targetgroup->pacing_plan=$request->input('pacing_plan');
                        $targetgroup->frequency_in_sec=$request->input('frequency_in_sec');
                        $targetgroup->iab_category=$request->input('iab_category');
                        $targetgroup->iab_sub_category=$request->input('iab_sub_category');
                        $targetgroup->start_date=$start_date;
                        $targetgroup->end_date=$end_date;
                        $targetgroup->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Target Group Edited Successfully']);
                    }
                }else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
                }
            }else{
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
            }

        }else{
            return Redirect::to('user/login');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
