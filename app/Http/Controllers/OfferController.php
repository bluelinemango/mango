<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Offer;
use App\Models\Offer_Pixel_Map;
use App\Models\Pixel;
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
                    $usr_company = $this->user_company();
                    $offer_obj = Offer::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
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
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($advid);
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('offer.add')->with('advertiser_obj', $advertiser_obj);
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
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $offer = new Offer();
                        $offer->name = $request->input('name');
                        $offer->advertiser_id = $request->input('advertiser_id');
                        $offer->status = $active;
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
        if(!is_null($ofrid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_OFFER', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $offer_obj = Offer::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($ofrid);
                        $get_pixel=Pixel::get();
                    } else {
                        $usr_company = $this->user_company();
                        $offer_obj = Offer::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($ofrid);
                        $get_pixel=Pixel::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->get();

                        if (!$offer_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }

                    $offer_pixel=Offer_Pixel_Map::where('offer_id',$ofrid)->get();
                    $offer_pixel1 = array();
                    if(count($offer_pixel)>0) {
                        foreach($offer_pixel as $index) {
                            array_push($offer_pixel1,$index->pixel_id);
                        }
                    }
//                        return dd($offer_pixel1);
                    return view('offer.edit')
                        ->with('pixel_obj', $get_pixel)
                        ->with('offer_pixel', $offer_pixel1)
                        ->with('offer_obj', $offer_obj);

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
                        $key_audit= new AuditsController();
                        $key_audit=$key_audit->generateRandomString();
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        $data=array();
                        $audit=new AuditsController();
                        $audit_key=$audit->generateRandomString();

                        if($offer->name != $request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$offer->name);
                            array_push($data,$request->input('name'));
                            $offer->name=$request->input('name');
                        }
                        if ($offer->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $offer->status);
                            array_push($data, $active);
                            $offer->name = $active;
                        }

                        $offer_pixel_map=Offer_Pixel_Map::where('offer_id', $offer_id)->get();
                        $ofrPxlArr=array();
                        foreach($offer_pixel_map as $index){
                            array_push($ofrPxlArr,$index->pixel_id);
                        }

                        if ($request->has('to_pixel')) {
                            foreach ($request->input('to_pixel') as $index) {
                                if (!in_array($index, $ofrPxlArr)) {
                                    $pixel_assign = new Offer_Pixel_Map();
                                    $pixel_assign->offer_id = $offer_id;
                                    $pixel_assign->pixel_id = $index;
                                    $pixel_assign->save();
                                    $audit->store('offer_pixel_map', $index, $offer_id, 'add', $audit_key);
                                }
                            }
                            foreach ($offer_pixel_map as $index) {
                                if (!in_array($index->pixel_id, $request->input('to_pixel'))) {
                                    Offer_Pixel_Map::where('offer_id',$offer_id)->where('pixel_id',$index->pixel_id)->delete();
                                    $audit->store('offer_pixel_map', $index->pixel_id, $offer_id, 'remove', $audit_key);
                                }
                            }
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
//        return dd($request->all());
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
                                    $audit->store('offer',$offer_id,$data,'edit',$key_audit);
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

    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_OFFER', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity=Offer::find($id);
                } else {
                    $usr_company = $this->user_company();
                    $entity = Offer::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->find($id);
                    if(!$entity){
                        return 'please Select your Client';
                    }
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
                    $audit->store('offer',$id,$data,'edit');
                    $entity->save();
                    return $msg;
                }
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }
}
