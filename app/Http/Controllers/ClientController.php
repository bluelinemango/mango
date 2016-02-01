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

    public function ListView(){
        if(Auth::check()){
            if(in_array('VIEW_CLIENT',$this->permission)) {
                if(User::isSuperAdmin()){
                    $clients = Client::with(['getAdvertiser' => function ($q) {
                        $q->select(DB::raw('*,count(client_id) as client_count'))->groupBy('client_id');
                    }])->get();
                }else {
                    $usr_comp = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $clients = Client::with(['getAdvertiser' => function ($q) {
                        $q->select(DB::raw('*,count(client_id) as client_count'))->groupBy('client_id');
                    }])->whereIn('user_id', $usr_comp)->get();
                }
                return view('client.list')->with('clients', $clients)->with('permission', $this->permission);
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
                    $client=new Client();
                    $client->name=$request->input('name');
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
                    $client_obj = Client::with('getAdvertiser')->find($id);
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
                    $client=Client::find($client_id);
                    if($client){
                        $data=array();
                        $audit= new AuditsController();
                        if($client->name!=$request->input('name')){
                            array_push($data,'name');
                            array_push($data,$client->name);
                            array_push($data,$request->input('name'));
                            $client->name=$request->input('name');
                        }
                        if($client->company!=$request->input('company')){
                            array_push($data,'company');
                            array_push($data,$client->company);
                            array_push($data,$request->input('company'));
                            $client->company=$request->input('company');
                        }
                        $audit->store('client',$client_id,$data,'edit');
                        $client->save();
                        return Redirect::to(url('/client/cl'.$client->id.'/edit'))->withErrors(['success'=>true,'msg'=> 'Client Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function jqgrid(Request $request){
        return dd($request->all());
        if(Auth::check()) {
            if (in_array('ADD_EDIT_CLIENT', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    switch ($request->input('oper')) {
                        case 'add':
                            $client = new Client();
                            $client->name = $request->input('name');
                            $client->user_id = Auth::user()->id;
                            $client->save();
                            $client_obj = Client::where('id', $client->id)->get();
                            return json_encode($client_obj);
                        break;
                        case 'edit':
                            $client_id = $request->input('id');
                            $client = Client::find($client_id);
                            if ($client) {
                                $client->name = $request->input('name');
                                $client->save();
                                return 'ok';
                            }
                        break;
                    }
                }
//                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return "don't have permission";
        }
        return Redirect::to(url('user/login'));
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
