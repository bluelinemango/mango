<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Creative;
use App\Models\Geolocation;
use App\Models\GeoSegmentList;
use App\Models\Iab_Category;
use App\Models\Targetgroup;
use App\Models\Targetgroup_Bidhour_Map;
use App\Models\Targetgroup_Bwlist_Map;
use App\Models\Targetgroup_Creative_Map;
use App\Models\Targetgroup_Geolocation_Map;
use App\Models\Targetgroup_Geosegmentlist_Map;
use App\Models\Targetgroup_Segment_Map;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MangoController extends Controller
{
    public function BulkView()
    {
        if (Auth::check()) {
            return view('bulk.bulk');
        }
        return Redirect::to(url('/user/login'));
    }

    public function validation(Request $request){
        $rule=array();
        if($request->has('name')){
            $rule['name']= 'required';
        }
        if($request->has('domain_name')){
            $rule['domain_name']= 'required';
        }
        if($request->has('advertiser_domain_name')){
            $rule['advertiser_domain_name']= 'required';
        }
        if($request->has('max_impression')){
            $rule['max_impression']= 'required|numeric';
        }
        if($request->has('daily_max_impression')){
            $rule['daily_max_impression']= 'required|numeric';
        }
        if($request->has('max_budget')){
            $rule['max_budget']= 'required|numeric';
        }
        if($request->has('daily_max_budget')){
            $rule['daily_max_budget']= 'required|numeric';
        }
        if($request->has('cpm')){
            $rule['cpm']= 'required|numeric';
        }
        if($request->has('frequency_in_sec')){
            $rule['frequency_in_sec'] = 'required|numeric';
        }
        if($request->has('pacing_plan')){
            $rule['pacing_plan'] = 'required|numeric';
        }
        if($request->has('date_range')){
            $rule['date_range'] = 'required';
        }
        if($request->has('landing_page_url')){
            $rule['landing_page_url'] = 'required';
        }
        if($request->has('attributes')){
            $rule['attributes'] = 'required';
        }
        if($request->has('preview_url')){
            $rule['preview_url'] = 'required';
        }
        if($request->has('size_width')){
            $rule['size_width'] = 'required|numeric|min:0';
        }
        if($request->has('size_height')){
            $rule['size_height'] = 'required|numeric|min:0';
        }
        if($request->has('ad_tag')){
            $rule['ad_tag'] = 'required';
        }
//        return dd($rule);
        $validate = \Validator::make($request->all(), $rule);
        return $validate;
    }

    public function getCampaign()
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $campaign = Campaign::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                    $client_obj=Client::get();
                } else {
                    $usr_company = $this->user_company();
                    $campaign = Campaign::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    $client_obj=Client::whereIn('user_id', $usr_company)->get();
                    if (!$campaign) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.campaign')
                    ->with('client_obj', $client_obj)
                    ->with('campaign_obj', $campaign);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }   //Get Campaign view

    public function getCreative()
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $creative = Creative::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                    $client_obj=Client::get();
                } else {
                    $usr_company = $this->user_company();
                    $creative = Creative::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    $client_obj=Client::whereIn('user_id', $usr_company)->get();
                    if (!$creative) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.creative')
                    ->with('client_obj', $client_obj)
                    ->with('creative_obj', $creative);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }  //Get Creative view

    public function getTargetgroup()
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $adver_obj='';
                if (User::isSuperAdmin()) {
                    $targetgroup = Targetgroup::with(['getCampaign' => function ($q) {
                        $q->with(['getAdvertiser' => function ($p) {
                            $p->with('GetClientID');
                        }]);
                    }])->get();
                    $client_obj=Client::get();
                } else {
                    $usr_company = $this->user_company();
                    $targetgroup = Targetgroup::whereHas('getCampaign', function ($p) use ($usr_company) {
                        $p->whereHas('getAdvertiser', function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        });
                    })->get();
                    $client_obj=Client::whereIn('user_id', $usr_company)->get();
                    if (!$targetgroup) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                $iab_category_obj = Iab_Category::get();
                return view('bulk.targetgroup')
                    ->with('client_obj', $client_obj)
                    ->with('iab_category_obj', $iab_category_obj)
                    ->with('targetgroup_obj', $targetgroup);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }   //Get TargetGroup view

    public function getCampaignList($adv_id)
    {
        if (Auth::check()) {
            if (in_array('VIEW_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $campaign= Campaign::where('advertiser_id',$adv_id)->get();
                } else {
                    $usr_company = $this->user_company();
                    $campaign= Campaign::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->where('advertiser_id',$adv_id)->get();
                    if (!$campaign) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.ajaxTask')
                    ->with('taskAjax', 'showCampaignList')
                    ->with('campaign_obj', $campaign);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function getCreativeList($adv_id)
    {
        if (Auth::check()) {
            if (in_array('VIEW_CREATIVE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $creative= Creative::where('advertiser_id',$adv_id)->get();
                } else {
                    $usr_company = $this->user_company();
                    $creative= Creative::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->where('advertiser_id',$adv_id)->get();
                    if (!$creative) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.ajaxTask')
                    ->with('taskAjax', 'showCreativeList')
                    ->with('creative_obj', $creative);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function getTargetgroupList($cmp_id)
    {
        if (Auth::check()) {
            if (in_array('VIEW_TARGETGROUP', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $targetgroup= Targetgroup::where('campaign_id',$cmp_id)->get();
                } else {
                    $usr_company = $this->user_company();
                    $targetgroup= Targetgroup::whereHas('getCampaign' ,function ($p) use ($usr_company) {
                        $p->whereHas('getAdvertiser' , function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        });
                    })->where('campaign_id',$cmp_id)->get();
                    if (!$targetgroup) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.ajaxTask')
                    ->with('taskAjax', 'showTargetgroupList')
                    ->with('targetgroup_obj', $targetgroup);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function getAdvertiserSelect($cln_id)
    {
        if (Auth::check()) {
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $next_child = Advertiser::where('client_id', $cln_id)->get();
                } else {
                    $usr_company = $this->user_company();
                    $next_child= Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    })->where('client_id', $cln_id)->get();
                    if (!$next_child) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.ajaxTask')
                    ->with('taskAjax', 'showAdvertiserSelect')
                    ->with('next_child', $next_child);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function getCampaignSelect($adv_id)
    {
        if (Auth::check()) {
            if (in_array('VIEW_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $next_child = Campaign::where('advertiser_id', $adv_id)->get();
                } else {
                    $usr_company = $this->user_company();
                    $next_child= Campaign::whereHas('GetClientID', function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    })->where('advertiser_id', $adv_id)->get();
                    if (!$next_child) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.ajaxTask')
                    ->with('taskAjax', 'showCampaignSelect')
                    ->with('next_child', $next_child);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function getAssign($adv_id)
    {
        if (Auth::check()) {

            if (User::isSuperAdmin()) {
                $adver_obj = Advertiser::with('Creative', 'GeoSegment', 'BWList')
                ->find($adv_id);
            } else {
                $usr_company = $this->user_company();
                $adver_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                    $p->whereIn('user_id', $usr_company);
                })->with('Creative', 'GeoSegment', 'BWList')->find($adv_id);
                if (!$adver_obj) {
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                }
            }
            if($adver_obj) {
                $geolocation_obj = Geolocation::get();
                return view('bulk.assign')
                    ->with('geolocation_obj', $geolocation_obj)
                    ->with('adver_obj', $adver_obj);
            }
        }
    }

    public function campaign_bulk(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                $validate = $this->validation($request);
                if ($validate->passes()) {
                    $usr_company = $this->user_company();
                    $audit = new AuditsController();
                    $audit_key = $audit->generateRandomString();
                    if($request->input('advertiser_id')=='all' and !$request->has('campaign_list')){
                        if($request->input('client_id')=='all'){
                            if (User::isSuperAdmin()) {
                                $campaign_list = Campaign::get(['id'])->toArray();
                            } else {
                                $campaign_list = Campaign::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                                    $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                        $p->whereIn('user_id', $usr_company);
                                    });
                                })->get(['id'])->toArray();
                            }

                        }elseif($request->input('client_id')!='all'){
                            if (User::isSuperAdmin()) {
                                $campaign_list = Campaign::whereHas('getAdvertiser' , function ($q) use ($request){
                                    $q->where('client_id',$request->input('client_id'));
                                })->get(['id'])->toArray();
                            } else {
                                ////////////////////////
                                $campaign_list = Campaign::whereHas('getAdvertiser' , function ($q) use ($usr_company,$request){
                                    $q->whereHas('GetClientID' ,function ($p) use ($usr_company,$request) {
                                        $p->where('id',$request->input('client_id'))->whereIn('user_id', $usr_company);
                                    });
                                })->get(['id'])->toArray();
                            }

                        }
                    }elseif($request->input('advertiser_id')!='all' and !$request->has('campaign_list')){
                        if (User::isSuperAdmin()) {
                            $campaign_list = Campaign::whereHas('getAdvertiser' , function ($q) use ($request){
                                $q->where('id',$request->input('advertiser_id'));
                            })->get(['id'])->toArray();
                        } else {
                            ////////////////////////
                            $campaign_list = Campaign::whereHas('getAdvertiser' , function ($q) use ($usr_company,$request){
                                $q->where('id',$request->input('advertiser_id'))->whereHas('GetClientID' ,function ($p) use ($usr_company,$request) {
                                    $p->whereIn('user_id', $usr_company);
                                });
                            })->get(['id'])->toArray();
                        }

                    }else{
                        $campaign_list=explode(',',$request->input('campaign_list'));
                    }
                    if(count($campaign_list)>0) {
                        foreach ($campaign_list as $index) {
                            $data = array();
                            if(!$request->has('campaign_list')){
                                $campaign_id = $index['id'];
                                $campaign = Campaign::find($campaign_id);
                            }else{
                                $campaign_id = $index;
                                if (User::isSuperAdmin()) {
                                    $campaign = Campaign::find($campaign_id);
                                } else {
                                    $usr_company = $this->user_company();
                                    $campaign = Campaign::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                            $p->whereIn('user_id', $usr_company);
                                        });
                                    })->find($campaign_id);
                                }
                            }
                            if ($campaign) {
                                if($request->has('date_range')) {
                                    $check_date = $this->date_validation($request->input('date_range'));
                                    if (!$check_date) {
                                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please check your date range!']);
                                    }
                                    $date_range = explode('-', $request->input('date_range'));

                                    $start_date = Carbon::createFromFormat('m/d/Y', str_replace(' ', '', $date_range[0]))->toDateString();
                                    $end_date = Carbon::createFromFormat('m/d/Y', str_replace(' ', '', $date_range[1]))->toDateString();
                                }

                                if ($request->has('name')) {
                                    array_push($data, 'Name');
                                    array_push($data, $request->input('name'));
                                    $campaign->name = $request->input('name');
                                }
                                if ($request->has('active')) {
                                    $active = 'Inactive';
                                    if ($request->input('active') == 'on') {
                                        $active = 'Active';
                                    }
                                    array_push($data, 'Status');
                                    array_push($data, $active);
                                    $campaign->status = $active;
                                }
                                if ($request->has('max_impression')) {
                                    array_push($data, 'Max Imps');
                                    array_push($data, $request->input('max_impression'));
                                    $campaign->max_impression = $request->input('max_impression');
                                }
                                if ($request->has('daily_max_impression')) {
                                    array_push($data, 'Daily Max Imps');
                                    array_push($data, $request->input('daily_max_impression'));
                                    $campaign->daily_max_impression = $request->input('daily_max_impression');
                                }
                                if ($request->has('max_budget')) {
                                    array_push($data, 'Max Budget');
                                    array_push($data, $request->input('max_budget'));
                                    $campaign->max_budget = $request->input('max_budget');
                                }
                                if ($request->has('daily_max_budget')) {
                                    array_push($data, 'Daily Max Budget');
                                    array_push($data, $request->input('daily_max_budget'));
                                    $campaign->daily_max_budget = $request->input('daily_max_budget');
                                }
                                if ($request->has('cpm')) {
                                    array_push($data, 'CPM');
                                    array_push($data, $request->input('cpm'));
                                    $campaign->cpm = $request->input('cpm');
                                }
                                if ($request->has('advertiser_domain_name')) {
                                    array_push($data, 'Domain Name');
                                    array_push($data, $request->input('advertiser_domain_name'));
                                    $campaign->advertiser_domain_name = $request->input('advertiser_domain_name');
                                }
                                if ($request->has('description')) {
                                    array_push($data, 'Description');
                                    array_push($data, $request->input('description'));
                                    $campaign->description = $request->input('description');
                                }
                                if (isset($start_date)) {
                                    array_push($data, 'Start Date');
                                    array_push($data, $start_date);
                                    $campaign->start_date = $start_date;
                                }
                                if (isset($end_date)) {
                                    array_push($data, 'End Date');
                                    array_push($data, $end_date);
                                    $campaign->end_date = $end_date;
                                }
                                $audit->store('campaign', $campaign_id, $data, 'bulk_edit', $audit_key);
                                $campaign->save();
                            }
                        }
                        return Redirect::back()->withErrors(['success' => true, 'msg' => 'Campaigns Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'don\'t have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));

    }

    public function targetgroup_bulk(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $validate = $this->validation($request);
                $usr_company = $this->user_company();
                if ($validate->passes()) {
                    $audit = new AuditsController();
                    $audit_key = $audit->generateRandomString();
                    if($request->input('campaign_id')=='all' and !$request->has('tg_list')){
                        if($request->input('advertiser_id')=='all' and $request->input('client_id')=='all'){
                            if (User::isSuperAdmin()) {
                                $tg_list1 = Targetgroup::get(['id'])->toArray();
                            } else {
                                $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($usr_company) {
                                    $p->whereHas('getAdvertiser' , function ($q) use ($usr_company) {
                                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                            $p->whereIn('user_id', $usr_company);
                                        });
                                    });
                                })->get(['id'])->toArray();
                            }

                        }elseif($request->input('advertiser_id')!='all'){
                            if (User::isSuperAdmin()) {
                                $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($request) {
                                    $p->whereHas('getAdvertiser' , function ($q) use ($request) {
                                        $q->where('id',$request->input('advertiser_id'));
                                    });
                                })->get(['id'])->toArray();
                            } else {
                                $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($usr_company,$request) {
                                    $p->whereHas('getAdvertiser' , function ($q) use ($usr_company,$request) {
                                        $q->where('id',$request->input('advertiser_id'))->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                            $p->whereIn('user_id', $usr_company);
                                        });
                                    });
                                })->get(['id'])->toArray();
                            }

                        }elseif($request->input('client_id')!='all'){
                            if (User::isSuperAdmin()) {
                                $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($request) {
                                    $p->whereHas('getAdvertiser' , function ($q) use ($request) {
                                        $q->whereHas('GetClientID' , function ($p) use ($request) {
                                            $p->where('id',$request->input('client_id'));
                                        });
                                    });
                                })->get(['id'])->toArray();
                            } else {
                                $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($usr_company,$request) {
                                    $p->whereHas('getAdvertiser' , function ($q) use ($usr_company,$request) {
                                        $q->where('id',$request->input('advertiser_id'))->whereHas('GetClientID' , function ($p) use ($usr_company,$request) {
                                            $p->where('id',$request->input('client_id'))->whereIn('user_id', $usr_company);
                                        });
                                    });
                                })->get(['id'])->toArray();
                            }
                        }
                    }elseif($request->input('campaign_id')!='all' and !$request->has('tg_list')){
                        if (User::isSuperAdmin()) {
                            $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($request) {
                                $p->where('id',$request->input('campaign_id'));
                            })->get(['id'])->toArray();
                        } else {
                            $tg_list1 = Targetgroup::whereHas('getCampaign' ,function ($p) use ($usr_company,$request) {
                                $p->where('id',$request->input('campaign_id'))->whereHas('getAdvertiser' , function ($q) use ($usr_company) {
                                    $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                        $p->whereIn('user_id', $usr_company);
                                    });
                                });
                            })->get(['id'])->toArray();
                        }
                    }else{
                        $tg_list1=explode(',',$request->input('tg_list'));
                    }
