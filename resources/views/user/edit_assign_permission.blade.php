@extends('Layout1')
@section('siteTitle')
    Edit assign permission
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li><a href="#" class="active">Edit Role Permission: {{$role_obj->name}}</a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Assign Permission To Role</h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('edit_permission_assign')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="role_group" value="{{$role_obj->id}}"/>
                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$role_obj->name}}</h5>

                            </div>

                            <div class="clearfix"></div>
                            <!--.form-group-->
                        </div>
                        <div class="note note-primary note-bottom-striped">
                            <h4>Choose Permission</h4>
                            @foreach($permission_obj as $index)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{$index->name}}</label>

                                        <div class="checkboxer">
                                            <input type="checkbox" name="{{$index->name}}"
                                                   class="switchery-teal" @if(in_array($index->id,$role_permission_obj)) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                                <button type="submit" class="btn btn-success" style="width:20%">Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
@endsection
@section('FooterScripts')
    <script>
        $(document).ready(function () {
            FormsSwitchery.init();
        });
    </script>

@endsection