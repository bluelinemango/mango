<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Creative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CampaignController extends Controller
{

    //TODO: CHECK create and update for permission
    public function GetView()
    {
        if (Auth::check()) {
            if (in_array('VIEW_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $campaign = Campaign::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                } else {
                    $usr_company = $this->user_company();
                    $campaign = Campaign::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();

                }
                return view('campaign.list')->with('campaign_obj', $campaign);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function CampaignAddView($clid, $advid)
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                } else {
                    $usr_company = $this->user_company();
                    $advertiser_obj = Advertiser::whereHas('GetClientID' , function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    })->find($advid);
                    if(!$advertiser_obj){
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
                return view('campaign.add')->with('advertiser_obj', $advertiser_obj);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));

    }

    public function add_campaign(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    $chkUser = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if (!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
                        $end_date = \DateTime::createFromFormat('d.m.Y', $request->input('end_date'));
                        $campaign = new Campaign();
                        $campaign->name = $request->input('name');
                        $campaign->max_impression = $request->input('max_impression');
                        $campaign->daily_max_impression = $request->input('daily_max_impression');
                        $campaign->max_budget = $request->input('max_budget');
                        $campaign->daily_max_budget = $request->input('daily_max_budget');
                        $campaign->cpm = $request->input('cpm');
                        $campaign->status = $active;
                        $campaign->advertiser_domain_name = $request->input('advertiser_domain_name');
                        $campaign->description = $request->input('description');
                        $campaign->advertiser_id = $request->input('advertiser_id');
                        $campaign->start_date = $start_date;
                        $campaign->end_date = $end_date;
                        $campaign->save();
                        $audit= new AuditsController();
                        $audit->store('campaign',$campaign->id,null,'add');
                        return Redirect::to(url('/client/cl' . $chkUser->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/campaign/cmp' . $campaign->id . '/edit'))->withErrors(['success' => true, 'msg' => "Campaign added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function CampaignEditView($clid, $advid, $cmpid)
    {
        if (!is_null($cmpid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $campaign_obj = Campaign::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('Targetgroup')->find($cmpid);
                    } else {
                        $usr_company = $this->user_company();

                        $campaign_obj = Campaign::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->with('Targetgroup')->find($cmpid);
//                        return dd($campaign_obj);
                        if(!$campaign_obj) {
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                        }
                    }
                    return view('campaign.edit')->with('campaign_obj', $campaign_obj);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_campaign(Request $request)
    {
//        return dd($request->all());
//        $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    $campaign_id = $request->input('campaign_id');
                    $campaign = Campaign::find($campaign_id);
                    if ($campaign) {
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }

                        if($campaign->start_date != $request->input('start_date')){
                            $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
                        }
                        if($campaign->end_date != $request->input('end_date')) {
                            $end_date = \DateTime::createFromFormat('d.m.Y', $request->input('end_date'));
                        }
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $data=array();
                        $audit= new AuditsController();
                        if($campaign->name != $request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$campaign->name);
                            array_push($data,$request->input('name'));
                            $campaign->name=$request->input('name');
                        }
                        if ($campaign->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $campaign->status);
                            array_push($data, $active);
                            $campaign->name = $active;
                        }
                        if($campaign->max_impression != $request->input('max_impression')){
                            array_push($data,'Max Imps');
                            array_push($data,$campaign->max_impression);
                            array_push($data,$request->input('max_impression'));
                            $campaign->max_impression=$request->input('max_impression');
                        }
                        if($campaign->daily_max_impression != $request->input('daily_max_impression')){
                            array_push($data,'Daily Max Imps');
                            array_push($data,$campaign->daily_max_impression);
                            array_push($data,$request->input('daily_max_impression'));
                            $campaign->daily_max_impression = $request->input('daily_max_impression');
                        }
                        if($campaign->max_budget != $request->input('max_budget')){
                            array_push($data,'Max Budget');
                            array_push($data,$campaign->max_budget);
                            array_push($data,$request->input('max_budget'));
                            $campaign->max_budget = $request->input('max_budget');
                        }
                        if($campaign->daily_max_budget != $request->input('daily_max_budget')){
                            array_push($data,'Daily Max Budget');
                            array_push($data,$campaign->daily_max_budget);
                            array_push($data,$request->input('daily_max_budget'));
                            $campaign->daily_max_budget = $request->input('daily_max_budget');
                        }
                        if($campaign->cpm != $request->input('cpm')){
                            array_push($data,'CPM');
                            array_push($data,$campaign->cpm);
                            array_push($data,$request->input('cpm'));
                            $campaign->cpm = $request->input('cpm');
                        }
                        if($campaign->advertiser_domain_name != $request->input('advertiser_domain_name')){
                            array_push($data,'Domain Name');
                            array_push($data,$campaign->advertiser_domain_name);
                            array_push($data,$request->input('advertiser_domain_name'));
                            $campaign->advertiser_domain_name = $request->input('advertiser_domain_name');
                        }
                        if($campaign->description != $request->input('description')){
                            array_push($data,'Description');
                            array_push($data,$campaign->description);
                            array_push($data,$request->input('description'));
                            $campaign->description = $request->input('description');
                        }
                        if(isset($start_date)){
                            array_push($data,'Start Date');
                            array_push($data,$campaign->start_date);
                            array_push($data,$start_date);
                            $campaign->start_date = $start_date;
                        }
                        if(isset($end_date)){
                            array_push($data,'End Date');
                            array_push($data,$campaign->end_date);
                            array_push($data,$end_date);
                            $campaign->end_date = $end_date;
                        }
                        $audit->store('campaign',$campaign_id,$data,'edit');

                        $campaign->save();
                        return Redirect::back()->withErrors(['success' => true, 'msg' => 'Campaign Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));
    }

    public function jqgrid(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    $camp_id = substr($request->input('id'), 3);
                    if (User::isSuperAdmin()) {
                        $campaign = Campaign::find($camp_id);
                    }else{
                        $usr_company = $this->user_company();
                        $campaign = Campaign::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($camp_id);
                        if (!$campaign) {
                            return $msg=(['success' => false, 'msg' => "Some things went wrong"]);
                        }
                    }
                    if ($campaign) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($campaign->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $campaign->name);
                            array_push($data, $request->input('name'));
                            $campaign->name = $request->input('name');
                        }
                        if ($campaign->max_impression != $request->input('max_imp')) {
                            array_push($data, 'Max Impression');
                            array_push($data, $campaign->max_impression);
                            array_push($data, $request->input('max_imp'));
                            $campaign->max_impression = $request->input('max_imp');
                        }
                        if ($campaign->max_budget != $request->input('max_budget')) {
                            array_push($data, 'Max Budget');
                            array_push($data, $campaign->max_budget);
                            array_push($data, $request->input('max_budget'));
                            $campaign->max_budget = $request->input('max_budget');
                        }
                        $audit->store('advertiser', $camp_id, $data, 'edit');
                        $campaign->save();
                        return $msg=(['success' => true, 'msg' => "your Campaign Saved successfully"]);
                    }
                    return $msg=(['success' => false, 'msg' => "Please Select a Campaign First"]);
                }
                return $msg=(['success' => false, 'msg' => "Please Check your field"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity=Campaign::find($id);
                } else {
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    if (count($usr_company) > 0 and in_array(Auth::user()->id, $usr_company)) {
                        $entity = Campaign::with(['getAdvertiser' => function ($q) use($usr_company) {
                            $q->with(['GetClientID' => function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            }]);
                        }])->find($id);
                    } else {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
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
                    $audit->store('campaign',$id,$data,'edit');
                    $entity->save();
                    return $msg;
                }
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }

}
