<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\GeoSegment;
use App\Models\GeoSegmentList;
use App\Models\User;
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
    public function LoadJson($parent_id){
//        return dd($request->all());
        if(Auth::check()){
            if (User::isSuperAdmin()) {
                $geosegment_obj = GeoSegmentList::with('getGeoEntries')->find($parent_id);
            }else{
                $usr_company = $this->user_company();
                $geosegment_obj = GeoSegmentList::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                    $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    });
                })->with('getGeoEntries')->find($parent_id);
            }
            if($geosegment_obj) {
                foreach($geosegment_obj->getGeoEntries as $index){
                    $index->setAttribute('parent_id', $parent_id);
                }
                return json_encode($geosegment_obj->getGeoEntries);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function GetView(){
        if(Auth::check()){
            if(in_array('VIEW_GEOSEGMENTLIST',$this->permission)) {
                $geosegment_obj=array();
                if (User::isSuperAdmin()) {
                    $geosegment_obj = GeoSegmentList::with(['getGeoEntries' => function ($q) {
                        $q->select(DB::raw('*,count(geosegmentlist_id) as geosegment_count'))->groupBy('geosegmentlist_id');
                    }])->with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                }else{
                    $usr_company = $this->user_company();
                    $geosegment_obj = GeoSegmentList::with(['getGeoEntries' => function ($q) {
                        $q->select(DB::raw('*,count(geosegmentlist_id) as geosegment_count'))->groupBy('geosegmentlist_id');
                    }])->whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                }
                return view('geosegment.list')->with('geosegment_obj',$geosegment_obj);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function GeosegmentAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if(in_array('ADD_EDIT_GEOSEGMENTLIST',$this->permission)) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($advid);
                    }
                    if (!$advertiser_obj) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                    return view('geosegment.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function UploadGeosegment(Request $request)
    {
        if (Auth::check()) {
            if(in_array('ADD_EDIT_GEOSEGMENTLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if ($request->hasFile('upload_geo') and $validate->passes()) {
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
                        $flg = 0;
                        $chk = GeoSegmentList::where('advertiser_id', $request->input('advertiser_id'))->get();
                        foreach ($chk as $index) {
                            if ($index->name == $request->input('name')) {
                                $flg = 1;
                            }
                        }
                        if ($flg == 0) {
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
                        }
                        File::delete($destpath . '/cdn/test/' . $fileName);
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'this name already existed !!!'])->withInput();
                    }
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select a file or fill name '])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function add_geosegmentlist(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(in_array('ADD_EDIT_GEOSEGMENTLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                    }
                    if ($advertiser_obj) {
                        $chk=GeoSegmentList::where('advertiser_id',$request->input('advertiser_id'))->get();
//                        return dd($chk);
                        $flg=0;
                        foreach($chk as $index){
                            if($index->name == $request->input('name')){
                                $flg=1;
                            }
                        }
                        if($flg==0) {
                            $active='Inactive';
                            if($request->input('active')=='on'){
                                $active='Active';
                            }
                            $key= new AuditsController();
                            $key=$key->generateRandomString();
                            $audit= new AuditsController();
                            $geosegmentlist = new GeoSegmentList();
                            $geosegmentlist->name = $request->input('name');
                            $geosegmentlist->status = $active;
                            $geosegmentlist->advertiser_id = $request->input('advertiser_id');
                            $geosegmentlist->save();
                            $audit->store('geosegment',$geosegmentlist->id,null,'add',$key);
                            for($i=0;$i<5;$i++) {
                                if(!is_null($request->input('name'.$i)) and $request->input('name'.$i) !="") {
                                    $geosegment = new GeoSegment();
                                    $geosegment->name = $request->input('name' . $i);
                                    $geosegment->lat = $request->input('lat' . $i);
                                    $geosegment->lon = $request->input('lon' . $i);
                                    $geosegment->segment_radius = $request->input('segment_radius' . $i);
                                    $geosegment->geosegmentlist_id = $geosegmentlist->id;
                                    $geosegment->save();
                                    $audit->store('geosegmententrie',$geosegment->id,null,'add',$key);
                                }
                            }
                            return Redirect::to(url('/client/cl' . $advertiser_obj->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/geosegment/gsm' . $geosegmentlist->id . '/edit'))->withErrors(['success' => true, 'msg' => "Geo Segmnet List added successfully"]);
                        }
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'this name already existed !!!'])->withInput();
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function GeosegmentEditView($clid,$advid,$gsmid){
        if(!is_null($gsmid)){
            if(Auth::check()){
                if(in_array('ADD_EDIT_GEOSEGMENTLIST',$this->permission)) {
                    if (User::isSuperAdmin()) {
                        $geosegment_obj = GeoSegmentList::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('getGeoEntries')->find($gsmid);
                    } else {
                        $usr_company = $this->user_company();
                        $geosegment_obj = GeoSegmentList::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->with('getGeoEntries')->find($gsmid);
                    }
                    if (!$geosegment_obj) {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                    return view('geosegment.edit')->with('geosegment_obj', $geosegment_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_geosegmentlist(Request $request){ // TODO: correct this function
        if(Auth::check()){
            if(in_array('ADD_EDIT_GEOSEGMENTLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//                    return dd($request->all());
                    $geosegmentlist_id = $request->input('geosegmentlist_id');
                    $geosegmentlist=GeoSegmentList::find($geosegmentlist_id);
                    if($geosegmentlist){
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $data=array();
                        $audit= new AuditsController();
                        if($geosegmentlist->name!=$request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$geosegmentlist->name);
                            array_push($data,$request->input('name'));
                            $geosegmentlist->name=$request->input('name');
                        }
                        if ($geosegmentlist->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $geosegmentlist->status);
                            array_push($data, $active);
                            $geosegmentlist->status = $active;
                        }
                        $audit->store('geosegment',$geosegmentlist_id,$data,'edit');
                        $geosegmentlist->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Geo Segment List Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));
    }

    public function jqgrid(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(in_array('ADD_EDIT_GEOSEGMENTLIST', $this->permission)){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required','lat' => 'required','lon' => 'required','segment_radius' => 'required']);
                if($validate->passes()) {
                    if (User::isSuperAdmin()) {
                        $geosegment =GeoSegmentList::find($request->input('parent_id'));
                    }else{
                        $usr_company = $this->user_company();
                        $geosegment = GeoSegmentList::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                            $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($request->input('parent_id'));
                    }
                    if($geosegment) {
                        $audit= new AuditsController();
                        switch ($request->input('oper')) {
                            case 'add':
                                $geosegment = new GeoSegment();
                                $geosegment->name = $request->input('name');
                                $geosegment->lat = $request->input('lat');
                                $geosegment->lon = $request->input('lon');
                                $geosegment->segment_radius = $request->input('segment_radius');
                                $geosegment->geosegmentlist_id = $request->input('parent_id');
                                $geosegment->save();
                                $audit->store('geosegmententrie',$geosegment->id,$request->input('geosegment_id'),'add');
                                return $msg=(['success' => true, 'msg' => "your Geo Segment has been Added"]);
                                break;
                            case 'edit':
                                $geosegmententries = GeoSegment::find($request->input('id'));
                                $data=array();
                                if($geosegmententries->name!=$request->input('name')){
                                    array_push($data,'name');
                                    array_push($data,$geosegmententries->name);
                                    array_push($data,$request->input('name'));
                                    $geosegmententries->name=$request->input('name');
                                }
                                if($geosegmententries->lat != $request->input('lat')){
                                    array_push($data,'lat');
                                    array_push($data,$geosegmententries->lat);
                                    array_push($data,$request->input('lat'));
                                    $geosegmententries->lat = $request->input('lat');
                                }
                                if($geosegmententries->lon != $request->input('lon')){
                                    array_push($data,'lon');
                                    array_push($data,$geosegmententries->lon);
                                    array_push($data,$request->input('lon'));
                                    $geosegmententries->lon = $request->input('lon');
                                }
                                if($geosegmententries->segment_radius != $request->input('segment_radius')){
                                    array_push($data,'Segment Radius');
                                    array_push($data,$geosegmententries->segment_radius);
                                    array_push($data,$request->input('segment_radius'));
                                    $geosegmententries->segment_radius = $request->input('segment_radius');
                                }
                                $geosegmententries->save();
                                $audit->store('geosegmententrie',$request->input('id'),$data,'edit');
                                return $msg=(['success' => true, 'msg' => "your Geo Segment has been Edited"]);
                                break;
                            case 'del':
                                $audit= new AuditsController();
                                $d=array($request->input('id'),$request->input('parent_id'));
                                $audit->store('geosegmententrie',$request->input('id'),$d,'del');
                                GeoSegment::where('id',$request->input('id'))->where('geosegmentlist_id',$request->input('parent_id'))->delete();
                                return $msg=(['success' => true, 'msg' => "your Geo Segment has been Deleted"]);
                                break;

                        }
                    }
                    return $msg=(['success' => false, 'msg' => "Please Select a Geo Segment First"]);

                }
                return $msg=(['success' => false, 'msg' => "Please fill all Fields"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function jqgridList(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(in_array('ADD_EDIT_GEOSEGMENTLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $geolist_id=substr($request->input('id'),3);
                    if (User::isSuperAdmin()) {
                        $geolist=GeoSegmentList::find($geolist_id);
                    }else{
                        $usr_company = $this->user_company();
                        $geolist=GeoSegmentList::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($geolist_id);
                        if (!$geolist) {
                            return $msg=(['success' => false, 'msg' => "Some things went wrong"]);
                        }
                    }
                    if ($geolist) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($geolist->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $geolist->name);
                            array_push($data, $request->input('name'));
                            $geolist->name = $request->input('name');
                        }
                        $audit->store('geosegment', $geolist_id, $data, 'edit');
                        $geolist->save();
                        return $msg=(['success' => true, 'msg' => "your Campaign Saved successfully"]);
                    }
                    return $msg=(['success' => false, 'msg' => "Please Select a Campaign First"]);
                }
                return $msg=(['success' => false, 'msg' => "Please Check your field"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_GEOSEGMENTLIST', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity=GeoSegmentList::find($id);
                } else {
                    $usr_company = $this->user_company();
                        $entity = GeoSegmentList::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                            $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($id);
                }
                if($entity){
                    $data=array();
                    $audit= new AuditsController();
                    if($entity->status=='Active'){
                        array_push($data,'status');
                        array_push($data,$entity->status);
                        array_push($data,'Inactive');
                        $entity->status='Inactive';
                        $msg='disable';
                    }elseif($entity->status=='Inactive'){
                        array_push($data,'status');
                        array_push($data,$entity->status);
                        array_push($data,'Active');
                        $entity->status='Active';
                        $msg='actived';
                    }
                    $audit->store('geosegment',$id,$data,'edit');
                    $entity->save();
                    return $msg;
                }
                return 'please Select your Client';
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }

}
