<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Audits;
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
      //TODO: chek if not super admin cant edit super admin user name
    public function GetView(){
        if(Auth::check()) {
            $user_obj=array();
            if (User::isSuperAdmin()) {
                $user_obj = User::with('getCompany')->with('getRole')->get();
            } else {
                $user_obj = User::with('getCompany')->where('role_id','<>',1)->with('getRole')->where('company_id', Auth::user()->company_id)->get();
            }
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
                if (in_array('ADD_EDIT_USER', $this->permission)) {
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
                $active='Inactive';
                if($request->input('active')=='on'){
                    $active='Active';
                }
                $audit = new AuditsController();
                $user->name = $request->input('name');
                $user->role_id = $request->input('role_group');
                if(Auth::user()->role_id==1) {
                    $user->company_id = $request->input('company_group');
                }else{
                    $user->company_id = Auth::user()->company_id ;
                }
                $user->status = $active;
                $user->email = $request->input('email');
                $user->password = \Hash::make($request->input('password'));
                $user->save();
                $audit->store('user', $user->id, null, 'add');
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
            if (in_array('ADD_EDIT_USER', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required','email' => 'required','company_group' => 'required','role_group' => 'required']);
                if ($validate->passes()) {
                    $active='Inactive';
                    if($request->input('active')=='on'){
                        $active='Active';
                    }
                    $user_id = $request->input('user_id');
                    $password=$request->input('password');
                    $user = User::find($user_id);
                    $data = array();
                    $audit = new AuditsController();
                    if ($user->name != $request->input('name')) {
                        array_push($data, 'Name');
                        array_push($data, $user->name);
                        array_push($data, $request->input('name'));
                        $user->name = $request->input('name');
                    }
                    if ($user->status != $active) {
                        array_push($data, 'Status');
                        array_push($data, $user->status);
                        array_push($data, $active);
                        $user->status = $active;
                    }
                    if ($user->role_id != $request->input('role_group')) {
                        array_push($data, 'Role');
                        array_push($data, $user->role_id);
                        array_push($data, $request->input('role_group'));
                        $user->role_id = $request->input('role_group');
                    }

                    if(User::isSuperAdmin()) {
                        if ($user->company_id != $request->input('company_group')) {
                            array_push($data, 'Company');
                            array_push($data, $user->company_id);
                            array_push($data, $request->input('company_group'));
                            $user->company_id = $request->input('company_group');
                        }
                    }
                    if ($user->email != $request->input('email')) {
                        array_push($data, 'Email');
                        array_push($data, $user->email);
                        array_push($data, $request->input('email'));
                        $user->email = $request->input('email');
                    }

                    if (!is_null($password) and $password!="") {
                        $user->password = Hash::make($password);
                    }
                    $audit->store('user', $user_id, $data, 'edit');
                    $user->save();
                    return Redirect::back()->withErrors(['success' => true, 'msg' => 'User Edited Successfully']);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();

            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => 'dont have Edit Permission']);
        }
        return Redirect::to(url('user/login'));
    }

    public function ChangeStatus($id)
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_USER', $this->permission)) {
                $user_id = $id;

                if (User::isSuperAdmin()) {
                    $user = User::find($user_id);
                } else {
                    $user = User::where('company_id',Auth::user()->company_id)->find($user_id);
                    if(!$user){
                        return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your User'])->withInput();
                    }
                }
                if ($user) {
                    $data = array();
                    $audit = new AuditsController();
                    if ($user->status == 'Active') {
                        array_push($data, 'status');
                        array_push($data, $user->status);
                        array_push($data, 'Inactive');
                        $user->status = 'Inactive';
                        $msg = 'disable';
                    } elseif ($user->status == 'Inactive') {
                        array_push($data, 'status');
                        array_push($data, $user->status);
                        array_push($data, 'Active');
                        $user->status = 'Active';
                        $msg = 'actived';
                    }
                    $audit->store('advertiser', $user_id, $data, 'edit');
                    $user->save();
                    return $msg;
                }
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
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
            if(User::isSuperAdmin()){
                $audit= Audits::with('getUser')->orderBy('created_at','DESC')->get();
            }else {
                $usr_comp = $this->user_company();
                $audit= Audits::with('getUser')->whereIn('user_id', $usr_comp)->orderBy('created_at','DESC')->get();
            }
            $sub= new AuditsController();
            $audit_obj=$sub->SubAudit($audit);

            $user_obj=User::with('getRole')->find(Auth::user()->id);
//            return dd($audit_obj);
            return view('dashboard')
                ->with('user_obj',$user_obj)
                ->with('audit_obj',$audit_obj);
        }
        return Redirect::to(url('user/login'));
    }

    public function jqgrid(Request $request){
        //return dd($request->all());
        if(Auth::check()){
            if (in_array('ADD_EDIT_USER', $this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $user_id=substr($request->input('id'),3);
                    if (User::isSuperAdmin()) {
                        $user=User::find($user_id);
                    }else{
                        $usr_company = $this->user_company();
                        $user=User::where('company_id', Auth::user()->company_id)->find($user_id);
                        if (!$user) {
                            return $msg=(['success' => false, 'msg' => "Some things went wrong"]);
                        }
                    }
                    if ($user) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($user->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $user->name);
                            array_push($data, $request->input('name'));
                            $user->name = $request->input('name');
                        }
                        $audit->store('user', $user_id, $data, 'edit');
                        $user->save();
                        return $msg=(['success' => true, 'msg' => "your User Saved successfully"]);
                    }
                    return $msg=(['success' => false, 'msg' => "Please Select a User First"]);
                }
                return $msg=(['success' => false, 'msg' => "Please Check your field"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

}
