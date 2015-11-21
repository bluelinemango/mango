@extends('Layout')
@section('siteTitle')Add Target Group @endsection
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
                        <h3 class="pull-left"><i class="splashy-calendar_day"></i>Add Target Group </h3>
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

                    <form class="form-horizontal" action="{{URL::route('targetgroup_create')}}" method="post" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">name <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" placeholder="Please Fill your name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Campaign Name <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <select class="form-control" name="campaign_id" id="">
                                    <option value="0">Select One...</option>
                                    @foreach($campaign_obj as $index)
                                        <option value="{{$index->caid}}">{{$index->caname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">IAB Category <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="iab_category" placeholder="Please Fill your IAB Category" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">IAB Sub Category <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="iab_sub_category" placeholder="Please Fill your IAB Sub Category" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">MAX Impression <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="max_impression" placeholder="Please Fill your MAX Impression" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Daily MAX Impression <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="daily_max_impression" placeholder="Please Fill your Daily MAX Impression" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">MAX Budget <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="max_budget" placeholder="Please Fill your MAX Budget" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Daily MAX Budget <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="daily_max_budget" placeholder="Please Fill your Daily MAX Budget" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pacing Plan <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pacing_plan" placeholder="Please Fill your Pacing Plan" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Advertiser Domain <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="advertiser_domain_name" placeholder="Please Fill your Advertiser Domain" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">CPM <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="cpm" placeholder="Please Fill your CPM" >
                            </div>
                        </div><div class="form-group">
                            <label class="col-sm-2 control-label">Frequency In Sec <i style="color:#F00" >*</i> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="frequency_in_sec" placeholder="Please Fill your Frequency" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Start Date</label>
                            <div class="col-sm-4">
                                <div class="input-group date" id="dp_start">
                                    <input class="form-control" readonly="" type="text" name="start_date">
                                    <span class="input-group-addon"><i class="splashy-calendar_day_up"></i></span>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">End Date</label>
                            <div class="col-sm-4">
                                <div class="input-group date" id="dp_end">
                                    <input class="form-control" readonly="" name="end_date" type="text">
                                    <span class="input-group-addon"><i class="splashy-calendar_day_down"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="description" ></textarea>
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