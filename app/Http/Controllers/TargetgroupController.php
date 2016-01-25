<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Advertiser_Publisher;
use App\Models\Campaign;
use App\Models\Geolocation;
use App\Models\Iab_Category;
use App\Models\Iab_Sub_Category;
use App\Models\Targetgroup;
use App\Models\Targetgroup_Bid_Advpublisher;
use App\Models\Targetgroup_Bidhour_Map;
use App\Models\Targetgroup_Bwlist_Map;
use App\Models\Targetgroup_Creative_Map;
use App\Models\Targetgroup_Geolocation_Map;
use App\Models\Targetgroup_Geosegmentlist_Map;
use App\Models\User;
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
            if (in_array('VIEW_TARGETGROUP', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $targetgroup = Targetgroup::with(['getCampaign' => function ($q) {
                        $q->with(['getAdvertiser' => function ($p) {
                            $p->with('GetClientID');
                        }]);
                    }])->get();
                }else{
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $targetgroup = Targetgroup::with(['getCampaign' => function ($p) use($usr_company) {
                        $p->with(['getAdvertiser' => function ($q) use ($usr_company) {
                            $q->with(['GetClientID' => function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            }]);
                        }]);
                    }])->get();
                }
                return view('targetgroup.list')->with('targetgroup_obj',$targetgroup);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function TargetgroupAddView($clid,$advid,$cmpid){
        if(Auth::check()) {
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $chkUser = Advertiser::with('GetClientID')->find($advid);
                if(count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                    $campaign_obj=Campaign::with(['getAdvertiser'=>function($q){
                        $q->with('Creative')->with('GeoSegment')->with('BWList');
                    }])->find($cmpid);
                    $geolocation_obj=Geolocation::get();
                    $iab_category_obj=Iab_Category::get();
                    return view('targetgroup.add')
                        ->with('campaign_obj',$campaign_obj)
                        ->with('geolocation_obj',$geolocation_obj)
                        ->with('iab_category_obj',$iab_category_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));

    }

    public function add_targetgroup(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $checkAdv=Campaign::find($request->input('campaign_id'));
                    $chekUser=Advertiser::with('GetClientID')->find($checkAdv->advertiser_id);
                    if(count($chekUser) > 0 and Auth::user()->id == $chekUser->GetClientID->user_id) {
                        $bid_hour='';
                        for($i=0;$i<7;$i++){
                            for($j=0;$j<25;$j++){
                                if($j<13) {
                                    if (!is_null($request->input($i . '-' . $j . '-am'))) {
                                        $bid_hour1[$j] = "1";
                                    } else {
                                        $bid_hour1[$j] = "0";
                                    }
                                }else{
                                    if(!is_null($request->input($i.'-'.($j-13).'-pm'))){
                                        $bid_hour1[$j]="1";
                                    }else {
                                        $bid_hour1[$j]="0";
                                    }

                                }
                            }
                            $bid_hour[$i+1]=$bid_hour1;
                        }
//                        return dd(json_encode($bid_hour));
                        $start_date = \DateTime::createFromFormat('m/d/Y', $request->input('start_date'));
                        $end_date = \DateTime::createFromFormat('m/d/Y', $request->input('end_date'));
                        $key_audit= new AuditsController();
                        $key_audit=$key_audit->generateRandomString();
                        $targetgroup = new Targetgroup();
                        $targetgroup->name = $request->input('name');
                        $targetgroup->max_impression = $request->input('max_impression');
                        $targetgroup->daily_max_impression = $request->input('daily_max_impression');
                        $targetgroup->max_budget = $request->input('max_budget');
                        $targetgroup->daily_max_budget = $request->input('daily_max_budget');
                        $targetgroup->cpm = $request->input('cpm');
                        $targetgroup->advertiser_domain_name = $request->input('advertiser_domain_name');
                        $targetgroup->campaign_id = $request->input('campaign_id');
                        $targetgroup->pacing_plan = $request->input('pacing_plan');
                        $targetgroup->frequency_in_sec = $request->input('frequency_in_sec');
                        $targetgroup->iab_category = $request->input('iab_category');
                        $targetgroup->iab_sub_category = $request->input('iab_sub_category');
                        $targetgroup->start_date = $start_date;
                        $targetgroup->end_date = $end_date;
                        $targetgroup->save();

                        $publish_bid = $request->all();
                        foreach($publish_bid as $key => $value){
                            if (strpos($key,'-bid') !== false) {
                                $chkPublish=Advertiser_Publisher::find(substr($key,0,-4));
                                if(!is_null($chkPublish)) {
                                    $p_bid = new Targetgroup_Bid_Advpublisher();
                                    $p_bid->bid_price = $value;
                                    $p_bid->advertiser_publisher_id = substr($key, 0, -4);
                                    $p_bid->targetgroup_id = $targetgroup->id;
                                    $p_bid->save();
                                }
                            }
                        }

                        $target_bid_hour=new Targetgroup_Bidhour_Map();
                        $target_bid_hour->hours= json_encode($bid_hour);
                        $target_bid_hour->targetgroup_id= $targetgroup->id;
                        $target_bid_hour->save();
                        $audit= new AuditsController();
                        $audit->store('targetgroup',$targetgroup->id,null,'add',$key_audit);
                        if(count($request->input('to_geosegment'))>0){
                            $chk = array();
                            foreach($request->input('to_geosegment') as $index) {
                                if(!in_array($index,$chk)) {
                                    $geosegment_assign = new Targetgroup_Geosegmentlist_Map();
                                    $geosegment_assign->targetgroup_id = $targetgroup->id;
                                    $geosegment_assign->geosegmentlist_id = $index;
                                    $geosegment_assign->save();
                                    $audit->store('targetgroup_geosegment',$geosegment_assign->id,$targetgroup->id,'add',$key_audit);
                                    array_push($chk,$index);
                                }
                            }
                        }
                        if(count($request->input('to_creative'))>0){
                            $chk = array();
                            foreach($request->input('to_creative') as $index) {
                                if(!in_array($index,$chk)) {
                                    $creative_assign = new Targetgroup_Creative_Map();
                                    $creative_assign->targetgroup_id = $targetgroup->id;
                                    $creative_assign->creative_id = $index;
                                    $creative_assign->save();
                                    $audit->store('targetgroup_creative',$creative_assign->id,$targetgroup->id,'add',$key_audit);
                                    array_push($chk,$index);
                                }
                            }
                        }
                        if(count($request->input('to_geolocation'))>0){
                            $chk = array();
                            foreach($request->input('to_geolocation') as $index) {
                                if(!in_array($index,$chk)) {
                                    $geolocation_assign = new Targetgroup_Geolocation_Map();
                                    $geolocation_assign->targetgroup_id = $targetgroup->id;
                                    $geolocation_assign->geolocation_id = $index;
                                    $geolocation_assign->save();
                                    $audit->store('targetgroup_geolocation',$geolocation_assign->id,$targetgroup->id,'add',$key_audit);
                                    array_push($chk,$index);
                                }
                            }
                        }
                        if(count($request->input('blacklist'))>0 and count($request->input('whitelist'))==0) {
                            $chk = array();
                            foreach ($request->input('blacklist') as $index) {
                                if (!in_array($index, $chk)) {
                                    $blacklist_assign = new Targetgroup_Bwlist_Map();
                                    $blacklist_assign->targetgroup_id = $targetgroup->id;
                                    $blacklist_assign->bwlist_id = $index;
                                    $blacklist_assign->save();
                                    $audit->store('targetgroup_bwlist',$blacklist_assign->id,$targetgroup->id,'add',$key_audit);

                                    array_push($chk, $index);
                                }
                            }
                        }elseif(count($request->input('blacklist'))==0 and count($request->input('whitelist'))>0){
                            $chk = array();
                            foreach ($request->input('whitelist') as $index) {
                                if (!in_array($index, $chk)) {
                                    $whitelist_assign = new Targetgroup_Bwlist_Map();
                                    $whitelist_assign->targetgroup_id = $targetgroup->id;
                                    $whitelist_assign->bwlist_id = $index;
                                    $whitelist_assign->save();
                                    $audit->store('targetgroup_bwlist',$whitelist_assign->id,$targetgroup->id,'add',$key_audit);

                                    array_push($chk, $index);
                                }
                            }
                        }else{
                            //return 2 ta chiz baham select shode
                        }
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }


    public function TargetgroupEditView($clid,$advid,$cmpid,$tgid){
        if(!is_null($tgid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                    $chkUser=Targetgroup::with(['getCampaign'=>function($q){$q->with(['getAdvertiser'=>function($p){$p->with('GetClientID');}]);}])->find($tgid);
                    $usrId=$chkUser->getCampaign->getAdvertiser->GetClientID->user_id;
                    if(!is_null($chkUser) and Auth::user()->id ==$usrId ) {
                        $targetgroup_obj = Targetgroup::with(['getCampaign'=>function($q){$q->with(['getAdvertiser'=>function($p){$p->with('GetClientID');}]);}])
                            ->with('getCreative')
                            ->with('getBWList')
                            ->with('getGeoSegment')
                            ->find($tgid);
                        $campaign_obj=Campaign::with(['getAdvertiser'=>function($q){
                            $q->with('Creative')->with('GeoSegment')->with('BWList');
                        }])->find($cmpid);
                        $targetgroupCreative = array();
                        $targetgroupBWList = array();
                        $targetgroupGeoSegment = array();
                        if(count($targetgroup_obj->getCreative)>0) {
                            foreach($targetgroup_obj->getCreative as $index) {
                                array_push($targetgroupCreative,$index->creative_id);
                            }
                        }
                        if(count($targetgroup_obj->getBWList)>0) {
                            foreach ($targetgroup_obj->getBWList as $index) {
                                array_push($targetgroupBWList,$index->bwlist_id);
                            }
                        }
                        if(count($targetgroup_obj->getGeoSegment)>0) {
                            foreach ($targetgroup_obj->getGeoSegment as $index) {
                                array_push($targetgroupGeoSegment,$index->geosegmentlist_id);
                            }
                        }
                        $iab_category_obj=Iab_Category::get();

                        return view('targetgroup.edit')
                            ->with('targetgroup_obj', $targetgroup_obj)
                            ->with('campaign_obj',$campaign_obj)
                            ->with('targetgroupCreative',$targetgroupCreative)
                            ->with('targetgroupBWList',$targetgroupBWList)
                            ->with('targetgroupGeoSegment',$targetgroupGeoSegment)
                            ->with('iab_category_obj',$iab_category_obj);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_targetgroup(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $targetgroup_id = $request->input('targetgroup_id');
                    $targetgroup=Targetgroup::find($targetgroup_id);
                    if($targetgroup){
                        $start_date = \DateTime::createFromFormat('m.d.Y', $request->input('startdate'));
                        $end_date = \DateTime::createFromFormat('m.d.Y', $request->input('finishdate'));
                        $targetgroup->name=$request->input('name');
                        $targetgroup->max_impression=$request->input('max_impression');
                        $targetgroup->daily_max_impression=$request->input('daily_max_impression');
                        $targetgroup->max_budget=$request->input('max_budget');
                        $targetgroup->daily_max_budget=$request->input('daily_max_budget');
                        $targetgroup->cpm=$request->input('cpm');
                        $targetgroup->advertiser_domain_name=$request->input('advertiser_domain_name');
                        $targetgroup->description=$request->input('description');
                        $targetgroup->pacing_plan=$request->input('pacing_plan');
                        $targetgroup->frequency_in_sec=$request->input('frequency_in_sec');
                        $targetgroup->iab_category=$request->input('iab_category');
                        $targetgroup->iab_sub_category=$request->input('iab_sub_category');
                        $targetgroup->start_date=$start_date;
                        $targetgroup->end_date=$end_date;
                        $targetgroup->save();
                        Targetgroup_Geosegmentlist_Map::where('targetgroup_id',$targetgroup_id)->delete();
                        if(count($request->input('geosegment'))>0){
                            $chk = array();
                            foreach($request->input('geosegment') as $index) {
                                if(!in_array($index,$chk)) {
                                    $geosegment_assign = new Targetgroup_Geosegmentlist_Map();
                                    $geosegment_assign->targetgroup_id = $targetgroup->id;
                                    $geosegment_assign->geosegmentlist_id = $index;
                                    $geosegment_assign->save();
                                    array_push($chk,$index);
                                }

                            }
                        }
                        Targetgroup_Creative_Map::where('targetgroup_id',$targetgroup_id)->delete();
                        if(count($request->input('creative'))>0){
                            $chk = array();
                            foreach($request->input('creative') as $index) {
                                if(!in_array($index,$chk)) {
                                    $creative_assign = new Targetgroup_Creative_Map();
                                    $creative_assign->targetgroup_id = $targetgroup->id;
                                    $creative_assign->creative_id = $index;
                                    $creative_assign->save();
                                    array_push($chk,$index);
                                }

                            }
                        }
                        Targetgroup_Bwlist_Map::where('targetgroup_id',$targetgroup_id)->delete();
                        if(count($request->input('blacklist'))>0 and count($request->input('whitelist'))==0) {
                            $chk = array();
                            foreach ($request->input('blacklist') as $index) {
                                if (!in_array($index, $chk)) {
                                    $blacklist_assign = new Targetgroup_Bwlist_Map();
                                    $blacklist_assign->targetgroup_id = $targetgroup->id;
                                    $blacklist_assign->bwlist_id = $index;
                                    $blacklist_assign->save();
                                    array_push($chk, $index);
                                }
                            }
                        }elseif(count($request->input('blacklist'))==0 and count($request->input('whitelist'))>0){
                            $chk = array();
                            foreach ($request->input('whitelist') as $index) {
                                if (!in_array($index, $chk)) {
                                    $whitelist_assign = new Targetgroup_Bwlist_Map();
                                    $whitelist_assign->targetgroup_id = $targetgroup->id;
                                    $whitelist_assign->bwlist_id = $index;
                                    $whitelist_assign->save();
                                    array_push($chk, $index);
                                }
                            }
                        }else{
                            //return 2 ta chiz baham select shode
                        }

                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Target Group Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Iab_Category($id){
        if(is($id)){
            $sub_category=Iab_Sub_Category::where('iab_category_id',$id)->get();
            return json_encode($sub_category);
        }
    }
    public function jqgrid(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $targetgroup_id=substr($request->input('id'),2);
                    $chekUser=Targetgroup::with(['getCampaign'=>function($q){$q->with(['getAdvertiser'=>function($p){$p->with('GetClientID');}]);}])->where('id',$targetgroup_id)->get();
                    if(count($chekUser) > 0 and Auth::user()->id == $chekUser[0]->getCampaign->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $targetgroup=Targetgroup::find($targetgroup_id);
                                if($targetgroup){
                                    $targetgroup->name=$request->input('name');
                                    $targetgroup->save();
                                    return "ok";
                                }
                                return "false";
                            break;
                        }
                    }
                    return "invalid Target Group ID";
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return "don't have permission";
        }
        return Redirect::to(url('/user/login'));
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
