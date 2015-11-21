<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListView(){
        if(Auth::check()){

//            $clients=Client::select(DB::raw('*, count(client_id) as `client_count`'))
//                ->leftJoin('advertiser', 'client.id', '=', 'advertiser.client_id')
//                ->where('user_id','=',Auth::user()->id)
//                ->groupBy('client_id')
//                ->orderBy('client_count', 'desc')
//                ->get();
            $clients=Client::with(['getAdvertiser'=>function($q){$q->select(DB::raw('*,count(client_id) as client_count'))->groupBy('client_id');}])->where('user_id','=',Auth::user()->id)->get();
//            return dd($clients);
//            $clients = Client::where('user_id',Auth::user()->id)->with('get')->get();
            return view('client.list')->with('clients',$clients)->with('permission',\Permission_Check::getPermission());
        }else{
            return Redirect::to('/user/login');
        }

    }
    public function AddClientView(){
        if(Auth::check()){
            foreach(\Permission_Check::getPermission() as $per_obj){
                if($per_obj->getPermission->name == 'ADD_CLIENT'){
                    return view('client.add_client');
                }else{
                    return Redirect::back();
                }
            }
        }else{
            return Redirect::back();
        }
    }
    public function add_client(Request $request){
        $validate=\Validator::make($request->all(),['name' => 'required']);
        if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                $client=new Client();
                $client->name=$request->input('name');
                $client->company=$request->input('company');
                $client->user_id=Auth::user()->id;
                $client->save();
                return Redirect::to(url('/client/edit/'.$client->id))->withErrors(['success'=>true,'msg'=>"Client added successfully"]);
//            }
//            return \Redirect::back()->withErrors(['success'=>false,'msg'=> 'ﮐﺪ اﻣﻨﯿﺘﯽ ﺭا ﻭاﺭﺩ ﮐﻨﯿﺪ']);
        }
        //return print_r($validate->messages());
        return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
    }


    public function ClientEditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $client_obj = Client::with('getAdvertiser')->find($id);
                    return view('client.edit')->with('client_obj',$client_obj)->with('permission',\Permission_Check::getPermission());
                }
            }
        }
    }

    public function edit_client(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $client_id = $request->input('client_id');
                    $client=Client::find($client_id);
                    if($client){
                        $client->name=$request->input('name');
                        $client->company=$request->input('company');
                        $client->save();
                        return Redirect::to(url('/client/edit/'.$client->id))->withErrors(['success'=>true,'msg'=> 'Client Edited Successfully']);
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
