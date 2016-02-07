<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    public function ListView(){
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                $company = Company::get();
                return view('company.list')->with('company', $company);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function AddCompanyView()
    {
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                return view('company.add');
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function add_company(Request $request){
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $company=new Company();
                    $company->name=$request->input('name');
                    $company->save();
                    return Redirect::to(url('/company/'.$company->id.'/edit'))->withErrors(['success'=>true,'msg'=>"Company added successfully"]);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));

    }

    public function CompanyEditView($id){
        if(!is_null($id)){
            if(Auth::check()){
                if(User::isSuperAdmin()) {
                    $company_obj = Company::find($id);
                    return view('company.edit')->with('company_obj',$company_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('user/login'));
        }
        return Redirect::back()->withErrors(['success'=>false,'msg'=>"Select valid ID"]);
    }

    public function edit_company(Request $request){
        if(Auth::check()){
            if(User::isSuperAdmin()) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $company_id = $request->input('company_id');
                    $company=Company::find($company_id);
                    if($company){
                        $data=array();
                        $audit= new AuditsController();
                        if($company->name!=$request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$company->name);
                            array_push($data,$request->input('name'));
                            $company->name=$request->input('name');
                        }
                        $audit->store('company',$company_id,$data,'edit');
                        $company->save();
                        return Redirect::to(url('/company/'.$company->id.'/edit'))->withErrors(['success'=>true,'msg'=> 'Company Edited Successfully']);
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
                            $company = new Company();
                            $company->name = $request->input('name');
                            $company->user_id = Auth::user()->id;
                            $company->save();
                            $company_obj = Company::where('id', $company->id)->get();
                            return json_encode($company_obj);
                            break;
                        case 'edit':
                            $company_id = $request->input('id');
                            $company = Company::find($company_id);
                            if ($company) {
                                $data=array();
                                $audit= new AuditsController();
                                if($company->name!=$request->input('name')){
                                    array_push($data,'Name');
                                    array_push($data,$company->name);
                                    array_push($data,$request->input('name'));
                                    $company->name=$request->input('name');
                                }
                                $audit->store('company',$company_id,$data,'edit');
                                $company->save();
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
