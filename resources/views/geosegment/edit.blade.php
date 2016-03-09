@extends('Layout1')
@section('siteTitle')Edit Geo Segment List: {{$geosegment_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$geosegment_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client : cl{{$geosegment_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$geosegment_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$geosegment_obj->advertiser_id.'/edit/')}}">Advertiser : adv{{$geosegment_obj->getAdvertiser->id}}</a>
        </li>
        <li><a href="#" class="active">Geo Segment: gsm{{$geosegment_obj->id}}</a></li>
    </ol>
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Geo Segment list edit: {{$geosegment_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">
                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('geosegmentlist_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="geosegmentlist_id" value="{{$geosegment_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$geosegment_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$geosegment_obj->getAdvertiser->name}}</h5>

                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$geosegment_obj->getAdvertiser->GetClientID->name}}</h5>

                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="">Last Modified</label>
                                <h5>{{$geosegment_obj->updated_at}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="checkboxer">
                                        <input type="checkbox" name="active"
                                               class="switchery-teal" @if($geosegment_obj->status=='Active')
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
                    <h4>Geo Segment list Entry </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body">
                <div id="geosegment_entry_grid"></div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="modal scale fade" id="defaultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailsForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Geo Segment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row example-row">
                            <div class="col-md-3">Name</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="domain_name" name="domain_name" class="form-control"
                                               placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Lat</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="lat" name="lat" class="form-control"
                                               placeholder="Lat">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Lon</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="lon" name="lon" class="form-control"
                                               placeholder="Lon">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Radius</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="segment_radius" name="segment_radius" class="form-control"
                                               placeholder="Radius">
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {

            var db = {

                loadData: function(filter) {
                    var d = $.Deferred();
                    $.ajax({
                        type: "GET",
                        url: "{{url('/geosegment/load-entry-list/'.$geosegment_obj->id)}}" ,
                        dataType: "json"
                    }).success(function(result) {
                        result = $.grep(result, function(item) {
                            return (!filter.name || item.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.id || item.id == filter.id)
                                    && (!filter.lat || item.lat== filter.lat)
                                    && (!filter.lon || item.lon==filter.lon)
                                    && (!filter.segment_radius || item.segment_radius== filter.segment_radius);
                        });
                        d.resolve(result);
                    });
                    return d.promise();
                },

                insertItem: function (insertingGeosegemnt_entry) {
                    console.log(insertingGeosegemnt_entry);
                    insertingGeosegemnt_entry['oper'] = 'add';
                    insertingGeosegemnt_entry['parent_id'] = '{{$geosegment_obj->id}}';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/geosegment_edit')}}",
                        data: insertingGeosegemnt_entry,
                        dataType: "json"
                    }).done(function (response) {
                        $("#geosegment_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/geosegment/'.$geosegment_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });

                },

                updateItem: function (updatingGeosegmentEntry) {
                    updatingGeosegmentEntry['oper'] = 'edit';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/geosegment_edit')}}",
                        data: updatingGeosegmentEntry,
                        dataType: "json"
                    }).done(function (response) {
                        $("#geosegment_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/geosegment/'.$geosegment_obj->id)}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });
                },
                deleteItem: function (updatingGeosegmentEntry) {
                    updatingGeosegmentEntry['oper'] = 'del';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/geosegment_edit')}}",
                        data: updatingGeosegmentEntry,
                        dataType: "json"
                    }).done(function (response) {
                        $("#geosegment_entry_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/geosegment/'.$geosegment_obj->id)}}"
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

            $("#geosegment_entry_grid").jsGrid({
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
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "lat", title: "Lat", type: "text", width: 70},
                    {name: "lon", title: "Lon", type: "text", width: 70},
                    {name: "segment_radius", title: "Segment Radius", type: "text", width: 70},
                    {name: "updated_at", title: "Last Modified", width: 70, align: "center"},
                    {
                        name: "parent_id",
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
                    },
                    lat: "required",
                    lon: "required",
                    segment_radius: "required"

                },
                messages: {
                    domain_name: "Please enter Domain name"
                },
                submitHandler: function () {
                    formSubmitHandler();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, geosegment_entry) {

                formSubmitHandler = function () {
                    saveClient(geosegment_entry, dialogType === "Add");
                };

                $('#defaultModal').modal('show');
            };

            var saveClient = function (geosegment_entry, isNew) {
                $.extend(geosegment_entry, {
                    name: $("#domain_name").val(),
                    lat: $("#lat").val(),
                    lon: $("#lon").val(),
                    segment_radius: $("#radius").val()
                });
                $("#domain_name").val('');
                $("#lat").val('');
                $("#lon").val('');
                $("#segment_radius").val('');

                $("#geosegment_entry_grid").jsGrid(isNew ? "insertItem" : "updateItem", geosegment_entry);
                $('#defaultModal').modal('hide');
            };

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            FormsSwitchery.init();

            $.ajax({
                url: "{{url('ajax/getAudit/geosegment/'.$geosegment_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if($(this).val()=='all'){
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }else if($(this).val()=='entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/geosegment/'.$geosegment_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }else if($(this).val()=='user') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/user')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    }
                },

                // Messages for form validation
                messages : {
                    name : {
                        required : 'Please enter your name'
                    },
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    phone : {
                        required : 'Please enter your phone number'
                    },
                    interested : {
                        required : 'Please select interested service'
                    },
                    budget : {
                        required : 'Please select your budget'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });

        })

    </script>

@endsection