<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\GeoSegment;
use App\Models\GeoSegmentList;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class GeoSegmentController extends Controller
{
    public function GetView(){
        if(Auth::check()){
            if(1==1){ //permission goes here
//                $bwlist=BWList::with(['getEntries'=>function($q){$q->select(DB::raw('*,count(bwlist_id) as bwlist_count'))->groupBy('bwlist_id');}])->with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->get();
//                return dd($bwlist);
//                return view('geosegment.list')->with('bwlist_obj',$bwlist)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to('/user/login');
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
                return Redirect::to('/user/login');
            }
        }
    }



    public function add_bwlist(Request $request){
//        return $request->input('domain_name');
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $chk=BWList::where('advertiser_id',$request->input('advertiser_id'))->get();
//                        return dd($chk);
                        $flg=0;
                        foreach($chk as $index){
                            if($index->name == $request->input('name') and $index->list_type == $request->input('list_type')){
                                $flg=1;
                            }
                        }
                        if($flg==0) {
                            $bwlist = new BWList();
                            $bwlist->name = $request->input('name');
                            $bwlist->list_type = $request->input('list_type');
                            $bwlist->advertiser_id = $request->input('advertiser_id');
                            $bwlist->save();
                            $entries = explode(',', $request->input('domain_name'));
                            foreach ($entries as $index) {
                                $bwlistentries = new BWEntries();
                                $bwlistentries->domain_name = $index;
                                $bwlistentries->bwlist_id = $bwlist->id;
                                $bwlistentries->save();
                            }

                            return Redirect::to(url('/client/cl' . $chkUser->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/bwlist/bwl' . $bwlist->id . '/edit'))->withErrors(['success' => true, 'msg' => "B/W List added successfully"]);
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
            return Redirect::to('/user/login');
        }
    }

    public function BwlistEditView($clid,$advid,$bwlid){
        if(!is_null($bwlid)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $bwlist_obj = BWList::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('getEntries')->find($bwlid);
//                    return dd($bwlist_obj);
                        return view('bwlist.edit')->with('bwlist_obj', $bwlist_obj)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
            }
        }
    }

    public function edit_bwlist(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $bwlist_id = $request->input('bwlist_id');
                    $bwlist=BWList::find($bwlist_id);
                    if($bwlist){
                        $bwlist->name=$request->input('name');
                        $bwlist->list_type=$request->input('list_type');
                        $bwlist->save();
                        BWEntries::where('bwlist_id',$bwlist_id)->delete();
                        $entries = explode(',', $request->input('domain_name'));
                        foreach($entries as $index){
                            $bwlistentries = new BWEntries();
                            $bwlistentries->domain_name = $index;
                            $bwlistentries->bwlist_id = $bwlist_id;
                            $bwlistentries->save();

                        }
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'B/W List Edited Successfully']);
                    }
                }else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
                }
            }else{
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
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
