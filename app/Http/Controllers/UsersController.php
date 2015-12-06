<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Role;
use App\Models\Role_Permission;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function GetView(){
        $user_obj=User::all();
        return view('user.user_list')->with('user_obj', $user_obj)->with('permission', \Permission_Check::getPermission());
    }
    public function RegisterView()
    {
        $role_obj = Role::get();
        return view('user.register')->with('role_obj', $role_obj)->with('permission', \Permission_Check::getPermission());
    }

    public function LoginView()
    {
        return view('user.login');
    }

    public function EditView($id)
    {
        if (!is_null($id)) {
            if (Auth::check()) {
                if (1 == 1) { // Permission goes here
                    $user_obj = User::find($id);
                    $role_obj = Role::get();
 //                    return dd($targetgroup_obj);
                    return view('user.edit')->with('user_obj', $user_obj)->with('role_obj', $role_obj)->with('permission', \Permission_Check::getPermission());
                }
            }
        }
    }

    public function user_create(Request $request){
//        return dd($request->all());
        $validate = \Validator::make($request->all(), User::$rule);
        if ($validate->passes()) {
            $user = new User();
            $user_check = User::where('email', '=', $request->input('email'))->first();
            $flg=0;
            if (!is_null($user_check)) {
                $flg=1;
            }
            if($flg== 0) {
                $active=0;
                if($request->input('active')=='on'){
                    $active=1;
                }
                $user->name = $request->input('name');
                $user->role_id = $request->input('role_group');
                $user->active = $active;
                $user->email = $request->input('email');
                $user->password = \Hash::make($request->input('password'));
                $user->save();
                return \Redirect::to(url('/user/usr'.$user->id.'/edit'))->withErrors(['success' => true, 'msg' =>"User Registered Successfully"]);
            }
        }
        //return print_r($validate->messages());
        return \Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
    }

    public function edit_user(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (1 == 1) { //permission goes here
                $validate = \Validator::make($request->all(), ['name' => 'required','email' => 'required']);
                if ($validate->passes()) {
                    $active=0;
                    if($request->input('active')=='on'){
                        $active=1;
                    }
                    $user_id = $request->input('user_id');
                    $password=$request->input('password');
                    $user = User::find($user_id);
                    $user->name = $request->input('name');
                    $user->active = $active;
                    $user->role_id = $request->input('role_group');
                    $user->email = $request->input('email');
                    if (!is_null($password) and $password!="") {
                        $user->password = Hash::make($password);
                    }
                    $user->save();
                    return Redirect::back()->withErrors(['success' => true, 'msg' => 'User Edited Successfully']);
                } else {
                    return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
                }
            } else {
                return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
            }

        } else {
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
