<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Audits;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Permission_Check;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testLoadJson(Request $request){
//        return dd($request->all());
        if(User::isSuperAdmin()){
            $clients = Client::with(['getAdvertiser' => function ($q) {
                $q->select(DB::raw('*,count(client_id) as client_count'))->groupBy('client_id');
            }])->get();
        }else {
            $usr_comp = $this->user_company();
            $clients = Client::with(['getAdvertiser' => function ($q) {
                $q->select(DB::raw('*,count(client_id) as client_count'))->groupBy('client_id');
            }])->whereIn('user_id', $usr_comp)->get();
        }
        $result='';
        foreach($clients as $index){
            if (count($index->getAdvertiser) > 0) {
                $index->setAttribute('advertiser', $index->getAdvertiser[0]->client_count);
            }else {
                $index->setAttribute('advertiser', '0');
            }
            $action="<a class='btn' href='".url('/client/cl'.$index->id.'/edit')."'>
                        <img src='".cdn('img/edit_16x16.png')."' /> </a> |";
            if(in_array('ADD_EDIT_ADVERTISER',$this->permission)){
              $action .= "<a class='btn txt-color-white' href='".url('client/cl'.$index->id.'/advertiser/add')."'><img src='".cdn('img/plus_16x16.png')."'' /></a>";
            }
            $index->setAttribute('action', $action);
            if ($index->status == 'Active') {
                $index->status = "<div class=\"switcher\"><input id=\"bid_profile{{$index->id}}\" onchange=\"ChangeStatus(`bid_profile`,`{{$index->id}}`)\" type=\"checkbox\" checked hidden><label for=\"bid_profile{{$index->id}}\"></label></div>";
            } elseif ($index->status == 'Inactive') {
                $index->status = "<div class=\"switcher\"><input id=\"bid_profile{{$index->id}}\" onchange=\"ChangeStatus(`bid_profile`,`{{$index->id}}`)\" type=\"checkbox\" hidden><label for=\"bid_profile{{$index->id}}\"></label></div>";
            }
        }
        return json_encode($clients);

    }

    public function ListView(){
        if(Auth::check()){
            if(in_array('VIEW_CLIENT',$this->permission)) {
                return view('client.list');
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function AddClientView(){
        if(Auth::check()){
            if(in_array('ADD_EDIT_CLIENT',$this->permission)) {
                return view('client.add_client');
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
        return Redirect::to(url('user/login'));
    }

    public function add_client(Request $request){
        if(Auth::check()){
            if(in_array('ADD_EDIT_CLIENT',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $active='Inactive';
                    if($request->input('active')=='on'){
                        $active='Active';
                    }
                    $client=new Client();
                    $client->name=$request->input('name');
                    $client->status=$active;
                    $client->company=$request->input('company');
                    $client->user_id=Auth::user()->id;
                    $client->save();
                    $audit= new AuditsController();
                    $audit->store('client',$client->id,null,'add');
                    return Redirect::to(url('/client/cl'.$client->id.'/edit'))->withErrors(['success'=>true,'msg'=>"Client added successfully"]);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));

    }

    public function ClientEditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(in_array('ADD_EDIT_CLIENT',$this->permission)) {
                    if (User::isSuperAdmin()) {
                        $client_obj = Client::with('getAdvertiser')->find($id);
                    } else {
                        $usr_company=$this->user_company();
                        $client_obj = Client::with('getAdvertiser')->whereIn('user_id', $usr_company)->find($id);
                    }
                    if(!$client_obj) {
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                    return view('client.edit')->with('client_obj',$client_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('user/login'));
        }
        return Redirect::back()->withErrors(['success'=>false,'msg'=>"Select valid ID"]);
    }

    public function edit_client(Request $request){
        if(Auth::check()){
            if(in_array('ADD_EDIT_CLIENT',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $client_id = $request->input('client_id');
                    if (User::isSuperAdmin()) {
                        $client=Client::find($client_id);
                    } else {
                        $usr_company=$this->user_company();
                        $client = Client::whereIn('user_id', $usr_company)->find($client_id);
                    }
                    if($client){
                        $data=array();
                        $audit= new AuditsController();
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        if($client->name!=$request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$client->name);
                            array_push($data,$request->input('name'));
                            $client->name=$request->input('name');
                        }
                        if ($client->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $client->status);
                            array_push($data, $active);
                            $client->status = $active;
                        }
                        if($client->company!=$request->input('company')){
                            array_push($data,'Company');
                            array_push($data,$client->company);
                            array_push($data,$request->input('company'));
                            $client->company=$request->input('company');
                        }
                        $audit->store('client',$client_id,$data,'edit');
                        $client->save();
                        return Redirect::to(url('/client/cl'.$client->id.'/edit'))->withErrors(['success'=>true,'msg'=> 'Client Edited Successfully']);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function jqgrid(Request $request){
//        return dd($request->all());
        if(Auth::check()) {
            if (in_array('ADD_EDIT_CLIENT', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    switch ($request->input('oper')) {
                        case 'add':
                            $audit = new AuditsController();
                            $active='Inactive';
                            if($request->input('active')=='true'){
                                $active='Active';
                            }
                            $client = new Client();
                            $client->name = $request->input('name');
                            $client->status = $active;
                            $client->user_id = Auth::user()->id;
                            $client->save();
                            $audit->store('client', $client->id, null, 'add');
                            return $msg=(['success' => true, 'msg' => "your Client:cl$client->id Added successfully"]);
                            break;
                        case 'edit':
                            $client_id = $request->input('id');
                            if (User::isSuperAdmin()) {
                                $client=Client::find($client_id);
                            } else {
                                $usr_company=$this->user_company();
                                $client = Client::whereIn('user_id', $usr_company)->find($client_id);
                            }
                            if($client){
                                $data=array();
                                $audit= new AuditsController();
                                if($client->name!=$request->input('name')){
                                    array_push($data,'Name');
                                    array_push($data,$client->name);
                                    array_push($data,$request->input('name'));
                                    $client->name=$request->input('name');
                                }
                                $audit->store('client',$client_id,$data,'edit');
                                $client->save();
                                return $msg=(['success' => true, 'msg' => "your Client:cl$client_id Saved saved successfully"]);
                            }
                            return $msg=(['success' => false, 'msg' => "please Select your Client"]);
                        break;
                    }
                    return $msg=(['success' => false, 'msg' => "Are U kidding me?"]);
                }
                return $msg=(['success' => false, 'msg' => "please fill all fields"]);
            }
            return $msg=(['success' => false, 'msg' => "you don\'t have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function ChangeStatus($id)
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_CLIENT', $this->permission)) {
                $client_id = $id;

                if (User::isSuperAdmin()) {
                    $client = Client::find($client_id);
                } else {
                    $usr_company = $this->user_company();
                    $client = Client::whereIn('user_id', $usr_company)->find($id);
                }
                if ($client) {
                    $data = array();
                    $audit = new AuditsController();
                    if ($client->status == 'Active') {
                        array_push($data, 'status');
                        array_push($data, $client->status);
                        array_push($data, 'Inactive');
                        $client->status = 'Inactive';
                        $msg = 'disable';
                    } elseif ($client->status == 'Inactive') {
                        array_push($data, 'status');
                        array_push($data, $client->status);
                        array_push($data, 'Active');
                        $client->status = 'Active';
                        $msg = 'actived';
                    }
                    $audit->store('client', $client_id, $data, 'edit');
                    $client->save();
                    return $msg;
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();

            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

}
