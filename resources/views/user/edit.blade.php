@extends('Layout')
@section('siteTitle')Edit User: {{$user_obj->name}} @endsection
@section('content')
    <div class="main_content">
        <div class="breadCrumb module">
            <ul>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-home"></i></a>
                </li>
                <li>
                    <a href="#">Edit User</a>
                </li>
                <li>
                    <a href="{{url('/user/edit/'.$user_obj->id)}}">User : usr{{$user_obj->id}}</a>
                </li>
            </ul>
        </div>
        <div class="formSep">

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading clearfix">
                        <h3 class="pull-left"><i class="splashy-calendar_day"></i>Edit User: {{$user_obj->name}}</h3>
                    </div>
                </div>
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

                        <form class="form-horizontal" action="{{URL::route('user_update')}}" method="post" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT"/>
                            <input type="hidden" name="user_id" value="{{$user_obj->id}}"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">name <i style="color:#F00" >*</i> </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" placeholder="Please Fill your name" value="{{$user_obj->name}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">company <i style="color:#F00" >*</i> </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="company" placeholder="Please Fill your Company" value="{{$user_obj->company}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email <i style="color:#F00" >*</i> </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" value="{{$user_obj->email}}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password <i style="color:#F00" >*</i> </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="password" placeholder="Please Fill your Password" >
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="submit" class="btn btn-primary btn-block" style="font-size:18px; font-weight:bolder;" value="submit">
                            </div>
                        </form>
                </div>

            </div>

        </div>
        <div class="formSep">

        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <a href="#" class="btn btn-default btn-sm"><i class="splashy-check"></i> Save</a>
            </div>
        </div>
    </div>
@endsection
@section('FooterScripts')

@endsection