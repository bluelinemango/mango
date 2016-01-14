<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\User;
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
//                    return dd($client_obj);
                    return view('advertiser.add_advertiser')->with('client_obj', $client_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }
    public function add_advertiser(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_ADVERTISER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Client::find($request->input('client_id'));
                    if(count($chkUser)>0 and Auth::user()->id == $chkUser->user_id) {
                        $advertiser = new Advertiser();
                        $advertiser->name = $request->input('name');
                        $advertiser->domain_name = $request->input('domain_name');
                        $advertiser->description = $request->input('description');
                        $advertiser->client_id = $request->input('client_id');
                        $advertiser->save();
                        $audit= new AuditsController();
                        $audit->store('advertiser',$advertiser->id,null,'add');
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

    public function Delete_Advertiser($id){
//        if(Auth::check()){
//            if(1==1) { //      permission goes here
//                Advertiser::where('id',$id)->delete();
//                return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Advertiser Deleted Successfully']);
//            }
//        }else{
//            return Redirect::to('user/login');
//        }
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
//                    return dd($adver);
                        return view('advertiser.edit_advertiser')->with('adver_obj', $adver);
                    }
                    return Redirect::to('/advertiser')->withErrors(['success'=>false,'msg'=> 'please Select your Client']);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('user/login'));
        }
    }
    public function edit_advertiser(Request $request){
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
