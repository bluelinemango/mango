@extends('Layout')
@section('siteTitle')List Of Target Group for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
    <div class="main_content">
        <div class="breadCrumb module">
            <ul>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-home"></i></a>
                </li>
                <li>
                    <a href="#">User : {{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                </li>
            </ul>
        </div>
        <div class="formSep">

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading clearfix">
                        <h3 class="pull-left"><i class="splashy-calendar_day"></i>List Of Target Group for User : {{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
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
                    <table class="table table-bordered table-striped">
                        <thead>
                        <th>Target group id</th>
                        <th>Target Group Name</th>
                        <th>Campaign name</th>
                        <th>Domain name</th>
                        <th>Created At</th>
                        <th>Modify</th>
                        </thead>
                        <tbody>
                        @foreach($targetgroup_obj as $index)
                            <tr>
                                <td>tg{{$index->tid}}</td>
                                <td><a href="{{url('/targetgroup/edit/'.$index->tid)}}">{{$index->tname}}</a></td>
                                <td><a href="{{url('/campaign/edit/'.$index->caid)}}">{{$index->caname}}</a></td>
                                <td>{{$index->tadvertiser_domain_name}}</td>
                                <td>{{$index->tcreated_at}}</td>
                                <td>
                                    @foreach($permission as $per_obj)
                                        @if($per_obj->getPermission->name != 'EDIT_ADVERTISER')
                                            <a href="{{url('targetgroup/edit/'.$index->tid)}}">Edit</a> |
                                        @endif
                                    @endforeach
                                    <a href="{{url('targetgroup/delete/'.$index->tid)}}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <div class="formSep">

        </div>
        @foreach($permission as $per_obj)
            @if($per_obj->getPermission->name == 'ADD_CLIENT')
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <a href="{{url('targetgroup/add')}}" class="btn btn-default btn-sm"> <i class="splashy-check"></i> Add Target Group</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection