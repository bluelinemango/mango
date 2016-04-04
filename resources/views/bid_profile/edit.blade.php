@extends('Layout1')
@section('siteTitle')Edit Bid Profile: {{$bid_profile_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$bid_profile_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client :
                cl{{$bid_profile_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$bid_profile_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$bid_profile_obj->advertiser_id.'/edit/')}}">Advertiser
                : adv{{$bid_profile_obj->getAdvertiser->id}}</a>
        </li>
        <li><a href="#" class="active">Bid Profile Editing : bpf{{$bid_profile_obj->id}}</a></li>
    </ol>
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Edit Bid Profile: bpf{{$bid_profile_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('bidProfile_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="bidProfile_id" value="{{$bid_profile_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$bid_profile_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="switcher">
                                        <input type="checkbox" name="active"
                                        @if($bid_profile_obj->status=='Active')
                                               checked id="active" @endif hidden>
                                        <label for="active"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$bid_profile_obj->getAdvertiser->name}}</h5>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$bid_profile_obj->getAdvertiser->GetClientID->name}}</h5>

                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="">Last Modified</label>
                                <h5>{{$bid_profile_obj->updated_at}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <!--.form-group-->
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

        <div class="panel ">

            <!--.panel-heading-->
            <div class="panel-body">
                <div id="bid_profile_entry_grid"></div>

            </div>
        </div>

    </div>
    <!--.col-->

    <div class="col-md-3">
        <div class="panel">
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





    <div class="modal scale fade" id="defaultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailsForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Bid Profile</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row example-row">
                            <div class="col-md-3">Domain</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="domain" name="domain" class="form-control"
                                               placeholder="Domain">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Bid Strategy</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <select name="bid_strategy" class="selecter" id="bid_strategy">
                                    <option value="Absolute">Absolute</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Bid Value</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input id="bid_value" name="bid_value" type="text" class="form-control"
                                               placeholder="Bid Value"/>
                                        <input id="bid_value1" name="bid_value1" type="text" style="display: none"
                                               class="form-control" placeholder="Bid Value"/>
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <!--.row-->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="width:20%">Submit
                        </button>

                    </div>
                </form>
            </div>
            <!--.modal-content-->
        </div>
        <!--.modal-dialog-->
    </div><!--.modal-->

@endsection
@section('FooterScripts')
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"
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
                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });


        })

    </script>

    <script>
        $(function () {

            var db = {
                loadData: function (filter) {
                    var d = $.Deferred();
                    $.ajax({
                        type: "GET",
                        url: "{{url('/bid-profile/load-entry-list/'.$bid_profile_obj->id)}}",
                        dataType: "json"
                    }).success(function (result) {
                        result = $.grep(result, function (item) {
                            return (!filter.domain || item.domain.toLowerCase().indexOf(filter.domain.toLowerCase()) > -1)
                                    && (!filter.id || item.id == filter.id)
                                    && (!filter.bid_strategy || item.bid_strategy == filter.bid_strategy)
                        });
                        d.resolve(result);
                    });
                    return d.promise();
                },

                insertItem: function (insertingBidProfile) {
                    console.log(insertingBidProfile);
                    insertingBidProfile['oper'] = 'add';
                    insertingBidProfile['parent_id'] = '{{$bid_profile_obj->id}}';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/bid_profile_edit')}}",
                        data: insertingBidProfile,
                        dataType: "json"
                    }).done(function (response) {
                        $("#bid_profile_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });

                },

                updateItem: function (updatingBidProfile) {
                    updatingBidProfile['oper'] = 'edit';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/bid_profile_edit')}}",
                        data: updatingBidProfile,
                        dataType: "json"
                    }).done(function (response) {
                        $("#bid_profile_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });
                },
                deleteItem: function (deletingBidProfile) {
                    deletingBidProfile['oper'] = 'del';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/bid_profile_edit')}}",
                        data: deletingBidProfile,
                        dataType: "json"
                    }).done(function (response) {
                        $("#bid_profile_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });
                }


            };

            window.db = db;
            db.strategy = [
                {Name: "", Id: 0},
                {Name: "Absolute", Id: 1},
                {Name: "Percentage", Id: 2}
            ];

            $("#bid_profile_entry_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: true,
                sorting: true,
                paging: true,
                autoload: true,

                pageSize: 10,
                pageButtonCount: 5,
                onItemDeleting:function(){
                    alert('ss');
                },
                deleteConfirm: "Do you really want to delete the client?",

                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                    {name: "domain", title: "Domain", type: "text", width: 70},
                    {
                        name: "bid_strategy",
                        title: "Bid Strategy",
                        type: "select",
                        items: db.strategy,
                        valueField: "Id",
                        textField: "Name",
                        width: 60,
                        align: "center"
                    },
                    {name: "bid_value", title: "Bid Value", type: "text", width: 40, align: "center"},
                    {name: "updated_at", title: "Last Modified", width: 70, align: "center"},
                    {
                        name: "parent_id",
                        title: "Bid ID",
                        type: "text",
                        width: 40,
                        align: "center",
                        editing: false,
                        visible: false
                    },
                    {
                        type: "control",
                        modeSwitchButton: false,
                        editButton: false,
                        headerTemplate: function () {
                            return $("<button>").attr("type", "button").text("Add")
                                    .on("click", function () {
                                        showDetailsDialog("Add", {});
                                    });
                        }
                    }
                ]

            });
            $("#detailsForm").validate({
                rules: {
                    domain: {
                        required: true,
                        domain: true
                    }, bid_value: {
                        required: true,
                        min: 0,
                        max: 10
                    }, bid_value1: {
                        required: true,
                        min: 0,
                        max: 100
                    }
                },
                messages: {
                    domain: "Please enter Domain name"
                },
                submitHandler: function () {
                    formSubmitHandler();
                }
            });
            $('#bid_strategy').change(function () {
                if ($(this).val() == 'Absolute') {
                    $('#bid_value').show();
                    $('#bid_value1').hide();
                    $('.invalid').hide();
                } else {
                    $('#bid_value').hide();
                    $('#bid_value1').show();
                    $('.invalid').hide();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, bid_profile_entry) {

                formSubmitHandler = function () {
                    saveClient(bid_profile_entry, dialogType === "Add");
                };

                $('#defaultModal').modal('show');

            };

            var saveClient = function (bid_profile_entry, isNew) {
                $.extend(bid_profile_entry, {
                    domain: $("#domain").val(),
                    bid_strategy: $("#bid_strategy").val(),
                    bid_value: $("#bid_value").val(),
                    bid_value1: $("#bid_value1").val()
                });
                $("#domain").val('');
                $("#bid_strategy").val('');
                $("#bid_value").val('');
                $("#bid_value1").val('');

                $("#bid_profile_entry_grid").jsGrid(isNew ? "insertItem" : "updateItem", bid_profile_entry);

                $('#defaultModal').modal('hide');
            };

        });

    </script>

@endsection