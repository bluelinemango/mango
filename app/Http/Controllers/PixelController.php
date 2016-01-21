<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Pixel;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PixelController extends Controller
{

    public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_PIXEL', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $pixel_obj = Pixel::with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                }else{
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $pixel_obj = Pixel::with(['getAdvertiser' => function ($q) use($usr_company) {
                        $q->with(['GetClientID' => function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        }]);
                    }])->get();
                }
                return view('pixel.list')->with('pixel_obj',$pixel_obj);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }
    public function PixelAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                    $chkUser = Advertiser::with('GetClientID')->find($advid);
                    if (count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                        return view('pixel.add')->with('advertiser_obj', $advertiser_obj);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function add_pixel(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_CREATIVE', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $pixel = new Pixel();
                        $pixel->name = $request->input('name');
                        $pixel->advertiser_id = $request->input('advertiser_id');
                        $pixel->save();
                        $audit= new AuditsController();
                        $audit->store('pixel',$pixel->id,null,'add');
                        return Redirect::to(url('/client/cl'.$chkUser->GetClientID->id.'/advertiser/adv'.$request->input('advertiser_id').'/pixel/pxl'.$pixel->id.'/edit'))->withErrors(['success' => true, 'msg' => "Pixel added successfully"]);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }


    public function PixelEditView($clid,$advid,$crtid){
        if(!is_null($crtid)){
            if(Auth::check()){
                if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $pixel_obj = Pixel::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->find($crtid);
                        return view('pixel.edit')->with('pixel_obj', $pixel_obj);
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_pixel(Request $request){
        if(Auth::check()){
            if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $pixel_id = $request->input('pixel_id');
                    $pixel=Pixel::find($pixel_id);
                    if($pixel){
                        $data=array();
                        $audit= new AuditsController();
                        if($pixel->name != $request->input('name')){
                            array_push($data,'name');
                            array_push($data,$pixel->name);
                            array_push($data,$request->input('name'));
                            $pixel->name=$request->input('name');
                        }
                        $audit->store('creative',$pixel_id,$data,'edit');
                        $pixel->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'Pixel Edited Successfully']);
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
            if (in_array('ADD_EDIT_PIXEL', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $pixel_id=substr($request->input('id'),3);
                    $chkUser=Pixel::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$pixel_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $pixel=Pixel::find($pixel_id);
                                if($pixel){
                                    $data=array();
                                    $audit= new AuditsController();
                                    if($pixel->name != $request->input('name')){
                                        array_push($data,'name');
                                        array_push($data,$pixel->name);
                                        array_push($data,$request->input('name'));
                                        $pixel->name=$request->input('name');
                                    }
                                    $audit->store('creative',$pixel_id,$data,'edit');
                                    $pixel->save();
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
