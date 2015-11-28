@extends('Layout')
@section('siteTitle')افزودن کاربر جدید@endsection
@section('content')
    <style>
        #registerForm input{
            margin-bottom: 1em;;
        }
    </style>
    <!-- Content -->
    <div class="row content">
            <span ng-app="myApp" ng-controller="index">
            <section class="main-content col-lg-9 col-md-9 col-sm-9">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="carousel-heading no-margin">
                            <h4><i class="glyphicon glyphicon-user"></i> ثبت نام در جزیره الکترونیکی</h4>
                        </div>
                        <div class="page-content">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(isset($errors))
                                        @foreach($errors->get('msg') as $error)
                                            <div class="alert alert-{{($errors->get('success')[0] == true)?'success':'danger'}} alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <strong>{{$error}}</strong>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(Session::has('CaptchaError'))
                                        <ul>
                                            <li>{{Session::get('CaptchaError')}}</li>
                                        </ul>
                                    @endif
                                    <form class="form-horizontal" id="registerForm" action="{{URL::route('user_create')}}" method="post" name="RegisterForm">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">ایمیل <i style="color:#F00" >*</i> </label>
                                            <div class="col-sm-8">

                                                <input type="text" class="form-control" @if(old('email')!=null)ng-init="registerForm.email='{{old('email')}}'"@endif name="email" placeholder="ایمیل خود را وارد نمایید"
                                                       ng-model="registerForm.email" validator="required, email" email-error-message="ایمیل صحیح وارد نمایید"
                                                       valid-method="blur" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">موبایل</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" @if(old('phone')!=null)ng-init="registerForm.phone = '{{old('phone')}}'"@endif name="phone" placeholder="موبایل خود را وارد نمایید"
                                                       ng-model="registerForm.phone" validator="required, number, phonelength=11" valid-method="blur">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">رمز ورود <i style="color:#F00" >*</i></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password" placeholder="کلمه عبور خود را وارد نمایید"
                                                       ng-model="registerForm.password" validator="required" email-error-message="کلمه عبور را وارد نمایید"
                                                       valid-method="blur">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">تکرار رمز ورود <i style="color:#F00" >*</i></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password_confirmation"  placeholder="تکرار کلمه عبور را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">کد امنیتی</label>
                                            <div class="col-sm-8">
                                                <div id="captcha" data-expired-callback="CallbackCaptchaExpire" data-callback="onloadCallbackCaptcha" class="g-recaptcha" data-sitekey="6LdOJAcTAAAAAILiuyASrH-lsWgqkKv79OkDeuES"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary btn-block" style="font-size:18px; font-weight:bolder;" ng-click="registerForm.submit(RegisterForm)" value="ثبت نا م">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel-footer panel-primary"><div>بعد از ثبت نام ایمیل تاییدیه برای شما ارسال میشود.</div></div>
                        </div>
                    </div>
                </div>
            </section>
            </span>

        <!-- /Main Content -->
        <!-- Sidebar -->
        <aside class="sidebar col-lg-3 col-md-3 col-sm-3 ">
        </aside>
        <!-- /Sidebar -->
    </div>
    <!-- /Content -->
@endsection
@section('FooterScripts')

@endsection