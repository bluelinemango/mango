<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {

    use ThrottlesLogins;


    protected $auth;
    public function __construct(Guard $auth){
        $this->auth=$auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function LoginView(){
        if(Auth::check()){
            return Redirect::to('/client');
        }else {
            return view('login');
        }
    }

    public function postLogin(Request $request){
        $validate=\Validator::make($request->all(),['email' => 'required|email', 'password' => 'required',]);
        if($validate->passes()){
            $credentials = $request->only('email','password');
            if ($this->auth->attempt($credentials, $request->has('remember'))){
                \Session::put('UserID', Auth::user()->id);
                return Redirect::to('/client');
            }
            return redirect('/user/login')
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['success'=>false,'msg'=>'ایمیل یا رمز ورود اشباه میباشد.']);
        }

        return redirect('/user/login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['success'=>false,'msg'=>$validate->messages()->all()]);

    }
    public function getLogout()
    {
        if (\Session::has('UserID'))
        {
            \Session::forget('UserID');
        }
        $this->auth->logout();

        return redirect('/user/login');
    }

}
