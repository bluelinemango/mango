<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\GeoSegment;
use App\Models\GeoSegmentList;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class GeoSegmentController extends Controller
{
    public function GetView(){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $geosegment_obj=GeoSegmentList::with(['getGeoEntries'=>function($q){$q->select(DB::raw('*,count(geosegmentlist_id) as geosegment_count'))->groupBy('geosegmentlist_id');}])->with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->get();
//                return dd($geosegment_obj);
                return view('geosegment.list')->with('geosegment_obj',$geosegment_obj)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to(url('/user/login'));
        }
    }

    public function GeosegmentAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if (1 == 1) { //      permission goes here
                    $chkUser = Advertiser::with('GetClientID')->find($advid);
                    if (count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                        return view('geosegment.add')->with('advertiser_obj', $advertiser_obj)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
            }
        }
    }

    public function UploadGeosegment(Request $request)
    {
        if (Auth::check()) {
            if (1 == 1) {    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if ($request->hasFile('upload_geo') and $validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $chkUser = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if (!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $destpath = public_path();
                        $extension = $request->file('upload_geo')->getClientOriginalExtension(); // getting image extension
                        $fileName = str_random(32) . '.' . $extension;
                        $request->file('upload_geo')->move($destpath . '/cdn/test/', $fileName);
                        $upload = Excel::load('public/cdn/test/' . $fileName, function ($reader) {
                        })->get();
                        $t = array();
                        foreach ($upload[0] as $key => $value) {
                            array_push($t, $key);
                        }
                        if ($t[0] != 'name' or $t[1] != 'lat' or $t[2] != 'lon' or $t[3] != 'radius') {
                            File::delete($destpath . '/cdn/test/' . $fileName);
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please be sure that file is correct'])->withInput();
                        }
//                        return dd($upload[0]['radius']);
                        $flg = 0;
                        $chk = GeoSegmentList::where('advertiser_id', $request->input('advertiser_id'))->get();
                        foreach ($chk as $index) {
                            if ($index->name == $request->input('name')) {
                                $flg = 1;
                            }
                        }
                        if ($flg == 0) {
//                                return dd($first_array);
                            $geosegment = new GeoSegmentList();
                            $geosegment->name = $request->input('name');
                            $geosegment->advertiser_id = $request->input('advertiser_id');
                            $geosegment->save();
                            foreach ($upload as $test) {
                                $geosegmententries = new GeoSegment();
                                $geosegmententries->name = $test['name'];
                                $geosegmententries->lat = $test['lat'];
                                $geosegmententries->lon = $test['lon'];
                                $geosegmententries->segment_radius = $test['radius'];
                                $geosegmententries->geosegmentlist_id = $geosegment->id;
                                $geosegmententries->save();
                            }
                            $msg = "Geo Segment List added successfully";
                            return Redirect::back()->withErrors(['success' => true, 'msg' => $msg]);
                        } else {
                            File::delete($destpath . '/cdn/test/' . $fileName);
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'this name already existed !!!'])->withInput();
                        }
                    } else {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                } else {
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select a file or fill name '])->withInput();
                }
//            }
//            return \Redirect::back()->withErrors(['success'=>false,'msg'=> 'ﮐﺪ اﻣﻨﯿﺘﯽ ﺭا ﻭاﺭﺩ ﮐﻨﯿﺪ']);
                //return print_r($validate->messages());
//                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            } else {
                return Redirect::to(url('/user/login'));
            }
        }
    }



    public function add_geosegmentlist(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $chk=GeoSegmentList::where('advertiser_id',$request->input('advertiser_id'))->get();
//                        return dd($chk);
                        $flg=0;
                        foreach($chk as $index){
                            if($index->name == $request->input('name')){
                                $flg=1;
                            }
                        }
                        if($flg==0) {
                            $geosegmentlist = new GeoSegmentList();
                            $geosegmentlist->name = $request->input('name');
                            $geosegmentlist->advertiser_id = $request->input('advertiser_id');
                            $geosegmentlist->save();

                            for($i=0;$i<5;$i++) {
                                if(!is_null($request->input('name'.$i)) and $request->input('name'.$i) !="") {
                                    $geosegment = new GeoSegment();
                                    $geosegment->name = $request->input('name' . $i);
                                    $geosegment->lat = $request->input('lat' . $i);
                                    $geosegment->lon = $request->input('lon' . $i);
                                    $geosegment->segment_radius = $request->input('segment_radius' . $i);
                                    $geosegment->geosegmentlist_id = $geosegmentlist->id;
                                    $geosegment->save();
                                }
                            }

                            return Redirect::to(url('/client/cl' . $chkUser->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/geosegment/gsm' . $geosegmentlist->id . '/edit'))->withErrors(['success' => true, 'msg' => "Geo Segmnet List added successfully"]);
                        }else{
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'this name already existed !!!'])->withInput();
                        }
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
//            }
//            return \Redirect::back()->withErrors(['success'=>false,'msg'=> 'ﮐﺪ اﻣﻨﯿﺘﯽ ﺭا ﻭاﺭﺩ ﮐﻨﯿﺪ']);
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to(url('/user/login'));
        }
    }

    public function GeosegmentEditView($clid,$advid,$gsmid){
        if(!is_null($gsmid)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $geosegment_obj = GeoSegmentList::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('getGeoEntries')->find($gsmid);
//                    return dd($bwlist_obj);
                        return view('geosegment.edit')->with('geosegment_obj', $geosegment_obj)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
            }
        }
    }

    public function edit_geosegmentlist(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//                    return dd($request->all());
                    $geosegmentlist_id = $request->input('geosegmentlist_id');
                    $geosegmentlist=GeoSegmentList::find($geosegmentlist_id);
                    if($geosegmentlist){
                        $geosegmentlist->name=$request->input('name');
                        $geosegmentlist->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Geo Segment List Edited Successfully']);
                    }
                }else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
                }
            }else{
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
            }

        }else{
            return Redirect::to(url('/user/login'));
        }
    }

    public function jqgrid(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required','lat' => 'required','lon' => 'required','segment_radius' => 'required',]);
                if($validate->passes()) {
                    $chkUser=GeoSegmentList::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->find($request->input('geosegment_id'));
//                    return dd($chkUser);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'add':
                                $geosegment = new GeoSegment();
                                $geosegment->name = $request->input('name');
                                $geosegment->lat = $request->input('lat');
                                $geosegment->lon = $request->input('lon');
                                $geosegment->segment_radius = $request->input('segment_radius');
                                $geosegment->geosegmentlist_id = $request->input('geosegment_id');
                                $geosegment->save();
                                $geosegment=GeoSegment::where('id',$geosegment->id)->get();
//                                    return dd($result);
                                return json_encode($geosegment);
                                break;
                            case 'edit':
                                $geosegmententries = GeoSegment::find($request->input('id'));
                                $geosegmententries->name = $request->input('name');
                                $geosegmententries->lat = $request->input('lat');
                                $geosegmententries->lon = $request->input('lon');
                                $geosegmententries->segment_radius = $request->input('segment_radius');
                                $geosegmententries->save();
                                return 'ok';
                                break;
                            case 'del':
                                GeoSegment::delete($request->input('id'));
                                return 'ok';
                                break;
                        }
                    }

                }
                switch ($request->input('oper')) {
                    case 'del':
                        $a=explode(',',$request->input('id'));
                        foreach($a as $index){
                            GeoSegment::where('id',$index)->delete();
                        }
                        return 'ok';
                        break;
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to('/user/login');
        }
    }

    public function jqgridList(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $geolist_id=substr($request->input('id'),3);
//                    return dd($model_id);
                    $chkUser=GeoSegmentList::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$geolist_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $geolist=GeoSegmentList::find($geolist_id);
                                if($geolist){
                                    $geolist->name=$request->input('name');
                                    $geolist->save();
                                    return "ok";
                                }
                                return "false";
                                break;
                        }
                    }
                    return "invalid Black/White List  ID";

                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to('/user/login');
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
