<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InventoryController extends Controller
{
    public function ListView(){
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                $inventory = Inventory::get();
                return view('inventory.list')->with('inventory', $inventory);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function AddInventoryView()
    {
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                return view('inventory.add');
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function add_inventory(Request $request){
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $active='Inactive';
                    if($request->input('active')=='on'){
                        $active='Active';
                    }

                    $inventory=new Inventory();
                    $inventory->name=$request->input('name');
                    $inventory->type=$request->input('type');
                    $inventory->category=$request->input('category');
                    $inventory->status=$active;
                    $inventory->daily_limit=$request->input('daily_limit');
                    $inventory->save();
                    return Redirect::to(url('/inventory/'.$inventory->id.'/edit'))->withErrors(['success'=>true,'msg'=>"Inventory added successfully"]);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));

    }

    public function InventoryEditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(User::isSuperAdmin()) {
                    $inventory_obj = Inventory::find($id);
                    return view('inventory.edit')->with('inventory_obj',$inventory_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('user/login'));
        }
        return Redirect::back()->withErrors(['success'=>false,'msg'=>"Select valid ID"]);
    }

    public function edit_inventory(Request $request){
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $inventory_id = $request->input('inventory_id');
                    $inventory=Inventory::find($inventory_id);
                    if($inventory){
                        $data=array();
                        $audit= new AuditsController();
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        if($inventory->name!=$request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$inventory->name);
                            array_push($data,$request->input('name'));
                            $inventory->name=$request->input('name');
                        }
                        if($inventory->type!=$request->input('type')){
                            array_push($data,'Type');
                            array_push($data,$inventory->type);
                            array_push($data,$request->input('type'));
                            $inventory->type=$request->input('type');
                        }
                        if($inventory->category!=$request->input('category')){
                            array_push($data,'Category');
                            array_push($data,$inventory->category);
                            array_push($data,$request->input('category'));
                            $inventory->category=$request->input('category');
                        }
                        if($inventory->daily_limit!=$request->input('daily_limit')){
                            array_push($data,'Daily Limit');
                            array_push($data,$inventory->daily_limit);
                            array_push($data,$request->input('daily_limit'));
                            $inventory->daily_limit=$request->input('daily_limit');
                        }
                        if($inventory->status!=$active){
                            array_push($data,'Status');
                            array_push($data,$inventory->status);
                            array_push($data,$active);
                            $inventory->status=$active;
                        }
                        $audit->store('inventory',$inventory_id,$data,'edit');
                        $inventory->save();
                        return Redirect::to(url('/inventory/'.$inventory->id.'/edit'))->withErrors(['success'=>true,'msg'=> 'Inventory Edited Successfully']);
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
        if(Auth::check()) {
            if (User::isSuperAdmin()) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    switch ($request->input('oper')) {
                        case 'add':
                            $inventory = new Inventory();
                            $inventory->name = $request->input('name');
                            $inventory->category = $request->input('category');
                            $inventory->type = $request->input('type');
                            $inventory->daily_limit = $request->input('daily_limit');
                            $inventory->user_id = Auth::user()->id;
                            $inventory->save();
                            $inventory_obj = Inventory::where('id', $inventory->id)->get();
                            return json_encode($inventory_obj);
                            break;
                        case 'edit':
                            $inventory_id = $request->input('id');
                            $inventory = Inventory::find($inventory_id);
                            if ($inventory) {
                                $data=array();
                                $audit= new AuditsController();
                                if($inventory->name!=$request->input('name')){
                                    array_push($data,'Name');
                                    array_push($data,$inventory->name);
                                    array_push($data,$request->input('name'));
                                    $inventory->name=$request->input('name');
                                }
                                $audit->store('inventory',$inventory_id,$data,'edit');
                                $inventory->save();
                                return 'ok';
                            }
                            break;
                    }
                }
            }
            return "don't have permission";
        }
        return Redirect::to(url('user/login'));
    }
}