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
            <div class="panel-heading">
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

    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="domain">Domain:</label>
                <input id="domain" name="domain" type="text"/>
            </div>
            <div class="details-form-field">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>
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

                loadData: function (filter) {
                    return $.grep(this.geosegment_entry, function (geosegment_entry) {
                        return (!filter.name || geosegment_entry.name.indexOf(filter.name) > -1)
                                && (!filter.id || geosegment_entry.id.indexOf(filter.id) > -1)
                                && (!filter.lat || geosegment_entry.lat.indexOf(filter.lat) > -1)
                                && (!filter.lon || geosegment_entry.lon.indexOf(filter.lon) > -1)
                                && (!filter.segment_radius || geosegment_entry.segment_radius.indexOf(filter.segment_radius) > -1);
                    });
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
                        $.smallBox({
                            title: title,
                            content: response.msg,
                            color: color,
                            icon: icon,
                            timeout: 8000
                        });
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
            db.geosegment_entry = [

                @foreach($geosegment_obj->getGeoEntries as $index)
                {
                    "id": 'bwe{{$index->id}}',
                    "name": '{{$index->name}}',
                    "lat": '{{$index->lat}}',
                    "lon": '{{$index->lon}}',
                    "segment_radius": '{{$index->segment_radius}}',
                    "date_modify": '{{$index->updated_at}}',
                    "parent_id": '{{$geosegment_obj->id}}'
                },
                @endforeach
            ];

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
                    {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
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
            $("#detailsDialog").dialog({
                autoOpen: false,
                width: 400,
                close: function () {
                    $("#detailsForm").validate().resetForm();
                    $("#detailsForm").find(".error").removeClass("error");
                }
            });
            $("#detailsForm").validate({
                rules: {
                    domain: {
                        required: true,
                        domain: true
                    }
                },
                messages: {
                    domain: "Please enter Domain name"
                },
                submitHandler: function () {
                    formSubmitHandler();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, bid_profile_entry) {

                formSubmitHandler = function () {
                    saveClient(bid_profile_entry, dialogType === "Add");
                };

                $("#detailsDialog").dialog("option", "title", dialogType + " Bid Profile Entry")
                        .dialog("open");
            };

            var saveClient = function (bid_profile_entry, isNew) {
                $.extend(bid_profile_entry, {
                    domain: $("#domain").val()
                });

                $("#bid_profile_entry_grid").jsGrid(isNew ? "insertItem" : "updateItem", bid_profile_entry);

                $("#detailsDialog").dialog("close");
            };

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            FormsSwitch.init();
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