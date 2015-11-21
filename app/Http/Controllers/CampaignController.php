<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetView(){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $campaign = DB::table('campaign')
                    ->join('advertiser','campaign.advertiser_id','=','advertiser.id')
                    ->join('client','advertiser.client_id','=','client.id')
                    ->select('campaign.*','campaign.id as caid','campaign.name as caname','campaign.created_at as cacreated_at','advertiser.id as aid','advertiser.name as aname','advertiser.created_at as acreated_at','advertiser.*','client.name as cname','client.id as cid','client.*')
                    ->orderBy('max_budget','desc')
                    ->where('client.user_id',Auth::user()->id)->get();
//                return dd($campaign);
                return view('campaign.list')->with('campaign_obj',$campaign)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to('/user/login');
        }


    }

    public function CampaignAddView($clid,$advid){
        if(Auth::check()) {
            if (1 == 1) { //      permission goes here
                $chkUser = Advertiser::with('GetClientID')->find($advid);
                if(count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                    $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                    return view('campaign.add')->with('advertiser_obj', $advertiser_obj)->with('permission', \Permission_Check::getPermission());
                } else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
            }
        }
    }

    public function add_campaign(Request $request){
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $start_date = \DateTime::createFromFormat('m/d/Y', $request->input('start_date'));
                        $end_date = \DateTime::createFromFormat('m/d/Y', $request->input('end_date'));
                        $campaign = new Campaign();
                        $campaign->name = $request->input('name');
                        $campaign->max_impression = $request->input('max_impression');
                        $campaign->daily_max_impression = $request->input('daily_max_impression');
                        $campaign->max_budget = $request->input('max_budget');
                        $campaign->daily_max_budget = $request->input('daily_max_budget');
                        $campaign->cpm = $request->input('cpm');
                        $campaign->advertiser_domain_name = $request->input('advertiser_domain_name');
                        $campaign->description = $request->input('description');
                        $campaign->advertiser_id = $request->input('advertiser_id');
                        $campaign->start_date = $start_date;
                        $campaign->end_date = $end_date;
                        $campaign->save();
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/campaign/cmp'.$campaign->id.'/edit'))->withErrors(['success' => true, 'msg' => "Campaign added successfully"]);
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
            return Redirect::to('/user/login');
        }
    }


    public function DeleteCampaign($id){
        if(Auth::check()){
            if(1==1) { //      permission goes here
                Campaign::where('id',$id)->delete();
                return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Campaign Deleted Successfully']);
            }
        }else{
            return Redirect::to('user/login');
        }
    }

    public function CampaignEditView($clid,$advid,$cmpid){
        if(!is_null($cmpid)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
//                    $advertiser_obj = DB::table('advertiser')
//                        ->join('client','advertiser.client_id','=','client.id')
//                        ->select('advertiser.id as aid','advertiser.name as aname','advertiser.created_at as acreated_at','advertiser.*','client.name as cname','client.*')
//                        ->where('user_id',Auth::user()->id)->get();
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $campaign_obj = Campaign::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->with('Targetgroup')->find($cmpid);
//                        return dd($campaign_obj);
                        return view('campaign.edit')->with('campaign_obj', $campaign_obj)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
            }
        }
    }
    public function edit_campaign(Request $request){
//        $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $campaign_id = $request->input('campaign_id');
                    $campaign=Campaign::find($campaign_id);
                    if($campaign){
                        $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
                        $end_date = \DateTime::createFromFormat('d.m.Y', $request->input('end_date'));
                        $campaign->name=$request->input('name');
                        $campaign->max_impression=$request->input('max_impression');
                        $campaign->daily_max_impression=$request->input('daily_max_impression');
                        $campaign->max_budget=$request->input('max_budget');
                        $campaign->daily_max_budget=$request->input('daily_max_budget');
                        $campaign->cpm=$request->input('cpm');
                        $campaign->advertiser_domain_name=$request->input('advertiser_domain_name');
                        $campaign->description=$request->input('description');
//                        $campaign->advertiser_id=$request->input('advertiser_id');
                        $campaign->start_date=$start_date;
                        $campaign->end_date=$end_date;
                        $campaign->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Campaign Edited Successfully']);
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
