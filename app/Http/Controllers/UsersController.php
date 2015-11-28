<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function RegisterView(){
        return view('user.register');
    }

    public function LoginView(){
        return view('user.login');
    }

    public function EditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(1==1){ // Permission goes here
                    $user_obj = User::find($id);
//                    return dd($targetgroup_obj);
                    return view('user.edit')->with('user_obj',$user_obj)->with('permission',\Permission_Check::getPermission());
                }
            }
        }
    }

    public function edit_user(Request $request){
        if(Auth::check()){
            if(1==1){ //permission goes here
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $user_id = $request->input('user_id');
                    $user=User::find($user_id);
                    if($user and ($user->id == Auth::user()->id)){
                        $user->name=$request->input('name');
                        $user->company=$request->input('company');
                        $user->email=$request->input('email');
                        if(!is_null($request->input('password'))){
                            $user->password=Hash::make($request->input('password'))
                        }
                        $user->save();
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'User Edited Successfully']);
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