//                    return dd($tg_list1);
                    $bid_hour = '';
                    $flg = 0;
                    for ($i = 0; $i < 7; $i++) {
                        for ($j = 0; $j < 24; $j++) {
                            if (!is_null($request->input($i . '-' . $j . '-hour'))) {
                                $flg=1;
                                $bid_hour1[$j] = "1";
                            } else {
                                $bid_hour1[$j] = "0";
                            }
                        }
                        $bid_hour[$i + 1] = $bid_hour1;
                    }
                    if(count($tg_list1)>0){
                        foreach ($tg_list1 as $index) {
                            $data = array();
                            if(!$request->has('tg_list')){
                                $tg_id = $index['id'];
                                $tg = Targetgroup::find($tg_id);
                            }else{
                                $tg_id = $index;
                                if (User::isSuperAdmin()) {
                                    $tg = Targetgroup::find($tg_id);
                                } else {
                                    $tg = Targetgroup::whereHas('getCampaign' ,function ($p) use ($usr_company) {
                                        $p->whereHas('getAdvertiser' , function ($q) use ($usr_company) {
                                            $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                                $p->whereIn('user_id', $usr_company);
                                            });
                                        });
                                    })->find($tg_id);
                                }
                            }
//                    return dd($tg_id);
                            if ($tg) {
//                            return dd($tg);
                                if($request->has('date_range')) {
                                    $check_date = $this->date_validation($request->input('date_range'));
                                    if (!$check_date) {
                                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please check your date range!']);
                                    }
                                    $date_range = explode('-', $request->input('date_range'));

                                    $start_date = Carbon::createFromFormat('m/d/Y', str_replace(' ', '', $date_range[0]))->toDateString();
                                    $end_date = Carbon::createFromFormat('m/d/Y', str_replace(' ', '', $date_range[1]))->toDateString();
                                }
                                if($flg==1) {
                                    $target_bid_hour = Targetgroup_Bidhour_Map::where('targetgroup_id',$tg_id)->first();
                                    $target_bid_hour->hours = json_encode($bid_hour);
                                    $target_bid_hour->save();
                                }

                                if ($request->has('name')) {
                                    array_push($data, 'Name');
                                    array_push($data, $request->input('name'));
                                    $tg->name = $request->input('name');
                                }
                                if ($request->has('active')) {
                                    $active = 'Inactive';
                                    if ($request->input('active') == 'on') {
                                        $active = 'Active';
                                    }
                                    array_push($data, 'Status');
                                    array_push($data, $active);
                                    $tg->status = $active;
                                }
                                if ($request->has('max_impression')) {
                                    array_push($data, 'Max Imps');
                                    array_push($data, $request->input('max_impression'));
                                    $tg->max_impression = $request->input('max_impression');
                                }
                                if ($request->has('daily_max_impression')) {
                                    array_push($data, 'Daily Max Imps');
                                    array_push($data, $request->input('daily_max_impression'));
                                    $tg->daily_max_impression = $request->input('daily_max_impression');
                                }
                                if ($request->has('max_budget')) {
                                    array_push($data, 'Max Budget');
                                    array_push($data, $request->input('max_budget'));
                                    $tg->max_budget = $request->input('max_budget');
                                }
                                if ($request->has('daily_max_budget')) {
                                    array_push($data, 'Daily Max Budget');
                                    array_push($data, $request->input('daily_max_budget'));
                                    $tg->daily_max_budget = $request->input('daily_max_budget');
                                }
                                if ($request->has('cpm')) {
                                    array_push($data, 'CPM');
                                    array_push($data, $request->input('cpm'));
                                    $tg->cpm = $request->input('cpm');
                                }
                                if ($request->has('pacing_plan')) {
                                    array_push($data, 'Pacing Plan');
                                    array_push($data, $request->input('pacing_plan'));
                                    $tg->pacing_plan = $request->input('pacing_plan');
                                }
                                if ($request->has('frequency_in_sec')) {
                                    array_push($data, 'Frequency in Sec');
                                    array_push($data, $request->input('frequency_in_sec'));
                                    $tg->frequency_in_sec =$request->input('frequency_in_sec');
                                }
                                if($request->has('iab_category')){
                                    array_push($data,'Iab Category');
                                    array_push($data,$request->input('iab_category'));
                                    $tg->iab_category = $request->input('iab_category');
                                }
                                if($request->has('iab_sub_category')){
                                    array_push($data,'Iab Sub Category');
                                    array_push($data,$request->input('iab_sub_category'));
                                    $tg->iab_sub_category = $request->input('iab_sub_category');
                                }
                                if ($request->has('domain_name')) {
                                    array_push($data, 'Domain Name');
                                    array_push($data, $request->input('domain_name'));
                                    $tg->advertiser_domain_name = $request->input('domain_name');
                                }
                                if ($request->has('description')) {
                                    array_push($data, 'Description');
                                    array_push($data, $request->input('description'));
                                    $tg->description = $request->input('description');
                                }
                                if (isset($start_date)) {
                                    array_push($data, 'Start Date');
                                    array_push($data, $start_date);
                                    $tg->start_date = $start_date;
                                }
                                if (isset($end_date)) {
                                    array_push($data, 'End Date');
                                    array_push($data, $end_date);
                                    $tg->end_date = $end_date;
                                }
                                if($request->has('unassign_geolocation')){
                                    Targetgroup_Geolocation_Map::where('targetgroup_id',$tg_id)->delete();
                                }
                                if($request->has('unassign_geosegment')) {
                                    Targetgroup_Geosegmentlist_Map::where('targetgroup_id',$tg_id)->delete();
                                }
                                if($request->has('unassign_segment')) {
                                    Targetgroup_Segment_Map::where('targetgroup_id',$tg_id)->delete();
                                }
                                if($request->has('unassign_segment')) {
                                    Targetgroup_Bwlist_Map::where('targetgroup_id',$tg_id)->delete();
                                }
                                if($request->has('unassign_creative')) {
                                    Targetgroup_Creative_Map::where('targetgroup_id',$tg_id)->delete();
                                }
                                if($request->has('unassign_bidprofile')) {

                                }
                                if (count($request->input('to_geosegment')) > 0) {
                                    $geoSegment_map=Targetgroup_Geosegmentlist_Map::where('targetgroup_id', $tg_id)->get();
                                    $geoSegArr=array();
                                    foreach($geoSegment_map as $index2){
                                        array_push($geoSegArr,$index2->geosegmentlist_id);
                                    }
                                    foreach ($request->input('to_geosegment') as $index1) {
                                        if (!in_array($index1, $geoSegArr)) {
                                            if (User::isSuperAdmin()) {
                                                $check = true;
                                            } else {
                                                $check=GeoSegmentList::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                                                    $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                                        $p->whereIn('user_id', $usr_company);
                                                    });
                                                })->find($index1);
                                            }
                                            if($check) {
                                                $geosegment_assign = new Targetgroup_Geosegmentlist_Map();
                                                $geosegment_assign->targetgroup_id = $tg_id;
                                                $geosegment_assign->geosegmentlist_id = $index1;
                                                $geosegment_assign->save();
                                                $data = array('targetgroup_geosegment', $geosegment_assign->id);
                                                $audit->store('targetgroup', $tg_id, $data, 'bulk_edit', $audit_key);
                                            }
                                            array_push($geoSegArr, $index1);
                                        }
                                    }
                                }
                                if (count($request->input('to_creative')) > 0) {
                                    $map=Targetgroup_Creative_Map::where('targetgroup_id', $tg_id)->get();
                                    $mapArr=array();
                                    foreach($map as $index1){
                                        array_push($mapArr,$index1->creative_id);
                                    }
                                    foreach ($request->input('to_creative') as $index1) {
                                        if (!in_array($index1, $mapArr)) {
                                            if (User::isSuperAdmin()) {
                                                $check = true;
                                            } else {
                                                $check = Creative::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                                                    $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                                        $p->whereIn('user_id', $usr_company);
                                                    });
                                                })->find($index1);
                                            }
                                            if($check) {
                                                $creative_assign = new Targetgroup_Creative_Map();
                                                $creative_assign->targetgroup_id = $tg_id;
                                                $creative_assign->creative_id = $index1;
                                                $creative_assign->save();
                                                $data = array('targetgroup_creative', $creative_assign->id);
                                                $audit->store('targetgroup', $tg_id, $data, 'bulk_edit', $audit_key);
                                            }
                                            array_push($mapArr, $index1);
                                        }
                                    }
                                }

                                if (count($request->input('to_segment')) > 0) {
                                    $segment_map=Targetgroup_Segment_Map::where('targetgroup_id', $tg_id)->get();
                                    $segArr=array();
                                    foreach($segment_map as $index1){
                                        array_push($segArr,$index1->segment_id);
                                    }
                                    foreach ($request->input('to_geosegment') as $index1) {
                                        if (!in_array($index1, $segArr)) {
                                            $segment_assign = new Targetgroup_Segment_Map();
                                            $segment_assign->targetgroup_id = $tg_id;
                                            $segment_assign->segment_id = $index;
                                            $segment_assign->save();
                                            $data=array('targetgroup_segment',$segment_assign->id);
                                            $audit->store('targetgroup',$tg_id, $data, 'bulk_edit', $audit_key);
                                            array_push($segArr, $index1);
                                        }
                                    }
                                }

                                if (count($request->input('to_geolocation')) > 0) {
                                    $map=Targetgroup_Geolocation_Map::where('targetgroup_id', $tg_id)->get();
                                    $mapArr=array();
                                    foreach($map as $index1){
                                        array_push($mapArr,$index1->geolocation_id);
                                    }
                                    foreach ($request->input('to_geolocation') as $index1) {
                                        if (!in_array($index1, $mapArr)) {
                                            $geolocation_assign = new Targetgroup_Geolocation_Map();
                                            $geolocation_assign->targetgroup_id = $tg_id;
                                            $geolocation_assign->geolocation_id = $index1;
                                            $geolocation_assign->save();
                                            $data=array('targetgroup_geolocation',$geolocation_assign->id);
                                            $audit->store('targetgroup',$tg_id, $data, 'bulk_edit', $audit_key);
                                            array_push($mapArr, $index1);
                                        }
                                    }
                                }
                                $audit->store('targetgroup', $tg_id, $data, 'bulk_edit', $audit_key);
                                $tg->save();
                            }
                        }
                        return Redirect::back()->withErrors(['success' => true, 'msg' => 'Target Groups Edited Successfully']);
                    }
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'No Target Groups found']);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()]);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));

    }

    public function creative_bulk(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate = $this->validation($request);
                if ($validate->passes()) {
                    $usr_company = $this->user_company();
                    $audit = new AuditsController();
                    $audit_key = $audit->generateRandomString();
                    if($request->input('advertiser_id')=='all' and !$request->has('creative_list')){
                        if($request->input('client_id')=='all'){
                            if (User::isSuperAdmin()) {
                                $creative_list = Creative::get(['id'])->toArray();
                            } else {
                                $creative_list = Creative::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                                    $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                        $p->whereIn('user_id', $usr_company);
                                    });
                                })->get(['id'])->toArray();
                            }

                        }elseif($request->input('client_id')!='all'){
                            if (User::isSuperAdmin()) {
                                $creative_list = Creative::whereHas('getAdvertiser' , function ($q) use ($request){
                                    $q->where('client_id',$request->input('client_id'));
                                })->get(['id'])->toArray();
                            } else {
                                ////////////////////////
                                $creative_list = Creative::whereHas('getAdvertiser' , function ($q) use ($usr_company,$request){
                                    $q->whereHas('GetClientID' ,function ($p) use ($usr_company,$request) {
                                        $p->where('id',$request->input('client_id'))->whereIn('user_id', $usr_company);
                                    });
                                })->get(['id'])->toArray();
                            }

                        }
                    }elseif($request->input('advertiser_id')!='all' and !$request->has('creative_list')){
                        if (User::isSuperAdmin()) {
                            $creative_list = Creative::whereHas('getAdvertiser' , function ($q) use ($request){
                                $q->where('id',$request->input('advertiser_id'));
                            })->get(['id'])->toArray();
                        } else {
                            ////////////////////////
                            $creative_list = Creative::whereHas('getAdvertiser' , function ($q) use ($usr_company,$request){
                                $q->where('id',$request->input('advertiser_id'))->whereHas('GetClientID' ,function ($p) use ($usr_company,$request) {
                                    $p->whereIn('user_id', $usr_company);
                                });
                            })->get(['id'])->toArray();
                        }

                    }else{
                        $creative_list=explode(',',$request->input('creative_list'));
                    }
                    if(count($creative_list)>0){
                        foreach ($creative_list as $index) {
                            $data = array();
                            if(!$request->has('creative_list')){
                                $creative_id = $index['id'];
                                $creative = Creative::find($creative_id);
                            }else{
                                $creative_id = $index;
                                if (User::isSuperAdmin()) {
                                    $creative = Creative::find($creative_id);
                                } else {
                                    $usr_company = $this->user_company();
                                    $creative = Creative::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                            $p->whereIn('user_id', $usr_company);
                                        });
                                    })->find($creative_id);

                                }
                            }
                            if ($creative) {
                                if ($request->has('size_width') and $request->has('size_height'))
                                    $size = $request->input('size_width') . 'x' . $request->input('size_height');
                                if ($request->input('name')) {
                                    array_push($data, 'Name');
                                    array_push($data, $request->input('name'));
                                    $creative->name = $request->input('name');
                                }
                                if ($request->has('active')) {
                                    $active = 'Inactive';
                                    if ($request->input('active') == 'on') {
                                        $active = 'Active';
                                    }
                                    array_push($data, 'Status');
                                    array_push($data, $active);
                                    $creative->status = $active;
                                }

                                if ($request->input('ad_type')) {
                                    array_push($data, 'Ad Type');
                                    array_push($data, $request->input('ad_type'));
                                    $creative->ad_type = $request->input('ad_type');
                                }
                                if ($request->has('api')) {
                                    array_push($data, 'API');
                                    array_push($data, json_encode($request->input('api')));
                                    $creative->api = json_encode($request->input('api'));
                                }
                                if ($request->input('advertiser_domain_name')) {
                                    array_push($data, 'Domain Name');
                                    array_push($data, $request->input('advertiser_domain_name'));
                                    $creative->advertiser_domain_name = $request->input('advertiser_domain_name');
                                }
                                if ($request->input('description')) {
                                    array_push($data, 'Description');
                                    array_push($data, $request->input('description'));
                                    $creative->description = $request->input('description');
                                }
                                if ($request->input('landing_page_url')) {
                                    array_push($data, 'Landing Page URL');
                                    array_push($data, $request->input('landing_page_url'));
                                    $creative->landing_page_url = $request->input('landing_page_url');
                                }
                                if ($request->input('preview_url')) {
                                    array_push($data, 'Preview URL');
                                    array_push($data, $request->input('preview_url'));
                                    $creative->preview_url = $request->input('preview_url');
                                }
                                if ($request->input('attributes')) {
                                    array_push($data, 'Attributes');
                                    array_push($data, $request->input('attributes'));
                                    $creative->attributes = $request->input('attributes');
                                }
                                if ($request->input('ad_tag')) {
                                    array_push($data, 'AD Tag');
                                    array_push($data, $request->input('ad_tag'));
                                    $creative->ad_tag = $request->input('ad_tag');
                                }
                                if (isset($size)) {
                                    array_push($data, 'Size');
                                    array_push($data, $size);
                                    $creative->size = $size;
                                }
                                $audit->store('creative', $creative_id, $data, 'bulk_edit', $audit_key);
                                $creative->save();
                            }
                        }
                        return Redirect::back()->withErrors(['success' => true, 'msg' => 'Creatives Edited Successfully']);

                    }

                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));
    }
}
