@extends('Layout1')
@section('siteTitle')Edit Client: {{$client_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li><a href="#" class="active">Client : {{$client_obj->name}}</a></li>
    </ol>
@endsection
@section('content')

    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Edit Client: {{$client_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('client_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="client_id" value="{{$client_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$client_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Company</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="company" name="company" placeholder="Company"
                                                   class="form-control" value="{{$client_obj->company}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="checkboxer">
                                        <input type="checkbox" name="active"
                                               class="switchery-teal" @if($client_obj->status=='Active')
                                               checked @endif>
                                        <label for="check1">Active</label>
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
    <!--.col-->

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

    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4 class="pull-left">Advertiser List </h4>
                    @if(in_array('ADD_EDIT_ADVERTISER',$permission))
                        <a href="{{url('client/cl'.$client_obj->id.'/advertiser/add')}}"
                           class="btn btn-primary pull-right">
                            ADD Advertiser
                        </a>
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body">
                <div id="advertiser_grid"></div>
            </div>
        </div>
    </div>
@endsection
@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            FormsSwitch.init();
            FormsSwitchery.init();

            $.ajax({
                url: "{{url('ajax/getAudit/client/'.$client_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'all') {
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                } else if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/client/'.$client_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                } else if ($(this).val() == 'user') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/user')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.advertiser, function (advertiser) {
                            return (!filter.name || advertiser.name.indexOf(filter.name) > -1);
                        });
                    },

                    updateItem: function (updatingAdvertiser) {
                        updatingAdvertiser['oper'] = 'edit';
                        console.log(updatingAdvertiser);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/advertiser')}}",
                            data: updatingAdvertiser,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if (response.success == true) {
                                var title = "Success";
                                var color = "#739E73";
                                var icon = "fa fa-check";
                            } else if (response.success == false) {
                                var title = "Warning";
                                var color = "#C46A69";
                                var icon = "fa fa-bell";
                            }
                            ;

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.advertiser = [

                    @foreach($client_obj->getAdvertiser as $index)
                    {
                        "id": 'adv{{$index->id}}',
                        "name": '{{$index->name}}',
                        @if($index->status == 'Active')
                        "status": '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->GetClientID->id.'/advertiser/adv'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /> </a>'

                    },
                    @endforeach
                ];

                $("#advertiser_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", autosearch: true, type: "text", width: 70},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit", sorting: false, width: 50, align: "center"},
                        {type: "control"}
                    ]

                });

            });


            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
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
        });
        /* END BASIC */

    </script>
@endsection