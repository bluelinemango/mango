<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Creative;
use App\Models\Geolocation;
use App\Models\Iab_Category;
use App\Models\Targetgroup;
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
    }

    public function getCampaign()
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $campaign = Campaign::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                } else {
                    $usr_company = $this->user_company();
                    $campaign = Campaign::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    if (!$campaign) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.campaign')
                    ->with('campaign_obj', $campaign);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function getCreative()
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $creative = Creative::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                } else {
                    $usr_company = $this->user_company();
                    $creative = Creative::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    if (!$creative) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('bulk.creative')
                    ->with('creative_obj', $creative);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }
    public function getCampaignList($adv_id)
    {
        if (Auth::check()) {
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
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
                return view('bulk.campaignList')
                    ->with('campaign_obj', $campaign);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }
    public function getAssign($cmp_id)
    {
        if (Auth::check()) {

                if (User::isSuperAdmin()) {
                    $campaign_obj = Campaign::with(['getAdvertiser' => function ($q) {
                        $q->with('Creative', 'GeoSegment', 'BWList');
                    }])->find($cmp_id);
                } else {
                    $usr_company = $this->user_company();
                    $campaign_obj = Campaign::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->with('Creative', 'GeoSegment', 'BWList')->find($cmp_id);

                    if (!$campaign_obj) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                $geolocation_obj = Geolocation::get();
                return view('bulk.assign')
                    ->with('geolocation_obj', $geolocation_obj)
                    ->with('campaign_obj', $campaign_obj);

            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

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
                    $adver_obj = Advertiser::get();
                } else {
                    $usr_company = $this->user_company();
                    $targetgroup = Targetgroup::whereHas('getCampaign', function ($p) use ($usr_company) {
                        $p->whereHas('getAdvertiser', function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        });
                    })->get();
                    $adver_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    })->get();
                    if (!$targetgroup) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                $iab_category_obj = Iab_Category::get();
                return view('bulk.targetgroup')
                    ->with('adver_obj', $adver_obj)
                    ->with('iab_category_obj', $iab_category_obj)
                    ->with('targetgroup_obj', $targetgroup);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
    }

    public function campaign_bulk(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CAMPAIGN', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => '']);
                if ($validate->passes()) {
                    $audit = new AuditsController();
                    $audit_key = $audit->generateRandomString();
                    foreach ($request->input('campaign') as $index) {
                        $data = array();
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
                        if ($campaign) {

                            $active = 'Inactive';
                            if ($request->input('active') == 'on') {
                                $active = 'Active';
                            }
                            if ($request->has('start_date')) {
                                $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
                            }
                            if ($request->has('end_date')) {
                                $end_date = \DateTime::createFromFormat('d.m.Y', $request->input('end_date'));
                            }
                            $active = 'Inactive';
                            if ($request->input('active') == 'on') {
                                $active = 'Active';
                            }
                            if ($request->has('name')) {
                                array_push($data, 'Name');
                                array_push($data, $request->input('name'));
                                $campaign->name = $request->input('name');
                            }
//                        if ($active) {
//                            array_push($data, 'Status');
//                            array_push($data, $campaign->status);
//                            array_push($data, $active);
//                            $campaign->name = $active;
//                        }
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
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
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
                $validate = \Validator::make($request->all(), ['name' => '']);
                if ($validate->passes()) {
                    $audit = new AuditsController();
                    $audit_key = $audit->generateRandomString();
                    foreach ($request->input('creative') as $index) {
                        $data = array();
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
                        if ($creative) {
                            if ($request->has('size_width') and $request->has('size_height'))
                                $size = $request->input('size_width') . 'x' . $request->input('size_height');
                            $active = 'Inactive';
                            if ($request->input('active') == 'on') {
                                $active = 'Active';
                            }
                            if ($request->input('name')) {
                                array_push($data, 'Name');
                                array_push($data, $request->input('name'));
                                $creative->name = $request->input('name');
                            }
//                            if ($creative->status != $active) {
//                                array_push($data, 'Status');
//                                array_push($data, $creative->status);
//                                array_push($data, $active);
//                                $creative->status = $active;
//                            }
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
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));
    }
}
