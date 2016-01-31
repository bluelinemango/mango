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
                $client='';
                $advertiser='';
                $creative='';
                $geosegment='';
                $campaign='';
                $targetgroup='';
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
                        $query .=" and impression.created_at ". $time;
                    }
                    if($request->input('report_type')=='10m'){
                        $time="between '".date('Y-m-d H:i:s',time() - 600)."' and '".date('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=10;
                    }
                    if($request->input('report_type')=='1h'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60)."' and '".date('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=30;
                    }
                    if($request->input('report_type')=='3h'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 3)."' and '".date('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=60;
                    }
                    if($request->input('report_type')=='6h'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 6)."' and '".date('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=120;
                    }
                    if($request->input('report_type')=='1D'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 24)."' and '".date('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=300;
                    }
                    if($request->input('report_type')=='1M'){
                        $time="between '".date('Y-m-d H:i:s',time() - 60 * 60 * 24 * 30)."' and '".date('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=60*60;
                    }
                    if($request->input('report_type')=='rang'){
                        $start_date = DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
                        $end_date = DateTime::createFromFormat('d.m.Y', $request->input('end_date'));
                        $time="between '".$start_date->format('Y-m-d H:i:s')."' and '".$end_date->format('Y-m-d H:i:s')."'";
                        $query .=" and impression.created_at ". $time;
                        $interval=24*60*60;
                    }

                    switch ($type) {
                        case 'client':
                            $client = DB::table('impression')
                                ->join('client', 'impression.client_id', '=', 'client.id')
                                ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.client_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            if ($request->input('advertiser') == '' ) {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->whereRaw($query)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            break;
                        case 'report_type':
                            $client = DB::table('impression')
                                ->join('client', 'impression.client_id', '=', 'client.id')
                                ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.client_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            $advertiser = DB::table('impression')
                                ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.advertiser_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            $campaign = DB::table('impression')
                                ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.campaign_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            $targetgroup = DB::table('impression')
                                ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.targetgroup_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            $creative = DB::table('impression')
                                ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.creative_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            $geosegment = DB::table('impression')
                                ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.geosegment_id')
                                ->orderBy('imps', 'DESC')
                                ->get();
                            break;
                        case 'campaign':
                            $campaign_client_advertiser=Campaign::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->find($request->input('campaign'));

                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->whereRaw($query)
                                    ->where('impression.client_id',$campaign_client_advertiser->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->whereRaw($query)
                                    ->where('impression.advertiser_id',$campaign_client_advertiser->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $campaign = DB::table('impression')
                                ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.campaign_id')
                                ->orderBy('imps', 'DESC')
                                ->get();

                            break;
                        case 'targetgroup':
                            $targetgroup_client_advertiser=Targetgroup::with(['getCampaign'=>function($q) {
                                $q->with(['getAdvertiser' => function ($p) {
                                    $p->with('GetClientID');
                                }]);
                            }])
                                ->find($request->input('targetgroup'));
                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->whereRaw($query)
                                    ->where('impression.client_id',$targetgroup_client_advertiser->getCampaign->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->whereRaw($query)
                                    ->where('impression.advertiser_id',$targetgroup_client_advertiser->getCampaign->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            if ($request->input('campaign') == '') {
                                $campaign = DB::table('impression')
                                    ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                                    ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                                    ->where('impression.campaign_id',$targetgroup_client_advertiser->getCampaign->id)
                                    ->groupBy('impression.campaign_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $targetgroup = DB::table('impression')
                                ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                                ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.targetgroup_id')
                                ->orderBy('imps', 'DESC')
                                ->get();

                            break;
                        case 'advertiser':
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
                            break;
                        case 'creative':
                            $creativ_client_advertiser=Creative::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->find($request->input('creative'));
                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->whereRaw($query)
                                    ->where('impression.client_id',$creativ_client_advertiser->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->whereRaw($query)
                                    ->where('impression.advertiser_id',$creativ_client_advertiser->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $creative = DB::table('impression')
                                ->join('creative', 'impression.creative_id', '=', 'creative.id')
                                ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.creative_id')
                                ->orderBy('imps', 'DESC')
                                ->get();

                            break;
                        case 'geosegment':
                            $geosegment_client_advertiser=GeoSegmentList::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->find($request->input('geosegment'));
//                            return dd($geosegment_client_advertiser->getAdvertiser);
                            if ($request->input('client') == '') {
                                $client = DB::table('impression')
                                    ->join('client', 'impression.client_id', '=', 'client.id')
                                    ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                                    ->whereRaw($query)
                                    ->where('impression.client_id',$geosegment_client_advertiser->getAdvertiser->GetClientID->id)
                                    ->groupBy('impression.client_id')
                                    ->orderBy('imps','DESC')
                                    ->get();
                            }
                            if ($request->input('advertiser') == '') {
                                $advertiser = DB::table('impression')
                                    ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                                    ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                                    ->whereRaw($query)
                                    ->where('impression.advertiser_id',$geosegment_client_advertiser->getAdvertiser->id)
                                    ->groupBy('impression.advertiser_id')
                                    ->orderBy('imps', 'DESC')
                                    ->get();
                            }
                            $geosegment = DB::table('impression')
                                ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                                ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                                ->whereRaw($query)
                                ->groupBy('impression.geosegment_id')
                                ->orderBy('imps', 'DESC')
                                ->get();

                            break;
                        case 'client_unfilter':
                            $client = DB::table('impression')
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
                            break;
                    }

                    if ($request->input('client') == '' and $client=='' ) {
                        $client = DB::table('impression')
                            ->join('client', 'impression.client_id', '=', 'client.id')
                            ->select(DB::raw('count(impression.client_id) as imps, impression.client_id as id , client.name'))
                            ->whereRaw($query)
                            ->groupBy('impression.client_id')
                            ->orderBy('imps', 'DESC')
                            ->get();
                    }
                    if ($request->input('advertiser') == '' and $advertiser=='' ) {
                        $advertiser = DB::table('impression')
                            ->join('advertiser', 'impression.advertiser_id', '=', 'advertiser.id')
                            ->select(DB::raw('count(impression.advertiser_id) as imps, impression.advertiser_id as id , advertiser.name'))
                            ->whereRaw($query)
                            ->groupBy('impression.advertiser_id')
                            ->orderBy('imps', 'DESC')
                            ->get();
                    }
                    if ($request->input('campaign') == '' and $campaign=='' ) {
                        $campaign = DB::table('impression')
                            ->join('campaign', 'impression.campaign_id', '=', 'campaign.id')
                            ->select(DB::raw('count(impression.campaign_id) as imps, impression.campaign_id as id , campaign.name'))
                            ->whereRaw($query)
                            ->groupBy('impression.campaign_id')
                            ->orderBy('imps', 'DESC')
                            ->get();
                    }
                    if ($request->input('targetgroup') == '') {
                        $targetgroup = DB::table('impression')
                            ->join('targetgroup', 'impression.targetgroup_id', '=', 'targetgroup.id')
                            ->select(DB::raw('count(impression.targetgroup_id) as imps, impression.targetgroup_id as id , targetgroup.name'))
                            ->whereRaw($query)
                            ->groupBy('impression.targetgroup_id')
                            ->orderBy('imps', 'DESC')
                            ->get();
                    }
                    if ($request->input('creative') == '') {
                        $creative = DB::table('impression')
                            ->join('creative', 'impression.creative_id', '=', 'creative.id')
                            ->select(DB::raw('count(impression.creative_id) as imps, impression.creative_id as id , creative.name'))
                            ->whereRaw($query)
                            ->groupBy('impression.creative_id')
                            ->orderBy('imps', 'DESC')
                            ->get();
                    }
                    if ($request->input('geosegmentlist') == '') {
                        $geosegment = DB::table('impression')
                            ->join('geosegmentlist', 'impression.geosegment_id', '=', 'geosegmentlist.id')
                            ->select(DB::raw('count(impression.geosegment_id) as imps, impression.geosegment_id as id , geosegmentlist.name'))
                            ->whereRaw($query)
                            ->groupBy('impression.geosegment_id')
                            ->orderBy('imps', 'DESC')
                            ->get();
                    }



//                    return dd($query);

                    if($time!='') {
                        $impChart = Impression::where('event_type', 'impression')
                            ->whereRaw($query)
                            ->whereRaw('created_at ' . $time)
                            ->orderBy('created_at', 'ASC')
                            ->get();
                        $imps = 1;
                        $flg = 0;
//                        return dd($impChart);
                        $impsString = "Date,Imps\n";
                        if($impChart){
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

                        }

//                        return dd($impsString);
                        $clkChart = Impression::where('event_type', 'click')
                            ->whereRaw($query)
                            ->whereRaw('created_at ' . $time)
                            ->orderBy('created_at', 'ASC')
                            ->get();
                        $imps = 1;
                        $flg = 0;
                        $clkString = "Date,Clicks\n";
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
                        $cnvChart = Impression::where('event_type', 'conversion')
                            ->whereRaw($query)
                            ->whereRaw('created_at ' . $time)
                            ->orderBy('created_at', 'ASC')
                            ->get();
                        $imps = 1;
                        $flg = 0;
                        $cnvString = "Date,Conversion\n";
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
                        array_push($arr, $client);
                        array_push($arr, $advertiser);
                        array_push($arr, $creative);
                        array_push($arr, $geosegment);
                        array_push($arr, $campaign);
                        array_push($arr, $targetgroup);
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
