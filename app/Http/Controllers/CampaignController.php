<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Advertiser;
use App\Models\Audits;
use App\Models\Campaign;
use App\Models\Campaign_Realtime;
use App\Models\Creative;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;


class CampaignController extends Controller
{

    //TODO: CHECK create and update for permission
    public function GetView()
    {
        if (Auth::check()) {
            if (in_array('VIEW_CAMPAIGN', $this->permission)) {
                $campaign=array();
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
                return view('campaign.list')
                    ->with('campaign_obj', $campaign);
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
                }
                if($advertiser_obj){
                    return view('campaign.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'Somethings went wrong!']);
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
                $validate = \Validator::make($request->all(), Campaign::$rule);
                if ($validate->passes()) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                        if(!$advertiser_obj){
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                        }
                    }
                    if ($advertiser_obj) {
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $check_date=$this->date_validation($request->input('date_range'));
                        if(!$check_date){
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'please check your date range!']);
                        }
                        $date_range=explode('-',$request->input('date_range'));

                        $start_date=Carbon::createFromFormat('m/d/Y',str_replace(' ','',$date_range[0]))->toDateString();
                        $end_date=Carbon::createFromFormat('m/d/Y',str_replace(' ','',$date_range[1]))->toDateString();
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
                        return Redirect::to(url('/client/cl' . $advertiser_obj->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/campaign/cmp' . $campaign->id . '/edit'))->withErrors(['success' => true, 'msg' => "Campaign added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function CampaignEditView($clid, $advid, $cmpid,$clone=0)
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
                    }
                    if($campaign_obj) {
                        $real_time = Campaign_Realtime::where('campaign_id', $cmpid)->get();
                        return view('campaign.edit')
                            ->with('real_time', $real_time)
                            ->with('clone', $clone)
                            ->with('campaign_obj', $campaign_obj);
                    }
                    return Redirect::to(url('/campaign'))->withErrors(['success'=>false,'msg'=>'Somethings went wrong!']);
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
                $validate = \Validator::make($request->all(), Campaign::$rule);
                if ($validate->passes()) {
                    $campaign_id = $request->input('campaign_id');

                    if (User::isSuperAdmin()) {
                        $campaign = Campaign::find($campaign_id);
                    } else {
                        $usr_company = $this->user_company();

                        $campaign = Campaign::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->with('Targetgroup')->find($campaign_id);
//                        return dd($campaign_obj);
                    }
                    if ($campaign) {
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $check_date=$this->date_validation($request->input('date_range'));
                        if(!$check_date){
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'please check your date range!']);
                        }
                        $date_range=explode('-',$request->input('date_range'));

                        $start_date=Carbon::createFromFormat('m/d/Y',str_replace(' ','',$date_range[0]))->toDateString();
                        $end_date=Carbon::createFromFormat('m/d/Y',str_replace(' ','',$date_range[1]))->toDateString();
                        $start_date_old=Carbon::createFromFormat('Y-m-d H:i:s',$campaign->start_date)->toDateString();
                        $end_date_old=Carbon::createFromFormat('Y-m-d H:i:s',$campaign->end_date)->toDateString();
//                        return dd($start_date_old);
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
                            $campaign->status = $active;
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
                        if($start_date_old != $start_date){
                            array_push($data,'Start Date');
                            array_push($data,$start_date_old);
                            array_push($data,$start_date);
                            $campaign->start_date = $start_date;
                        }
                        if($end_date_old != $end_date){
                            array_push($data,'End Date');
                            array_push($data,$end_date_old);
                            array_push($data,$end_date);
                            $campaign->end_date = $end_date;
                        }
                        $audit->store('campaign',$campaign_id,$data,'edit');

                        $campaign->save();
                        return Redirect::back()->withErrors(['success' => true, 'msg' => 'Campaign Edited Successfully']);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'Somethings went wrong!']);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'don\'t have Edit Permission']);
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
                        if ($campaign->daily_max_impression != $request->input('daily_max_imp')) {
                            array_push($data, 'Daily Max Impression');
                            array_push($data, $campaign->daily_max_impression);
                            array_push($data, $request->input('daily_max_imp'));
                            $campaign->daily_max_impression = $request->input('daily_max_imp');
                        }
                        if ($campaign->cpm != $request->input('cpm')) {
                            array_push($data, 'CPM');
                            array_push($data, $campaign->cpm);
                            array_push($data, $request->input('cpm'));
                            $campaign->cpm = $request->input('cpm');
                        }
                        if ($campaign->daily_max_budget != $request->input('daily_max_budget')) {
                            array_push($data, 'Daily Max Budget');
                            array_push($data, $campaign->daily_max_budget);
                            array_push($data, $request->input('daily_max_budget'));
                            $campaign->daily_max_budget = $request->input('daily_max_budget');
                        }
                        $audit->store('campaign', $camp_id, $data, 'edit');
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

    public function UploadCampaign(Request $request){

        if(Auth::check()){
            if(in_array('ADD_EDIT_CAMPAIGN',$this->permission)) {
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

                        if ($t[1] != 'name' or $t[2] != 'max_impression' or $t[3] != 'daily_max_impression'or $t[4] != 'max_budget' or $t[5] != 'daily_max_budget' or $t[6] != 'cpm' or $t[7] != 'advertiser_domain_name' or $t[8] != 'status' or $t[9] != 'start_date' or $t[10] != 'end_date') {
                            File::delete($destpath . '/cdn/test/' . $fileName);
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please be sure that file is correct'])->withInput();
                        }
                        $bad_input=array();
                        $count=0;
//                        return dd();
                        foreach ($upload as $test) {
                            $flg=0;
                            $campaign = new Campaign();
                            if($test['name']=='' or $test['max_impression']=='' or  $test['daily_max_impression']=='' or $test['max_budget']=='' or $test['daily_max_budget']=='' or $test['cpm']=='' or $test['advertiser_domain_name']=='' or $test['status']=='' or $test['status']=='' or $test['end_date']=='' ) {
                                array_push($bad_input, $test['name']);
                                continue;
                            }
                            if(!is_numeric($test['max_impression']) or !is_numeric($test['daily_max_impression']) or !is_numeric($test['max_budget']) or !is_numeric($test['daily_max_budget']) or !is_numeric($test['cpm'])){
                                array_push($bad_input,$test['name']);
                                continue;
                            }
                            if(strcasecmp($test['status'], 'active')!=0 and strcasecmp($test['status'], 'inactive')!=0){
                                array_push($bad_input,$test['name']);
                                continue;
                            }

                            $campaign->name = $test['name'];
                            $campaign->max_impression = $test['max_impression'];
                            $campaign->daily_max_impression = $test['daily_max_impression'];
                            $campaign->max_budget = $test['max_budget'];
                            $campaign->daily_max_budget = $test['daily_max_budget'];
                            $campaign->cpm = $test['cpm'];
                            $campaign->start_date = $test['start_date'];
                            $campaign->end_date = $test['end_date'];
                            $campaign->advertiser_domain_name = $test['advertiser_domain_name'];
                            $campaign->status = ucwords(strtolower($test['status']));
                            $campaign->advertiser_id = $request->input('advertiser_id');
//                            return dd('dd1');
                            $count++;
                            $campaign->save();
                        }
                        $audit=new AuditsController();
                        $audit->store('campaign',0,$count,'bulk_add');
                        $msg = "Campaigns added successfully";
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
