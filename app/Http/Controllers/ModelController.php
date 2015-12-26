<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\ModelTable;
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
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $model_obj = ModelTable::with(['getAdvertiser' => function ($q) use($usr_company) {
                        $q->with(['GetClientID' => function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        }]);
                    }])->get();
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
                $chkUser = Advertiser::with('GetClientID')->find($advid);
                if(count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                    $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                    return view('model.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function add_model(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $date_of_request = \DateTime::createFromFormat('m/d/Y', $request->input('date_of_request'));
                        $modelTable = new ModelTable();
                        $modelTable->name = $request->input('name');
                        $modelTable->algo = $request->input('algo');
                        $modelTable->seed_web_sites = json_encode($request->input('seed_web_sites'));
                        $modelTable->negative_features_requested = json_encode($request->input('negative_features_requested'));
                        $modelTable->negative_feature_used = json_encode($request->input('negative_feature_used'));
                        $modelTable->segment_name_seed = $request->input('segment_name_seed');
                        $modelTable->process_result = $request->input('process_result');
                        $modelTable->num_neg_devices_used = $request->input('num_neg_devices_used');
                        $modelTable->num_pos_devices_used = $request->input('num_pos_devices_used');
                        $modelTable->feature_recency_in_sec = $request->input('feature_recency_in_sec');
                        $modelTable->max_num_both_neg_pos_devices = $request->input('max_num_both_neg_pos_devices');
                        $modelTable->description = $request->input('description');
                        $modelTable->advertiser_id = $request->input('advertiser_id');
                        $modelTable->date_of_request = $date_of_request;
                        $modelTable->save();
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


    public function DeleteModel($id){
//        if(Auth::check()){
//            if(1==1) { //      permission goes here
//                Campaign::where('id',$id)->delete();
//                return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Campaign Deleted Successfully']);
//            }
//        }else{
//            return Redirect::to('user/login');
//        }
    }

    public function ModelEditView($clid,$advid,$mdlid){
        if(!is_null($mdlid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_MODEL', $this->permission)) {
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $model_obj = ModelTable::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->find($mdlid);
//                        return dd($campaign_obj);
                        return view('model.edit')->with('model_obj', $model_obj);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
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
                        if($request->input('date_of_request') != $modelTable->date_of_request){
                            $date_of_request = \DateTime::createFromFormat('m/d/Y', $request->input('date_of_request'));
                        }
                        $modelTable->name=$request->input('name');
                        $modelTable->algo=$request->input('algo');
                        $modelTable->seed_web_sites=json_encode($request->input('seed_web_sites'));
                        $modelTable->negative_features_requested=json_encode($request->input('negative_features_requested'));
                        $modelTable->negative_feature_used=json_encode($request->input('negative_feature_used'));
                        $modelTable->segment_name_seed=$request->input('segment_name_seed');
                        $modelTable->process_result=$request->input('process_result');
                        $modelTable->num_neg_devices_used=$request->input('num_neg_devices_used');
                        $modelTable->num_pos_devices_used=$request->input('num_pos_devices_used');
                        $modelTable->feature_recency_in_sec=$request->input('feature_recency_in_sec');
                        $modelTable->max_num_both_neg_pos_devices=$request->input('max_num_both_neg_pos_devices');
                        $modelTable->description=$request->input('description');
                        if($request->input('date_of_request') != $modelTable->date_of_request){
                            $modelTable->date_of_request = $date_of_request;
                        }
                        $modelTable->save();
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
                    $model_id=substr($request->input('id'),2);
                    $chkUser=ModelTable::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$model_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $modelTable=ModelTable::find($model_id);
                                if($modelTable){
                                    $modelTable->name=$request->input('name');
                                    $modelTable->save();
                                    return "ok";
                                }
                                return "false";
                                break;
                        }
                    }
                    return "invalid Model ID";
                }
                //return print_r($validate->messages());
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
