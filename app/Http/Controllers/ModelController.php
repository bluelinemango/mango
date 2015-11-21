<?php

namespace App\Http\Controllers;

use App\Models\ModelTable;
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
            if(1==1){ //permission goes here
//                return dd($campaign);
                $model_obj = ModelTable::with('getAdvertiser')->get();
                return view('model.list')->with('model_obj',$model_obj)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to('/user/login');
        }


    }

    public function ModelAddView(){
        if(Auth::check()) {
            if (1 == 1) { //      permission goes here
                $advertiser_obj = DB::table('advertiser')
                    ->join('client','advertiser.client_id','=','client.id')
                    ->select('advertiser.id as aid','advertiser.name as aname','advertiser.created_at as acreated_at','advertiser.*','client.name as cname','client.*')
                    ->where('user_id',Auth::user()->id)->get();
                return view('model.add')->with('advertiser_obj',$advertiser_obj)->with('permission',\Permission_Check::getPermission());
            }
        }
    }

    public function add_model(Request $request){
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $date_of_request = \DateTime::createFromFormat('m/d/Y', $request->input('date_of_request'));
                    $modelTable=new ModelTable();
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
                    $modelTable->advertiser_id=$request->input('advertiser_id');
                    $modelTable->date_of_request=$date_of_request;
                    $modelTable->save();
                    return Redirect::to(url('/model/edit/'.$modelTable->id))->withErrors(['success'=>true,'msg'=>"Model added successfully"]);
//            }
//            return \Redirect::back()->withErrors(['success'=>false,'msg'=> 'ﮐﺪ اﻣﻨﯿﺘﯽ ﺭا ﻭاﺭﺩ ﮐﻨﯿﺪ']);
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to('/user/login');
        }
    }


    public function DeleteModel($id){
        if(Auth::check()){
            if(1==1) { //      permission goes here
                Campaign::where('id',$id)->delete();
                return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Campaign Deleted Successfully']);
            }
        }else{
            return Redirect::to('user/login');
        }
    }

    public function ModelEditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
//                    $advertiser_obj = DB::table('advertiser')
//                        ->join('client','advertiser.client_id','=','client.id')
//                        ->select('advertiser.id as aid','advertiser.name as aname','advertiser.created_at as acreated_at','advertiser.*','client.name as cname','client.*')
//                        ->where('user_id',Auth::user()->id)->get();
                    $model_obj = ModelTable::with('getAdvertiser')->find($id);
                    return view('model.edit')->with('model_obj',$model_obj)->with('permission',\Permission_Check::getPermission());
                }
            }
        }
    }
    public function edit_model(Request $request){
//        $start_date = \DateTime::createFromFormat('d.m.Y', $request->input('start_date'));
        if(Auth::check()){
            if(1==1){ //permission goes here
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
                }else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
                }
            }else{
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'do not have Edit Permission']);
            }

        }else{
            return Redirect::to('user/login');
        }
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
