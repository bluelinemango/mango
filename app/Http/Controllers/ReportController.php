<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Creative;
use App\Models\GeoSegmentList;
use App\Models\Impression;
use App\Models\Targetgroup;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    public function GetView()
    {
        if (Auth::check()) {
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $clientArry = Client::get(['id'])->toArray();
                    $advertiserArry = Advertiser::get(['id'])->toArray();
                    $clients = DB::table('impression')
                        ->join('client', 'impression.client_id', '=', 'client.id')
                        ->select(DB::raw('count(impression.client_id) as imps, impression.client_id , client.name'))
                        ->whereIn('impression.advertiser_id',$advertiserArry)
                        ->whereIn('impression.client_id',$clientArry)
                        ->groupBy('impression.client_id')
                        ->orderBy('imps','DESC')
                        ->get();
                    $advertiser = DB::table('impression')
                        ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                        ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id , advertiser.name'))
                        ->whereIn('impression.advertiser_id',$advertiserArry)
                        ->whereIn('impression.client_id',$clientArry)
                        ->groupBy('impression.advertiser_id')
                        ->orderBy('imps','DESC')
                        ->get();
                    $campaign = DB::table('impression')
                        ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                        ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id , campaign.name'))
                        ->whereIn('impression.advertiser_id',$advertiserArry)
                        ->whereIn('impression.client_id',$clientArry)
                        ->groupBy('impression.campaign_id')
                        ->orderBy('imps','DESC')
                        ->get();
//                    return dd($campaign);
                    $targetgroup = DB::table('impression')
                        ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                        ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id , targetgroup.name'))
                        ->whereIn('impression.advertiser_id',$advertiserArry)
                        ->whereIn('impression.client_id',$clientArry)
                        ->groupBy('impression.targetgroup_id')
                        ->orderBy('imps','DESC')
                        ->get();
                    $creative = DB::table('impression')
                        ->join('creative', 'impression.creative_id', '=', 'creative.id')
                        ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id , creative.name'))
                        ->whereIn('impression.advertiser_id',$advertiserArry)
                        ->whereIn('impression.client_id',$clientArry)
                        ->groupBy('impression.creative_id')
                        ->orderBy('imps','DESC')
                        ->get();
                    $geosegment = DB::table('impression')
                        ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                        ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id , geosegmentlist.name'))
                        ->whereIn('impression.advertiser_id',$advertiserArry)
                        ->whereIn('impression.client_id',$clientArry)
                        ->groupBy('impression.geosegment_id')
                        ->orderBy('imps','DESC')
                        ->get();
//                    $advertiser = Advertiser::with(['Campaign' => function ($q) {
//                        $q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');
//                    }])->with('GetClientID')->get();
                } else {
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $clients = Client::whereIn('user_id', $usr_company)->get();

                    $advertiser = Advertiser::with(['GetClientID' => function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    }])->get();
                }
