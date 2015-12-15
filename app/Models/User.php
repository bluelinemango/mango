<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public static $rule=array(
        'email'=>'required|email|max:50|unique:users,email',
        'password'=>'required|min:4',
        'company_group'=>'required',
        'role_group'=>'required',
//        'password'=>'required|confirmed|min:4',
//        'password_confirmation'=>'required|min:4',
    );

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function role_permission_mapping(){
        return $this->hasMany('App\Models\role_permission','role_id');
    }

    public function getRole(){
        return $this->belongsTo('App\Models\Role','role_id');
    }
    public function getCompany(){
        return $this->belongsTo('App\Models\Company','company_id');
    }
}
