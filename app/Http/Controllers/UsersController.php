<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Company;
use App\Models\Permission;
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
        if(Auth::check()) {
            if (Auth::user()->role_id == 1) {
                $user_obj = User::with('getCompany')->with('getRole')->get();
            } else {
                $user_obj = User::with('getCompany')->with('getRole')->where('company_id', Auth::user()->company_id)->get();
            }
//        return dd($user_obj);
            return view('user.user_list')->with('user_obj', $user_obj)->with('permission', \Permission_Check::getPermission());
        }
        return Redirect::to(url('user/login'));
    }
    public function GetRolePermissionView(){
        if(Auth::user()->role_id==1){
            $role_obj = Role::all();
            return view('user.role_permission_list')
                ->with('role_obj', $role_obj)
                ->with('permission', \Permission_Check::getPermission());
        }else {
            return "dont have permission";
        }
//        return dd($user_obj);
    }
    public function RegisterView()
    {
        if(Auth::user()->role_id==1) {
            $company_obj = Company::all();
            $role_obj = Role::get();
        }else{
            $company_obj=User::with('getCompany')->find(Auth::user()->id);
            $role_obj = Role::where('id','>',1)->get();

        }
        return view('user.register')
            ->with('role_obj', $role_obj)
            ->with('company_obj', $company_obj)
            ->with('permission', \Permission_Check::getPermission());
    }

    public function AddRoleView()
    {
        if(Auth::check()) {
            return view('user.add_role')
                ->with('permission', \Permission_Check::getPermission());
        }
        return Redirect::to(url('user/login'));
    }
    public function AssignPermissionEditView($id)
    {
        if(!is_null($id)) {
            if (Auth::user()->role_id == 1) {
                $role_obj = Role::find($id);
                $role_permission_obj=Role_Permission::where('role_id',$id)->get();
                $permission_obj = Permission::all();
                $role_permission=array();
                foreach($role_permission_obj as $index){
                    array_push($role_permission,$index->permission_id);
                }
                return view('user.edit_assign_permission')
                    ->with('role_obj', $role_obj)
                    ->with('permission_obj', $permission_obj)
                    ->with('role_permission_obj', $role_permission)
                    ->with('permission', \Permission_Check::getPermission());
            }else{
                return \Redirect::back()->withErrors(['success' => false, 'msg' => 'You don\'t have permission']);

            }
        }
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
                    $user_obj = User::with('getCompany')->find($id);
                    if(Auth::user()->role_id==1) {
                        $company_obj = Company::all();
                        $role_obj = Role::get();
                    }else{
                        $company_obj=User::with('getCompany')->find(Auth::user()->id);
                        $role_obj = Role::where('id','>',1)->get();

                    }
 //                    return dd($targetgroup_obj);
                    return view('user.edit')
                        ->with('user_obj', $user_obj)
                        ->with('company_obj', $company_obj)
                        ->with('role_obj', $role_obj)
                        ->with('permission', \Permission_Check::getPermission());
                }
            }
        }
    }

    public function RoleEditView($id)
    {
        if (!is_null($id)) {
            if (Auth::check()) {
                if (1 == 1) { // Permission goes here
                    $role_obj = Role::find($id);
 //                    return dd($targetgroup_obj);
                    return view('user.edit_role')
                        ->with('role_obj', $role_obj)
                        ->with('permission', \Permission_Check::getPermission());
                }
            }
        }
    }

    public function user_create(Request $request){
//        return dd($request->all());
        $validate = \Validator::make($request->all(), User::$rule);
        if ($validate->passes()) {
            if(Auth::user()->role_id!=1 and $request->input('role_group')==1){
                return \Redirect::back()->withErrors(['success' => false, 'msg' => 'Plz select correct role']);
            }
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
                if(Auth::user()->role_id==1) {
                    $user->company_id = $request->input('company_group');
                }else{
                    $user->company_id = Auth::user()->company_id ;
                }
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
    public function role_create(Request $request){
//        return dd($request->all());
        $validate = \Validator::make($request->all(), ['name'=>'required']);
        if ($validate->passes()) {
            $role_check = Role::where('name', $request->input('name'))->first();
            if (!is_null($role_check)) {
                return \Redirect::back()->withErrors(['success' => false, 'msg' => 'Role name already existed !']);
            }
            $role=new Role();
            $role->name=$request->input('name');
            $role->save();
            return \Redirect::to(url('/user/role/edit/'.$role->id))->withErrors(['success' => true, 'msg' =>"Role Added Successfully"]);
        }
        //return print_r($validate->messages());
        return \Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
    }
    public function edit_permission_assign(Request $request){
//        return dd($request->all());
        if(!is_null($request->input('role_group')) and $request->input('role_group') != "") {
            if (Auth::user()->role_id == 1) {
                Role_Permission::where('role_id', $request->input('role_group'))->delete();
                $prm_obj = Permission::all();
                foreach ($prm_obj as $index) {
                    if ($request->input($index->name) == "on") {
                        $perm_role = new Role_Permission();
                        $perm_role->permission_id = $index->id;
                        $perm_role->role_id = $request->input('role_group');
                        $perm_role->save();
                    }
                }
                return \Redirect::back()->withErrors(['success' => true, 'msg' => "Permission Role Assigned Successfully"]);
                //return print_r($validate->messages());
            } else {
                return \Redirect::back()->withErrors(['success' => false, 'msg' => 'You don\'t have permission']);
            }
        }
        return \Redirect::back()->withErrors(['success' => false, 'msg' => 'Select One Role plz']);
    }

    public function edit_user(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (1 == 1) { //permission goes here
                $validate = \Validator::make($request->all(), ['name' => 'required','email' => 'required','company_group' => 'required','role_group' => 'required']);
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
                    if(Auth::user()->role_id==1) {
                        $user->company_id = $request->input('company_group');
                    }else{
                        $user->company_id =Auth::user()->company_id ;
                    }
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
    public function edit_role(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (1 == 1) { //permission goes here
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    $role = Role::find($request->input('role_id'));
                    $role->name = $request->input('name');
                    $role->save();
                    return Redirect::back()->withErrors(['success' => true, 'msg' => 'Role Edited Successfully']);
                } else {
                    return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
                }
            } else {
                return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
            }

        } else {
            return Redirect::to(url('user/login'));
        }
    }
    public function GetDashboardView(){
        if(Auth::check()) {
            $user_obj=User::with('getRole')->find(Auth::user()->id);
            return view('dashboard')
                ->with('user_obj',$user_obj)
                ->with('permission', \Permission_Check::getPermission());
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
