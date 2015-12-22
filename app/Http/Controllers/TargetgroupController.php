<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Iab_Category;
use App\Models\Iab_Sub_Category;
use App\Models\Targetgroup;
use App\Models\Targetgroup_Bwlist_Map;
use App\Models\Targetgroup_Creative_Map;
use App\Models\Targetgroup_Geosegmentlist_Map;
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
                $targetgroup=Targetgroup::with(['getCampaign'=>function($q){$q->with(['getAdvertiser'=>function($p){$p->with('GetClientID');}]);}])->get();
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
                    $iab_category_obj=Iab_Category::get();
                    return view('targetgroup.add')->with('campaign_obj',$campaign_obj)->with('iab_category_obj',$iab_category_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));

    }

    public function add_targetgroup(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_TARGETGROUP', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $checkAdv=Campaign::find($request->input('campaign_id'));
                    $chekUser=Advertiser::with('GetClientID')->find($checkAdv->advertiser_id);
                    if(count($chekUser) > 0 and Auth::user()->id == $chekUser->GetClientID->user_id) {
                        $start_date = \DateTime::createFromFormat('m/d/Y', $request->input('start_date'));
                        $end_date = \DateTime::createFromFormat('m/d/Y', $request->input('end_date'));
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
