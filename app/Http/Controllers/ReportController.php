<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    public function GetView(){
        if(Auth::check()){
            if (in_array('VIEW_ADVERTISER', $this->permission)) {
                if(User::isSuperAdmin()){
//                    $advertiser = Advertiser::with(['Campaign' => function ($q) {
//                        $q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');
//                    }])->with('GetClientID')->get();
                }else {
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
//                    $advertiser = Advertiser::with(['Campaign' => function ($q) {
//                        $q->select(DB::raw('*,count(advertiser_id) as advertiser_count'))->groupBy('advertiser_id');
//                    }])->with(['GetClientID' => function ($p) use ($usr_company) {
//                        $p->whereIn('user_id', $usr_company);
//                    }])->get();
                }
//                return dd($advertiser);
                return view('report.report');
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
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