//                return dd($advertiser);
                return view('report.report')
                    ->with('clients', $clients)
                    ->with('advertiser', $advertiser)
                    ->with('campaign', $campaign)
                    ->with('targetgroup', $targetgroup)
                    ->with('creative', $creative)
                    ->with('geosegment', $geosegment);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function ChangeState(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
                $type = $request->input('type');
                $arr = array();
                array_push($arr, $type);
                $time='';
                if (User::isSuperAdmin()) {
                    $clientArry = Client::get(['id'])->toArray();
                    $advertiserArry = Advertiser::get(['id'])->toArray();
                    $query="1 = 1 ";
                    if($request->has('client') ){
                        $query .=" and impression.client_id=".$request->input('client');
                    }
                    if($request->has('advertiser') ){
                        $query .=" and impression.advertiser_id=".$request->input('advertiser');
                    }
                    if($request->has('creative') ){
                        $query .=" and impression.creative_id=".$request->input('creative');
                    }
                    if($request->has('geosegment') ){
                        $query .=" and impression.geosegment_id=".$request->input('geosegment');
                    }
                    if($request->has('campaign') ){
                        $query .=" and impression.campaign_id=".$request->input('campaign');
                    }
                    if($request->has('targetgroup') ){
                        $query .=" and impression.targetgroup_id=".$request->input('targetgroup');
                    }
                    if($request->input('report_type')=='today'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 24)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=300;
                    }
                    if($request->input('report_type')=='10mins'){
                        $time="between '".date('Y-m-d H:i:s',time() - 600)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=10;
                    }
                    if($request->input('report_type')=='1h'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=30;
                    }
                    if($request->input('report_type')=='3h'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 3)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=60;
                    }
                    if($request->input('report_type')=='6h'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 6)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=120;
                    }
                    if($request->input('report_type')=='1D'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 24)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=300;
                    }
                    if($request->input('report_type')=='1M'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 24 * 30)."' and '".date('Y-m-d H:i:s')."'";
                        $interval=6*60*60;
                    }
                    if($request->input('report_type')=='rang'){
                        $start_date = DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
                        $end_date = DateTime::createFromFormat('d.m.Y', $request->input('end_date'));
                        $time="between '".$start_date."' and '".$end_date."'";
                        $interval=24*60*60;
                    }

                    switch ($type) {
                        case 'client':
                            $advertiser = DB::table('impression')
                                ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id , advertiser.name'))
                                ->where('impression.client_id',$request->input('client'))
                                ->groupBy('impression.advertiser_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $campaign = DB::table('impression')
                                ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id , campaign.name'))
                                ->where('impression.client_id',$request->input('client'))
                                ->groupBy('impression.campaign_id')
                                ->orderBy('imps','DESC')
                                ->get();
//                    return dd($campaign);
                            $targetgroup = DB::table('impression')
                                ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id , targetgroup.name'))
                                ->where('impression.client_id',$request->input('client'))
                                ->groupBy('impression.targetgroup_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $creative = DB::table('impression')
                                ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id , creative.name'))
                                ->where('impression.client_id',$request->input('client'))
                                ->groupBy('impression.creative_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $geosegment = DB::table('impression')
                                ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id , geosegmentlist.name'))
                                ->where('impression.client_id',$request->input('client'))
                                ->groupBy('impression.geosegment_id')
                                ->orderBy('imps','DESC')
                                ->get();

//                            return $impsString;
//                            $advertiser.put('type',$type);
                            array_push($arr, $advertiser);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            array_push($arr, $campaign);
                            array_push($arr, $targetgroup);
                            break;
                        case 'campaign':
                            $client='no_data';
                            $advertiser='no_data';
                            $creative='no_data';
                            $geosegment='no_data';
                            $creativ_client_advertiser=Creative::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->find($request->input('creative'));

                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->where('impression.campaign_id',$request->input('campaign'))
                                    ->where('impression.client_id',$creativ_client_advertiser->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->where('impression.campaign_id', $request->input('campaign'))
                                    ->where('impression.advertiser_id',$creativ_client_advertiser->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $campaign = DB::table('impression')
                                ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                ->where('impression.campaign_id',$request->input('campaign'))
                                ->groupBy('impression.campaign_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $targetgroup = DB::table('impression')
                                ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                ->where('impression.campaign_id',$request->input('campaign'))
                                ->groupBy('impression.targetgroup_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            if ($request->input('creative') == '') {
                                $creative = DB::table('impression')
                                    ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                    ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                    ->where('impression.campaign_id', $request->input('campaign'))
                                    ->groupBy('impression.creative_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('geosegment') == '') {
                                $geosegment = DB::table('impression')
                                    ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                    ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                    ->where('impression.campaign_id', $request->input('campaign'))
                                    ->groupBy('impression.geosegment_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            array_push($arr, $client);
                            array_push($arr, $advertiser);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            array_push($arr, $campaign);
                            array_push($arr, $targetgroup);
                            break;
                        case 'advertiser':
                            $client='no_data';
                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->where('impression.advertiser_id',$request->input('advertiser'))
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            $advertiser = DB::table('impression')
                                ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.advertiser_id')
                                ->orderBy('imps','DESC')
                                ->get();
//                            return dd($advertiser);
                            $campaign = DB::table('impression')
                                ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.campaign_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $targetgroup = DB::table('impression')
                                ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.targetgroup_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $creative = DB::table('impression')
                                ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.creative_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $geosegment = DB::table('impression')
                                ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.geosegment_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            array_push($arr, $client);
                            array_push($arr, $advertiser);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            array_push($arr, $campaign);
                            array_push($arr, $targetgroup);
                            break;
                        case 'creative':
                            $client='no_data';
                            $advertiser='no_data';
                            $campaign='no_data';
                            $targetgroup='no_data';
                            $geosegment='no_data';
                            $creativ_client_advertiser=Creative::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->find($request->input('creative'));
//                            return dd($creativ_client_advertiser->getAdvertiser);
                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->where('impression.creative_id',$request->input('creative'))
                                    ->where('impression.client_id',$creativ_client_advertiser->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->where('impression.creative_id', $request->input('creative'))
                                    ->where('impression.advertiser_id',$creativ_client_advertiser->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('campaign') == '') {
                                $campaign = DB::table('impression')
                                    ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                    ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                    ->where('impression.creative_id', $request->input('creative'))
                                    ->groupBy('impression.campaign_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('targetgroup') == '') {
                                $targetgroup = DB::table('impression')
                                    ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                    ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                    ->where('impression.creative_id', $request->input('creative'))
                                    ->groupBy('impression.targetgroup_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $creative = DB::table('impression')
                                ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                ->where('impression.creative_id', $request->input('creative'))
                                ->groupBy('impression.creative_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            if ($request->input('geosegment') == '') {
                                $geosegment = DB::table('impression')
                                    ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                    ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                    ->where('impression.creative_id', $request->input('creative'))
                                    ->groupBy('impression.geosegment_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            array_push($arr, $client);
                            array_push($arr, $advertiser);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            array_push($arr, $campaign);
                            array_push($arr, $targetgroup);
                        break;
                        case 'geosegment':
                            $client='no_data';
                            $advertiser='no_data';
                            $campaign='no_data';
                            $targetgroup='no_data';
                            $creative='no_data';
                            $geosegment_client_advertiser=GeoSegmentList::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->find($request->input('geosegment'));
//                            return dd($geosegment_client_advertiser->getAdvertiser);
                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->where('impression.geosegment_id',$request->input('geosegment'))
                                    ->where('impression.client_id',$geosegment_client_advertiser->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->where('impression.geosegment_id', $request->input('geosegment'))
                                    ->where('impression.advertiser_id',$geosegment_client_advertiser->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('campaign') == '') {
                                $campaign = DB::table('impression')
                                    ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                    ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                    ->where('impression.geosegment_id', $request->input('geosegment'))
                                    ->groupBy('impression.campaign_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('targetgroup') == '') {
                                $targetgroup = DB::table('impression')
                                    ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                    ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                    ->where('impression.geosegment_id', $request->input('geosegment'))
                                    ->groupBy('impression.targetgroup_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('creative') == '') {
                                $creative = DB::table('impression')
                                    ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                    ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                    ->where('impression.geosegment_id', $request->input('geosegment'))
                                    ->groupBy('impression.creative_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $geosegment = DB::table('impression')
                                ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                ->where('impression.geosegment_id', $request->input('geosegment'))
                                ->groupBy('impression.geosegment_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            array_push($arr, $client);
                            array_push($arr, $advertiser);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            array_push($arr, $campaign);
                            array_push($arr, $targetgroup);
                        break;
                        case 'client_unfilter':
                            $clients = DB::table('impression')
                                ->join('client', 'impression.client_id', '=', 'client.id')
                                ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                ->whereIn('impression.advertiser_id',$advertiserArry)
                                ->whereIn('impression.client_id',$clientArry)
                                ->groupBy('impression.client_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $advertiser = DB::table('impression')
                                ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                ->whereIn('impression.advertiser_id',$advertiserArry)
                                ->whereIn('impression.client_id',$clientArry)
                                ->groupBy('impression.advertiser_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $campaign = DB::table('impression')
                                ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                ->whereIn('impression.advertiser_id',$advertiserArry)
                                ->whereIn('impression.client_id',$clientArry)
                                ->groupBy('impression.campaign_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $targetgroup = DB::table('impression')
                                ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                ->whereIn('impression.advertiser_id',$advertiserArry)
                                ->whereIn('impression.client_id',$clientArry)
                                ->groupBy('impression.targetgroup_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $creative = DB::table('impression')
                                ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                ->whereIn('impression.advertiser_id',$advertiserArry)
                                ->whereIn('impression.client_id',$clientArry)
                                ->groupBy('impression.creative_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            $geosegment = DB::table('impression')
                                ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                ->whereIn('impression.advertiser_id',$advertiserArry)
                                ->whereIn('impression.client_id',$clientArry)
                                ->groupBy('impression.geosegment_id')
                                ->orderBy('imps','DESC')
                                ->get();
                            array_push($arr, $clients);
                            array_push($arr, $advertiser);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            array_push($arr, $campaign);
                            array_push($arr, $targetgroup);
                            break;
                        case 'advertiser_unfilter':
                            $advertiser = Advertiser::where('client_id', $request->input('client'))
                                ->orderBy('created_at', 'DESC')
                                ->get(['id', 'name']);
//                            $advertiser.put('type',$type);
                            array_push($arr, $advertiser);
                            break;
                        case 'campaign_unfilter':
                            if ($request->input('client') != '' and $request->input('advertiser') == '') {
                                $campaign = Campaign::with(['getAdvertiser' => function ($q) use ($request) {
                                    $q->with('GetClientID')->where('client_id', $request->input('client'));
                                }])
                                    ->orderBy('created_at', 'DESC')
                                    ->get();
                                $targetgroup = Targetgroup::with(['getCampaign'=>function($q)use($request){
                                    $q->with(['getAdvertiser'=>function($p)use($request){
                                        $p->where('client_id',$request->input('client'));
                                    }]) ;
                                }])->get();
                                array_push($arr, $campaign);
                                array_push($arr, $targetgroup);
                            } elseif ($request->input('advertiser') != '' and $request->input('client') == '') {
                                $campaign = Campaign::with(['getAdvertiser' => function ($q) use ($request) {
                                    $q->with('GetClientID')->where('id', $request->input('advertiser'));
                                }])
                                    ->orderBy('created_at', 'DESC')
                                    ->get(['id', 'name']);
                                $targetgroup = Targetgroup::with(['getCampaign'=>function($q)use($request){
                                    $q->with(['getAdvertiser'=>function($p)use($request){
                                        $p->where('id',$request->input('advertiser'));
                                    }]) ;
                                }])->get();

                                array_push($arr, $campaign);
                                array_push($arr, $targetgroup);
                            } else {
                                $campaign = Campaign::with(['getAdvertiser' => function ($q) use ($request) {
                                    $q->with('GetClientID')->where('id', $request->input('advertiser'));
                                }])
                                    ->orderBy('created_at', 'DESC')
                                    ->get(['id', 'name']);
                                $targetgroup = Targetgroup::with(['getCampaign'=>function($q)use($request){
                                    $q->with(['getAdvertiser'=>function($p)use($request){
                                        $p->where('id',$request->input('advertiser'));
                                    }]) ;
                                }])->get();
                                array_push($arr, $campaign);
                                array_push($arr, $targetgroup);
                            }
//                            $advertiser.put('type',$type);
                            break;
                        case 'creative_unfilter':  //todo: chek with: enevt table
                            $creative = Creative::with(['getAdvertiser'=>function($q)use($request){
                                $q->where('id', $request->input('creative'));
                            }])->get();
//                            return dd($creative);
                            array_push($arr, $creative);
                            break;
                        case 'geosegment_unfilter': //todo: chek with: enevt table
                            $geosegment = GeoSegmentList::with(['getAdvertiser'=>function($q)use($request){
                                $q->where('id', $request->input('creative'));
                            }])->get();
//                            return dd($creative);
                            array_push($arr, $creative);
                            break;


                    }
                    if($time!='') {
                        $impChart = Impression::where('event_type', 'impression')
                            ->whereRaw($query)
                            ->whereRaw('created_at ' . $time)
                            ->orderBy('created_at', 'ASC')
                            ->get();
                        $imps = 1;
                        $flg = 0;
                        $impsString = 'Date,Imps\n';
                        foreach ($impChart as $key => $index) {
                            if ($flg == 0) {
                                $timeToShow = $index->created_at;
                                $firstHop = strtotime($index->created_at);
                                $nextHop = $firstHop + $interval;
                                $flg = 1;
                            }
                            if (isset($impChart[$key + 1]) and strtotime($impChart[$key + 1]->created_at) >= $nextHop) {
                                $impsString .= $timeToShow . ",0;" . $imps . ";0\n";
                                $flg = 0;
                                $imps = 0;
                            }
                            if (!isset($impChart[$key + 1])) {

                            }
                            $imps++;
                        }
                        $clkChart = Impression::where('event_type', 'click')
                            ->whereRaw($query)
                            ->whereRaw('created_at ' . $time)
                            ->orderBy('created_at', 'ASC')
                            ->get();
                        $imps = 1;
                        $flg = 0;
                        $clkString = 'Date,clicks\n';
                        foreach ($clkChart as $key => $index) {
                            if ($flg == 0) {
                                $timeToShow = $index->created_at;
                                $firstHop = strtotime($index->created_at);
                                $nextHop = $firstHop + $interval;
                                $flg = 1;
                            }
                            if (isset($clkChart[$key + 1]) and strtotime($clkChart[$key + 1]->created_at) >= $nextHop) {
                                $clkString .= $timeToShow . ",0;" . $imps . ";0\n";
                                $flg = 0;
                                $imps = 0;
                            }
                            if (!isset($clkChart[$key + 1])) {

                            }
                            $imps++;
                        }
                        $cnvChart = Impression::where('event_type', 'converjent')
                            ->whereRaw($query)
                            ->whereRaw('created_at ' . $time)
                            ->orderBy('created_at', 'ASC')
                            ->get();
                        $imps = 1;
                        $flg = 0;
                        $cnvString = 'Date,conv\n';
                        foreach ($cnvChart as $key => $index) {
                            if ($flg == 0) {
                                $timeToShow = $index->created_at;
                                $firstHop = strtotime($index->created_at);
                                $nextHop = $firstHop + $interval;
                                $flg = 1;
                            }
                            if (isset($cnvChart[$key + 1]) and strtotime($cnvChart[$key + 1]->created_at) >= $nextHop) {
                                $cnvString .= $timeToShow . ",0;" . $imps . ";0\n";
                                $flg = 0;
                                $imps = 0;
                            }
                            if (!isset($cnvChart[$key + 1])) {

                            }
                            $imps++;
                        }
                        array_push($arr, $impsString);
                        array_push($arr, $clkString);
                        array_push($arr, $cnvString);
                    }
                    return json_encode($arr);


                    $clients = Client::get();
                    $advertiser = Advertiser::get();

//                    $advertiser = Advertiser::with(['Campaign' => function ($q) {
//                        $q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');
//                    }])->with('GetClientID')->get();
                } else {
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $clients = Client::whereIn('user_id', $usr_company)->get();

                    $advertiser = Advertiser::with(['GetClientID' => function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    }])->get();
                }
//                return dd($advertiser);
                return view('report.report')
                    ->with('clients', $clients)
                    ->with('advertiser', $advertiser);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
