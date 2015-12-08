<?php namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
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
            return Redirect::to(url('client'));
        }else {
            return view('login');
        }
    }

    public function postLogin(Request $request){
        $validate=\Validator::make($request->all(),['email' => 'required|email', 'password' => 'required',]);
        if($validate->passes()){
            $credentials = $request->only('email','password');
            if ($this->auth->attempt($credentials, $request->has('remember'))){
                $user=User::find(Auth::user()->id);
                $user->last_login_time=date('Y-m-d:h:i:s');
                $user->save();
                \Session::put('UserID', Auth::user()->id);
                return Redirect::to(url('client'));
            }
            return redirect(url('/user/login'))
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['success'=>false,'msg'=>'invalid Email or Password!']);
        }

        return redirect(url('/user/login'))
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

        return redirect(url('/user/login'));
    }

}
