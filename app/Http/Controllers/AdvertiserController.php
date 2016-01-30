<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Advertiser_Model_Map;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\ModelTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdvertiserController extends Controller
{
    public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
                if(User::isSuperAdmin()){
                    $advertiser = Advertiser::with(['Campaign' => function ($q) {
                        $q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');
                    }])->with('GetClientID')->get();
                }else {
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $advertiser = Advertiser::with(['Campaign' => function ($q) {
                        $q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');
                    }])->with(['GetClientID' => function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    }])->get();
                }
//                return dd($advertiser);
                return view('advertiser.list')->with('adver_obj',$advertiser);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function AddAdvertiserView($clid){
        if(Auth::check()) {
            if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                $chkUser = Client::find($clid);
                if(count($chkUser) > 0 and Auth::user()->id == $chkUser->user_id) {
                    $client_obj = $chkUser;
                    $model_obj = ModelTable::get();
                    return view('advertiser.add_advertiser')
                        ->with('model_obj', $model_obj)
                        ->with('client_obj', $client_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }
    public function add_advertiser(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Client::find($request->input('client_id'));
                    if(count($chkUser)>0 and Auth::user()->id == $chkUser->user_id) {
                        $audit=new AuditsController();
                        $audit_key=$audit->generateRandomString();
                        $advertiser = new Advertiser();
                        $advertiser->name = $request->input('name');
                        $advertiser->domain_name = $request->input('domain_name');
                        $advertiser->description = $request->input('description');
                        $advertiser->client_id = $request->input('client_id');
                        $advertiser->save();
                        if($request->has('to_model')) {
                            foreach ($request->input('to_model') as $index) {
                                $adv_mdl_map=new Advertiser_Model_Map();
                                $adv_mdl_map->advertiser_id=$advertiser->id;
                                $adv_mdl_map->model_id=$index;
                                $adv_mdl_map->save();
                                $audit->store('adv_mdl_map', $index,$advertiser->id, 'add',$audit_key);
                            }
                        }
                        $audit->store('advertiser',$advertiser->id,null,'add',$audit_key);
                        return Redirect::to(url('/client/cl'.$request->input('client_id').'/advertiser/adv'.$advertiser->id.'/edit'))->withErrors(['success' => true, 'msg' => "Advertiser added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();

                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }
    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                $adver_id = $id;

                if (User::isSuperAdmin()) {
                    $adver=Advertiser::find($adver_id);
                } else {
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    if (count($usr_company) > 0 and in_array(Auth::user()->id, $usr_company)) {
                        $adver = Advertiser::with(['GetClientID' => function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        }])->find($adver_id);
                    } else {
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                    }
                }
                if($adver){
                    $data=array();
                    $audit= new AuditsController();
                    if($adver->status=='Active'){
                        array_push($data,'status');
                        array_push($data,$adver->status);
                        array_push($data,'Inactive');
                        $adver->status='Inactive';
                        $msg='disable';
                    }elseif($adver->status=='Inactive'){
                        array_push($data,'status');
                        array_push($data,$adver->status);
                        array_push($data,'Active');
                        $adver->status='Active';
                        $msg='actived';
                    }
                    $audit->store('advertiser',$adver_id,$data,'edit');
                    $adver->save();
                    return $msg;
                }
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function AdvertiserEditView($clid,$advid){
        if(!is_null($advid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                    $clid = substr($clid,2);
                    $chkUser=Client::find($clid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->user_id) {
//                    $client_obj = Client::where('user_id',Auth::user()->id)->get();
                        $adver = Advertiser::with('Campaign')->with('Model')->with('GeoSegment')->with('BWList')->with('Creative')->with('GetClientID')->find($advid);
                        $model_obj = ModelTable::get();
//                    return dd($adver);
                        $push_arr=array();
                        $adv_mdl_map=Advertiser_Model_Map::where('advertiser_id',$adver->id)->get(['id']);
                        foreach ($adv_mdl_map as $index) {
                            array_push($push_arr,$index->id);
                        }
//                    return dd($push_arr);
                        return view('advertiser.edit_advertiser')
                            ->with('adv_mdl_map', $push_arr)
                            ->with('model_obj', $model_obj)
                            ->with('adver_obj', $adver);
                    }
                    return Redirect::to('/advertiser')->withErrors(['success'=>false,'msg'=> 'please Select your Client']);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('user/login'));
        }
    }
    public function edit_advertiser(Request $request){
//        return dd($request->user());
        if(Auth::check()){
            if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $adver_id = $request->input('adver_id');
                    $adver=Advertiser::find($adver_id);
                    if($adver){
                        $data=array();
                        $audit= new AuditsController();
                        if($adver->name!=$request->input('name')){
                            array_push($data,'name');
                            array_push($data,$adver->name);
                            array_push($data,$request->input('name'));
                            $adver->name=$request->input('name');
                        }
                        if($adver->domain_name!=$request->input('domain_name')){
                            array_push($data,'company');
                            array_push($data,$adver->domain_name);
                            array_push($data,$request->input('domain_name'));
                            $adver->domain_name=$request->input('domain_name');
                        }
                        if($adver->description!=$request->input('description')){
                            array_push($data,'company');
                            array_push($data,$adver->description);
                            array_push($data,$request->input('description'));
                            $adver->description=$request->input('description');
                        }
                        $audit->store('advertiser',$adver_id,$data,'edit');
                        $adver->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Advertiser Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function jqgrid(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    switch ($request->input('oper')) {
                        case 'edit':
                            $adver_id = $request->input('id');
                            $adver_id=substr($adver_id,3);
                            $adver=Advertiser::find($adver_id);
                            if($adver){
                                $adver->name=$request->input('name');
                                $adver->save();
                                return "ok";
                            }
                            return "false";
                        break;
                    }
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return "don't have permission";
        }
        return Redirect::to(url('user/login'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
