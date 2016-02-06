<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Audits;
use App\Models\ModelTable;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ModelController extends Controller
{
    public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_MODEL', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $model_obj = ModelTable::with('getAdvertiser')->get();
                }else{
                    $usr_company = $this->user_company();
                    $model_obj = ModelTable::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                }
                return view('model.list')->with('model_obj',$model_obj);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function ModelAddView($clid,$advid){
        if(Auth::check()) {
            if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $offer=Offer::get();
                    $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                } else {
                    $usr_company = $this->user_company();
                    $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    })->find($advid);
                    $offer = Offer::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                        $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    if (!$advertiser_obj) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                return view('model.add')
                    ->with('offer_obj', $offer)
                    ->with('advertiser_obj', $advertiser_obj);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function add_model(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
//                        $date_of_request = \DateTime::createFromFormat('m/d/Y', $request->input('date_of_request'));

                        $audit=new AuditsController();
                        $audit_key=$audit->generateRandomString();
                        if($request->has('positive_offer_id'))
                            $positive_offer_id = implode(',', $request->input('positive_offer_id'));

                        if($request->has('negative_offer_id'))
                            $negative_offer_id=implode(',',$request->input('negative_offer_id'));
//                        return dd('['.$positive_offer_id.']');

                        $modelTable = new ModelTable();
                        $modelTable->name = $request->input('name');
                        $modelTable->advertiser_id = $request->input('advertiser_id');
                        $modelTable->seed_web_sites = json_encode($request->input('seed_web_sites'));
                        $modelTable->algo = $request->input('algo');
                        $modelTable->segment_name_seed = $request->input('segment_name_seed');
                        $modelTable->process_result = 'submitted';
                        $modelTable->description = $request->input('description');
                        $modelTable->feature_recency_in_sec = $request->input('feature_recency_in_sec');
                        $modelTable->max_num_both_neg_pos_devices = $request->input('max_num_both_neg_pos_devices');
                        $modelTable->negative_features_requested = json_encode($request->input('negative_features_requested'));
                        $modelTable->model_type = $request->input('model_type');
                        $modelTable->cut_off_score = $request->input('cut_off_score');
                        $modelTable->pixel_hit_recency_in_seconds = $request->input('pixel_hit_recency_in_seconds');
                        if($request->has('positive_offer_id'))
                            $modelTable->positive_offer_id = $positive_offer_id;

                        if($request->has('negative_offer_id'))
                            $modelTable->negative_offer_id = $negative_offer_id;
                        $modelTable->max_number_of_device_history_per_feature = $request->input('max_number_of_device_history_per_feature');
                        $modelTable->max_number_of_negative_feature_to_pick = $request->input('max_number_of_negative_feature_to_pick');
                        $modelTable->number_of_positive_device_to_be_used_for_modeling = $request->input('number_of_positive_device_to_be_used_for_modeling');
                        $modelTable->number_of_negative_device_to_be_used_for_modeling = $request->input('number_of_negative_device_to_be_used_for_modeling');
                        $modelTable->number_of_both_negative_positive_device_to_be_used = $request->input('number_of_both_negative_positive_device_to_be_used');
                        $modelTable->date_of_request_completion = date('Y-m-d H:i:s');
                        $modelTable->date_of_request = date('Y-m-d H:i:s');
                        $modelTable->save();
                        if($request->has('positive_offer_id')) {
                            foreach ($request->input('positive_offer_id') as $index) {
                                $audit->store('positive_offer_model', $index,$modelTable->id, 'add',$audit_key);
                            }
                        }
                        if($request->has('negative_offer_id')) {
                            foreach ($request->input('negative_offer_id') as $index) {
                                $audit->store('negative_offer_model', $index,$modelTable->id, 'add',$audit_key);
                            }
                        }
//                        return dd($request->all());
                        $audit->store('modelTable',$modelTable->id,null,'add',$audit_key);
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/model/mdl'.$modelTable->id.'/edit'))->withErrors(['success' => true, 'msg' => "Model added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function ModelEditView($clid,$advid,$mdlid){
        if(!is_null($mdlid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $offer=Offer::get();
                        $model_obj = ModelTable::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($mdlid);
                    } else {
                        $usr_company = $this->user_company();
                        $model_obj = ModelTable::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($mdlid);
                        $offer = Offer::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->get();
                        if (!$model_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }

                    $positive_offer_id=array();
                    $negative_offer_id=array();
                    if(!is_null($model_obj->positive_offer_id))
                        $positive_offer_id = explode(',',$model_obj->positive_offer_id);
                    if(!is_null($model_obj->negative_offer_id))
                        $negative_offer_id = explode(',',$model_obj->negative_offer_id);
                    return view('model.edit')
                        ->with('offer_obj', $offer)
                        ->with('positive_offer_id', $positive_offer_id)
                        ->with('negative_offer_id', $negative_offer_id)
                        ->with('model_obj', $model_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }
    public function edit_model(Request $request){
//        $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
        if(Auth::check()){
            if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $model_id = $request->input('model_id');
                    $modelTable=ModelTable::find($model_id);
                    if($modelTable){
                        $data=array();
                        $audit=new AuditsController();
                        $audit_key=$audit->generateRandomString();
                        $positive_offer_id='';
                        $negative_offer_id='';
                        if($request->has('positive_offer_id'))
                            $positive_offer_id = implode(',', $request->input('positive_offer_id'));
                        if($request->has('negative_offer_id'))
                            $negative_offer_id=implode(',',$request->input('negative_offer_id'));
                        if($modelTable->name != $request->input('name')){
                            array_push($data,'name');
                            array_push($data,$modelTable->name);
                            array_push($data,$request->input('name'));
                            $modelTable->name=$request->input('name');
                        }
                        if($modelTable->seed_web_sites != json_encode($request->input('seed_web_sites'))){
                            array_push($data,'seed_web_sites');
                            array_push($data,$modelTable->seed_web_sites);
                            array_push($data,json_encode($request->input('seed_web_sites')));
                            $modelTable->seed_web_sites = json_encode($request->input('seed_web_sites'));
                        }
                        if($modelTable->algo != $request->input('algo')){
                            array_push($data,'algo');
                            array_push($data,$modelTable->algo);
                            array_push($data,$request->input('algo'));
                            $modelTable->algo = $request->input('algo');
                        }
                        if($modelTable->segment_name_seed != $request->input('segment_name_seed')){
                            array_push($data,'segment_name_seed');
                            array_push($data,$modelTable->segment_name_seed);
                            array_push($data,$request->input('segment_name_seed'));
                            $modelTable->segment_name_seed = $request->input('segment_name_seed');
                        }
                        if($modelTable->description != $request->input('description')){
                            array_push($data,'description');
                            array_push($data,$modelTable->description);
                            array_push($data,$request->input('description'));
                            $modelTable->description = $request->input('description');
                        }
                        if($modelTable->feature_recency_in_sec != $request->input('feature_recency_in_sec')){
                            array_push($data,'feature_recency_in_sec');
                            array_push($data,$modelTable->feature_recency_in_sec);
                            array_push($data,$request->input('feature_recency_in_sec'));
                            $modelTable->feature_recency_in_sec = $request->input('feature_recency_in_sec');
                        }
                        if($modelTable->max_num_both_neg_pos_devices != $request->input('max_num_both_neg_pos_devices')){
                            array_push($data,'max_num_both_neg_pos_devices');
                            array_push($data,$modelTable->max_num_both_neg_pos_devices);
                            array_push($data,$request->input('max_num_both_neg_pos_devices'));
                            $modelTable->max_num_both_neg_pos_devices = $request->input('max_num_both_neg_pos_devices');
                        }
                        if($modelTable->negative_features_requested != json_encode($request->input('negative_features_requested'))){
                            array_push($data,'negative_features_requested');
                            array_push($data,$modelTable->negative_features_requested);
                            array_push($data,json_encode($request->input('negative_features_requested')));
                            $modelTable->negative_features_requested = json_encode($request->input('negative_features_requested'));
                        }
                        if($modelTable->cut_off_score != $request->input('cut_off_score')){
                            array_push($data,'cut_off_score');
                            array_push($data,$modelTable->cut_off_score);
                            array_push($data,$request->input('cut_off_score'));
                            $modelTable->cut_off_score = $request->input('cut_off_score');
                        }
                        if($modelTable->pixel_hit_recency_in_seconds != $request->input('pixel_hit_recency_in_seconds')){
                            array_push($data,'pixel_hit_recency_in_seconds');
                            array_push($data,$modelTable->pixel_hit_recency_in_seconds);
                            array_push($data,$request->input('pixel_hit_recency_in_seconds'));
                            $modelTable->pixel_hit_recency_in_seconds = $request->input('pixel_hit_recency_in_seconds');
                        }
                        if($modelTable->max_number_of_device_history_per_feature != $request->input('max_number_of_device_history_per_feature')){
                            array_push($data,'max_number_of_device_history_per_feature');
                            array_push($data,$modelTable->max_number_of_device_history_per_feature);
                            array_push($data,$request->input('max_number_of_device_history_per_feature'));
                            $modelTable->max_number_of_device_history_per_feature = $request->input('max_number_of_device_history_per_feature');
                        }
                        if($modelTable->max_number_of_negative_feature_to_pick != $request->input('max_number_of_negative_feature_to_pick')){
                            array_push($data,'max_number_of_negative_feature_to_pick');
                            array_push($data,$modelTable->max_number_of_negative_feature_to_pick);
                            array_push($data,$request->input('max_number_of_negative_feature_to_pick'));
                            $modelTable->max_number_of_negative_feature_to_pick = $request->input('max_number_of_negative_feature_to_pick');
                        }
                        if($modelTable->number_of_positive_device_to_be_used_for_modeling != $request->input('number_of_positive_device_to_be_used_for_modeling')){
                            array_push($data,'number_of_positive_device_to_be_used_for_modeling');
                            array_push($data,$modelTable->number_of_positive_device_to_be_used_for_modeling);
                            array_push($data,$request->input('number_of_positive_device_to_be_used_for_modeling'));
                            $modelTable->number_of_positive_device_to_be_used_for_modeling = $request->input('number_of_positive_device_to_be_used_for_modeling');
                        }
                        if($modelTable->number_of_negative_device_to_be_used_for_modeling != $request->input('number_of_negative_device_to_be_used_for_modeling')){
                            array_push($data,'number_of_negative_device_to_be_used_for_modeling');
                            array_push($data,$modelTable->number_of_negative_device_to_be_used_for_modeling);
                            array_push($data,$request->input('number_of_negative_device_to_be_used_for_modeling'));
                            $modelTable->number_of_negative_device_to_be_used_for_modeling = $request->input('number_of_negative_device_to_be_used_for_modeling');
                        }
                        if($modelTable->number_of_both_negative_positive_device_to_be_used != $request->input('number_of_both_negative_positive_device_to_be_used')){
                            array_push($data,'number_of_both_negative_positive_device_to_be_used');
                            array_push($data,$modelTable->number_of_both_negative_positive_device_to_be_used);
                            array_push($data,$request->input('number_of_both_negative_positive_device_to_be_used'));
                            $modelTable->number_of_both_negative_positive_device_to_be_used = $request->input('number_of_both_negative_positive_device_to_be_used');
                        }
                        $audit->store('modelTable',$model_id,$data,'edit',$audit_key);
                        $old_positive_offer_id=explode(',',$modelTable->positive_offer_id);
                        $old_negative_offer_id=explode(',',$modelTable->negative_offer_id);
                        if($request->has('positive_offer_id')) {
                            foreach ($request->input('positive_offer_id') as $index) {//ADD NEW POSITIVE OFFER FOR AUDIT
                                if (!in_array($index, $old_positive_offer_id) and $index != 0) {
                                    $audit->store('positive_offer_model', $index, $model_id, 'add', $audit_key);
                                }
                            }
                            foreach ($old_positive_offer_id as $index) {//REMOVE NEW POSITIVE OFFER FOR AUDIT
                                if (!in_array($index, $request->input('positive_offer_id')) and $index != 0) {
                                    $audit->store('positive_offer_model', $index, $model_id, 'remove', $audit_key);
                                }
                            }
                        }
                        if($request->has('negative_offer_id')) {
                            foreach ($request->input('negative_offer_id') as $index) {
                                if (!in_array($index, $old_negative_offer_id) and $index != 0) {
                                    $audit->store('negative_offer_model', $index, $model_id, 'add', $audit_key);
                                }
                            }
                            foreach ($old_negative_offer_id as $index) {//REMOVE NEW NEGATIVE OFFER FOR AUDIT
                                if (!in_array($index, $request->input('negative_offer_id')) and $index != 0) {
                                    $audit->store('negative_offer_model', $index, $model_id, 'remove', $audit_key);
                                }
                            }
                        }
                        if(!$request->has('positive_offer_id') and $modelTable->positive_offer_id!='' ){
                            foreach (explode(',',$modelTable->positive_offer_id) as $index) {
                                $audit->store('positive_offer_model', $index, $model_id, 'remove', $audit_key);
                            }
                        }
                        if(!$request->has('negative_offer_id') and $modelTable->negative_offer_id!='' ){
                            foreach (explode(',',$modelTable->negative_offer_id) as $index) {
                                $audit->store('negative_offer_model', $index, $model_id, 'remove', $audit_key);
                            }
                        }
                        $modelTable->positive_offer_id = $positive_offer_id;
                        $modelTable->negative_offer_id = $negative_offer_id;
                        $modelTable->save();
                        $audit->store('modelTable',$model_id,$data,'edit',$audit_key);
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Model Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }
    public function jqgrid(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $model_id=substr($request->input('id'),3);
                    if (User::isSuperAdmin()) {
                        $modelTable=ModelTable::find($model_id);
                    }else{
                        $usr_company = $this->user_company();
                        $modelTable=ModelTable::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($model_id);
                        if (!$modelTable) {
                            return $msg=(['success' => false, 'msg' => "Some things went wrong"]);
                        }
                    }
                    if ($modelTable) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($modelTable->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $modelTable->name);
                            array_push($data, $request->input('name'));
                            $modelTable->name = $request->input('name');
                        }
                        $audit->store('modelTable', $model_id, $data, 'edit');
                        $modelTable->save();
                        return $msg=(['success' => true, 'msg' => "your Model Saved successfully"]);
                    }

                    return $msg=(['success' => false, 'msg' => "Please Select a Model First"]);
                }
                return $msg=(['success' => false, 'msg' => "Please Check your field"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);
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
