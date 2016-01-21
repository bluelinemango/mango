<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OfferController extends Controller
{

    public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_OFFER', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $offer_obj = Offer::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                }else{
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $offer_obj = Offer::with(['getAdvertiser' => function ($q) use($usr_company) {
                        $q->with(['GetClientID' => function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        }]);
                    }])->get();
                }
                return view('offer.list')->with('offer_obj',$offer_obj);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }
    public function OfferAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_OFFER', $this->permission)) {
                    $chkUser = Advertiser::with('GetClientID')->find($advid);
                    if (count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                        return view('offer.add')->with('advertiser_obj', $advertiser_obj);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function add_offer(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $offer = new Offer();
                        $offer->name = $request->input('name');
                        $offer->advertiser_id = $request->input('advertiser_id');
                        $offer->save();
                        $audit= new AuditsController();
                        $audit->store('offer',$offer->id,null,'add');
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/offer/ofr'.$offer->id.'/edit'))->withErrors(['success' => true, 'msg' => "Offer added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }


    public function OfferEditView($clid,$advid,$ofrid){
        if(!is_null($crtid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_OFFER', $this->permission)) {
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $offer_obj = Offer::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($crtid);
                        return view('offer.edit')->with('offer_obj', $offer_obj);
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_offer(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_OFFER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $offer_id = $request->input('offer_id');
                    $offer=Offer::find($offer_id);
                    if($offer){
                        $data=array();
                        $audit= new AuditsController();
                        if($offer->name != $request->input('name')){
                            array_push($data,'name');
                            array_push($data,$offer->name);
                            array_push($data,$request->input('name'));
                            $offer->name=$request->input('name');
                        }
                        $audit->store('creative',$offer_id,$data,'edit');
                        $offer->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Offer Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>'dont have Edit Permission']);
        }
        return Redirect::to(url('/user/login'));
    }
    public function jqgrid(Request $request){
        //return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_OFFER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $offer_id=substr($request->input('id'),3);
                    $chkUser=Offer::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$offer_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $offer=Offer::find($offer_id);
                                if($offer){
                                    $data=array();
                                    $audit= new AuditsController();
                                    if($offer->name != $request->input('name')){
                                        array_push($data,'name');
                                        array_push($data,$offer->name);
                                        array_push($data,$request->input('name'));
                                        $offer->name=$request->input('name');
                                    }
                                    $audit->store('creative',$offer_id,$data,'edit');
                                    $offer->save();
                                    return "ok";
                                }
                                return "false";
                                break;
                        }
                    }
                    return "invalid Creative ID";
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return "don't have permission";
        }
        return Redirect::to(url('/user/login'));
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
