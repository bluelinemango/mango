@extends('Layout1')
@section('siteTitle')Edit User: {{$user_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li><a href="#" class="active">User Edit: usr{{$user_obj->id}}</a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Edit User: {{$user_obj->name}}  </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('user_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="user_id" value="{{$user_obj->id}}"/>
                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$user_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Email Address</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="email" name="email" placeholder="Email Address"
                                                   class="form-control" value="{{$user_obj->email}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Password</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="password" id="password" name="password" placeholder="Password"
                                                   class="form-control" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Select Role</label>

                                    <select name="role_group" class="selecter">
                                        <option value="0" disabled>Select One</option>
                                        @foreach($role_obj as $index)
                                            <option value="{{$index->id}}"@if($index->id==$user_obj->role_id) selected @endif>{{$index->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Select Company</label>

                                    <select name="company_group" class="selecter">
                                        <option value="0" disabled>Select One</option>
                                        @foreach($company_obj as $index)
                                            <option value="{{$index->id}}"@if($index->id==$user_obj->company_id) selected @endif>{{$index->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                                <div class="col-md-2">
                                    <label class="control-label" for="">Comapny Name</label>
                                    <h5>{{$company_obj->getCompany->name}}</h5>

                                </div>
                            @endif
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="switcher">
                                        <input type="checkbox" name="active"
                                               hidden id="active" @if($user_obj->status=="Active") checked @endif>
                                        <label for="active"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!--.form-group-->
                        </div>
                        <hr/>
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
    <div class="col-md-3">
        <div class="panel indigo">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4 class="pull-left">Activities</h4>

                    <div class="pull-right audit-select">
                        <select id="audit_status" class="selecter col-md-12">
                            <option value="entity">This Entity</option>
                            <option value="all">All</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0px 0 0 10px;">
                <div class="timeline single" id="show_audit">
                </div>
                <!--.timeline-->
            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
    <!--.col-->
    <div class="clearfix"></div>

@endsection
@section('FooterScripts')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{url('ajax/getAudit/user/'.$user_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/user/'.$user_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: 'Please enter a VALID email address'
                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    interested: {
                        required: 'Please select interested service'
                    },
                    budget: {
                        required: 'Please select your budget'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        })
    </script>
@endsection