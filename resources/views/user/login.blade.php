@extends('Layout')
@section('siteTitle')Login Form @endsection

@section('content')
    <div class="main_content">
        <div class="breadCrumb module">
            <ul>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-home"></i></a>
                </li>
                <li>
                    <a href="#">Client : cl0001</a>
                </li>
                <li>
                    <a href="#">Advertiser : advertiser00111</a>
                </li>
                <li>
                    <a href="#">Campaign : cmp925051</a>
                </li>
                <li>
                    TargetGroup : tg00011
                </li>
            </ul>
        </div>
        <div class="formSep">

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading clearfix">
                        <h3 class="pull-left"><i class="splashy-calendar_day"></i>Login Form</h3>
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
                    <form class="form-horizontal" method="post"
                          action="{{URL::route('user_login')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('email')}}"
                                       name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <input type="submit" class="btn btn-primary btn-block" value="Signe IN">
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