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
            if(1==1){ //permission goes here
                $advertiser=Advertiser::with(['Campaign'=>function($q){$q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');}])->with('GetClientID')->get();
//                $advertiser=Campaign::select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id')->with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->orderBy('advertiser_count','desc')->get();
//                return dd($advertiser);
//                $advertis = DB::table('advertiser')
//                    ->join('client','advertiser.client_id','=','client.id')
//                    ->select('advertiser.id as aid','advertiser.name as aname','advertiser.created_at as acreated_at','advertiser.*','client.name as cname','client.id as cid','client.*')
//                    ->where('client.user_id',Auth::user()->id)->get();
//                return dd($advertiser);
                return view('advertiser.list')->with('adver_obj',$advertiser)->with('permission',\Permission_Check::getPermission());
            }else{
            }
        }else{
            return Redirect::to('/user/login');
        }


    }
    public function AddAdvertiserView($clid){
        if(Auth::check()) {
            if (1 == 1) { //      permission goes here
                $client_obj = Client::where('user_id',Auth::user()->id)->where('id',$clid)->get();
                if(!is_null($client_obj)) {
//                    return dd($client_obj);
                    return view('advertiser.add_advertiser')->with('client_obj', $client_obj)->with('permission', \Permission_Check::getPermission());
                }else{
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
            }
        }
    }
    public function add_advertiser(Request $request){
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
//            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdOJAcTAAAAAFnwVTSg4GLCuDhvXXTOaGlgj1sj&response=' . $request->input('g-recaptcha-response'));
//            $captchaCheck = json_decode($response);
//            if ($captchaCheck->{'success'} == true) {
                    $chkUser=Client::find($request->input('client_id'));
                    if(count($chkUser)>0 and Auth::user()->id == $chkUser->user_id) {
                        $advertiser = new Advertiser();
                        $advertiser->name = $request->input('name');
                        $advertiser->domain_name = $request->input('domain_name');
                        $advertiser->description = $request->input('description');
                        $advertiser->client_id = $request->input('client_id');
                        $advertiser->save();
                        return Redirect::to(url('/client/cl'.$request->input('client_id').'/advertiser/adv'.$advertiser->id.'/edit'))->withErrors(['success' => true, 'msg' => "Advertiser added successfully"]);
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
    public function Delete_Advertiser($id){
        if(Auth::check()){
            if(1==1) { //      permission goes here
                Advertiser::where('id',$id)->delete();
                return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Advertiser Deleted Successfully']);
            }
        }else{
            return Redirect::to('user/login');
        }
    }

    public function AdvertiserEditView($clid,$advid){
        if(!is_null($advid)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $clid = substr($clid,2);
                    $chkUser=Client::find($clid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->user_id) {
//                    $client_obj = Client::where('user_id',Auth::user()->id)->get();
                        $adver = Advertiser::with('Campaign')->with('Creative')->with('GetClientID')->find($advid);
//                    return dd($adver);
                        return view('advertiser.edit_advertiser')->with('adver_obj', $adver)->with('permission', \Permission_Check::getPermission());
                    }else{
                        return Redirect::to('/advertiser')->withErrors(['success'=>false,'msg'=> 'please Select your Client']);
                    }
                }
            }
        }
    }
    public function edit_advertiser(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $adver_id = $request->input('adver_id');
                    $adver=Advertiser::find($adver_id);
                    if($adver){
                        $adver->name=$request->input('name');
                        $adver->domain_name=$request->input('domain_name');
                        $adver->description=$request->input('description');
                        $adver->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Advertiser Edited Successfully']);
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
