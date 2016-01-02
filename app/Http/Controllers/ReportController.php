<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Creative;
use App\Models\GeoSegmentList;
use App\Models\Targetgroup;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    public function GetView()
    {
        if (Auth::check()) {
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $clients = Client::get(['id','name']);
                    $advertiser = Advertiser::get(['id','name']);
                    $targetgroup=Targetgroup::get(['id','name']);
                    $campaign=Campaign::get(['id','name']);
                    $creative=Creative::get(['id','name']);
                    $geosegment=GeoSegmentList::get(['id','name']);
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
                if (User::isSuperAdmin()) {
                    switch ($type){
                        case 'client':
                            $client=Client::where('id',$request->input('client'))
                                ->get(['id','name']);
                            $advertiser=Advertiser::where('client_id',$request->input('client'))
                                ->orderBy('created_at','DESC')
                                ->get(['id','name']);
//                            $advertiser.put('type',$type);
                            $arr = array();
                            array_push($arr,$type);
                            array_push($arr,$client);
                            array_push($arr,$advertiser);
                            return json_encode($arr);
                        break;
                        case 'campaign':
                            $campaign=Campaign::where('id',$request->input('campaign'))->get(['id','name']);
                            $targetgroup=Targetgroup::where('campaign_id',$request->input('campaign'))
                                ->orderBy('created_at','DESC')
                                ->get(['id','name']);
//                            $advertiser.put('type',$type);
                            $arr = array();
                            array_push($arr,$type);
                            array_push($arr,$campaign);
                            array_push($arr,$targetgroup);
                            if($request->input('client')=='' and $request->input('advertiser')==''){
                                $client=Campaign::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])
                                    ->where('id',$request->input('campaign'))->first();
                                array_push($arr,$client);
                            }

                            return json_encode($arr);
                        break;
                        case 'advertiser':
                            $arr = array();
                            array_push($arr, $type);
                            $advertiser=Advertiser::where('id',$request->input('advertiser'))->get(['id','name']);
                            $campaign = Campaign::where('advertiser_id', $request->input('advertiser'))
                                ->orderBy('created_at', 'DESC')
                                ->get(['id', 'name']);
                            $creative = Creative::where('advertiser_id', $request->input('advertiser'))
                                ->orderBy('created_at', 'DESC')
                                ->get(['id', 'name']);
                            $geosegment = GeoSegmentList::where('advertiser_id', $request->input('advertiser'))
                                ->orderBy('created_at', 'DESC')
                                ->get(['id', 'name']);
                            array_push($arr, $advertiser);
                            array_push($arr, $campaign);
                            array_push($arr, $creative);
                            array_push($arr, $geosegment);
                            if($request->input('client')==''){
                                $client=Advertiser::with('GetClientID')->where('id',$request->input('advertiser'))->first();
                                array_push($arr,$client);
                            }
                            return json_encode($arr);
                        break;
                        case 'client_unfilter':
                            $clients = Client::get(['id','name']);
                            $advertiser = Advertiser::get(['id','name']);
                            $targetgroup=Targetgroup::get(['id','name']);
                            $campaign=Campaign::get(['id','name']);
                            $creative=Creative::get(['id','name']);
                            $geosegment=GeoSegmentList::get(['id','name']);
                            $arr = array();
                            array_push($arr,$type);
                            array_push($arr,$clients);
                            array_push($arr,$advertiser);
                            array_push($arr,$campaign);
                            array_push($arr,$targetgroup);
                            array_push($arr,$creative);
                            array_push($arr,$geosegment);
                            return json_encode($arr);
                        break;
                        case 'advertiser_unfilter':
                            $advertiser=Advertiser::where('client_id',$request->input('client'))
                                ->orderBy('created_at','DESC')
                                ->get(['id','name']);
//                            $advertiser.put('type',$type);
                            $arr = array();
                            array_push($arr,$type);
                            array_push($arr,$advertiser);
                            return json_encode($arr);
                        break;

                    }
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
