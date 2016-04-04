@extends('Layout1')
@section('siteTitle')Edit B/W List: {{$bwlist_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$bwlist_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client :
                cl{{$bwlist_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$bwlist_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$bwlist_obj->advertiser_id.'/edit/')}}">Advertiser
                : adv{{$bwlist_obj->getAdvertiser->id}}</a>
        </li>
        <li><a href="#" class="active">B/W List Editing : bwl{{$bwlist_obj->id}}</a></li>
    </ol>
@endsection

@section('content')

    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Edit Black / White : {{$bwlist_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">
                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('bwlist_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="bwlist_id" value="{{$bwlist_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$bwlist_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$bwlist_obj->getAdvertiser->name}}</h5>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$bwlist_obj->getAdvertiser->GetClientID->name}}</h5>

                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="">Last Modified</label>
                                <h5>{{$bwlist_obj->updated_at}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"> Black / White Type</label>

                                    <select name="list_type" class="selecter">
                                        <option value="black" @if($bwlist_obj->list_type == 'black') selected @endif>
                                            Black List
                                        </option>
                                        <option value="white" @if($bwlist_obj->list_type == 'white') selected @endif>
                                            White List
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="switcher">
                                        <input type="checkbox" name="active"
                                               hidden @if($bwlist_obj->status=='Active')
                                               checked @endif id="active">
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
                                <button type="submit" class="btn btn-success" style="width:20%">Submit</button>
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


    <div class="col-md-6">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Black / White list Entry </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body">
                <div id="bwlist_entry_grid"></div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="modal scale fade" id="defaultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailsForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Entry</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row example-row">
                            <div class="col-md-3">Domain</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="domain_name" name="domain_name" class="form-control"
                                               placeholder="Domain">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>

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
        $(function () {

            var db = {

                loadData: function(filter) {
                    var d = $.Deferred();
                    $.ajax({
                        type: "GET",
                        url: "{{url('/bwlist/load-entry-list/'.$bwlist_obj->id)}}" ,
                        dataType: "json"
                    }).success(function(result) {
                        result = $.grep(result, function(item) {
                            return (!filter.domain_name || item.domain_name.toLowerCase().indexOf(filter.domain_name.toLowerCase()) > -1)
                                    && (!filter.id || item.id == filter.id);
                        });
                        d.resolve(result);
                    });
                    return d.promise();
                },

                insertItem: function (insertingbwlist_entry) {
                    console.log(insertingbwlist_entry);
                    insertingbwlist_entry['oper'] = 'add';
                    insertingbwlist_entry['parent_id'] = '{{$bwlist_obj->id}}';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/bwlist_entriy')}}",
                        data: insertingbwlist_entry,
                        dataType: "json"
                    }).done(function (response) {
                        $("#bwlist_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/bwlist/'.$bwlist_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });

                },

                updateItem: function (updatingBWlistEntry) {
                    updatingBWlistEntry['oper'] = 'edit';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/bwlist_entriy')}}",
                        data: updatingBWlistEntry,
                        dataType: "json"
                    }).done(function (response) {
                        $("#bwlist_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/bwlist/'.$bwlist_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });
                },
                deleteItem: function (updatingBWlistEntry) {
                    updatingBWlistEntry['oper'] = 'del';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/bwlist_entriy')}}",
                        data: updatingBWlistEntry,
                        dataType: "json"
                    }).done(function (response) {
                        $("#bwlist_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/bwlist/'.$bwlist_obj->id)}}"
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

            $("#bwlist_entry_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: true,
                sorting: true,
                paging: true,
                autoload: true,

                pageSize: 10,
                pageButtonCount: 5,
                deleteConfirm: "Do you really want to delete the client?",
                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                    {name: "domain_name", title: "Domain", type: "text", width: 70},
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
                    domain_name: {
                        required: true,
                        domain: true
                    }
                },
                messages: {
                    domain_name: "Please enter Domain name"
                },
                submitHandler: function () {
                    formSubmitHandler();
                }
            });
            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, bw_entry) {

                formSubmitHandler = function () {
                    saveClient(bw_entry, dialogType === "Add");
                };
                $('#defaultModal').modal('show');

            };

            var saveClient = function (bw_entry, isNew) {
                $.extend(bw_entry, {
                    domain_name: $("#domain_name").val()
                });
                $("#domain_name").val('');

                $("#bwlist_entry_grid").jsGrid(isNew ? "insertItem" : "updateItem", bw_entry);

                $('#defaultModal').modal('hide');
            };

        });
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {



            $.ajax({
                url: "{{url('ajax/getAudit/bwlist/'.$bwlist_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/bwlist/'.$bwlist_obj->id)}}"
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