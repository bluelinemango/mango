<?php

namespace App\Http\Controllers;

use App\Models\Advertiser_Publisher;
use App\Models\Targetgroup_Bid_Advpublisher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{


    public function saveBid(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            $arr=$request->all();
//            return dd($arr['publisher_name']);
            $result=array();
            for($i=0;$i<count($arr);$i++) {
                if(isset($arr['publisher_name'.$i])){
                    $bid = new Advertiser_Publisher();
                    $bid->name = $arr['publisher_name'.$i];
                    $bid->advertiser_id = $arr['advertiser_id'];
                    $bid->save();
                    array_push($result,$bid->id);
                    array_push($result,$arr['publisher_name'.$i]);
                    array_push($result,$arr['bid'.$i]);
                }
//                $tg_bid=new Targetgroup_Bid_Advpublisher();
//                $tg_bid->bid_price=$arr[$i+1];
//                $tg_bid->advertiser_publisher_id=$bid->id;
//                $tg_bid->targetgroup_id=$bid->id;

            }
            return json_encode($result);

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
