@extends('Layout1')
@section('siteTitle')List Of {{\Illuminate\Support\Facades\Auth::user()->name}} Clients @endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
            </div>
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Client List</h4></div>
                <div id="client_grid"></div>
            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div><!--.col-->
    <div class="col-md-3">
        <div class="panel gray">
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


    <div class="modal scale fade" id="defaultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailsForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Client</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row example-row">
                            <div class="col-md-3">Name</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Client Name">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <!--.row-->
                        <div class="row example-row">
                            <div class="col-md-3">Active</div><!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="switcher">
                                    <input id="active" name="active" type="checkbox" hidden="hidden">
                                    <label for="active"></label>
                                </div><!--.switcher-->
                            </div><!--.col-md-9-->
                        </div><!--.row-->

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

    </script>
    <script>
        $('#audit_status').change(function () {
            if ($(this).val() == 'all') {
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            } else if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/client')}}"
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
    </script>
    <script> //NEW JS GRID
        $(function () {

            var db = {
                loadData: function(filter) {
                    var d = $.Deferred();
                     $.ajax({
                        type: "POST",
                        url: "{{url('/client/load-json-list')}}",
                        data: filter,
                        dataType: "json"
                    }).success(function(result) {
                         result = $.grep(result, function(item) {
                             return (!filter.name || item.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                             && (!filter.id || item.id == filter.id );
                         });
                         d.resolve(result);
                    });
                    return d.promise();
                },
//                loadData: function (filter) {
//                    return $.grep(this.clients, function (client) {
//                        return (!filter.name || client.name.indexOf(filter.name) > -1)
//                        && (!filter.id || client.id.indexOf(filter.id) > -1);
//                    });
//                },

                insertItem: function (insertingClient) {
                    insertingClient['oper'] = 'add';
                    console.log(insertingClient);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/client')}}",
                        data: insertingClient,
                        dataType: "json"
                    }).done(function (response) {
                        $("#client_grid").jsGrid("render");
                        console.log(response);
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/client')}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });

                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });
                },

                updateItem: function (updatingClient) {
                    updatingClient['oper'] = 'edit';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/client')}}",
                        data: updatingClient,
                        dataType: "json"
                    }).done(function(response){
                        $("#client_grid").jsGrid("render");
                        console.log(response);
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/client')}}"
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


            $("#client_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: true,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 10,
                controller: db,
                pageButtonCount: 5,

                fields: [
                    {name: "id", title: "ID", width: 40, type: "text", align: "center", editing: false},
                    {name: "name", title: "Name", type: "text", width: 150},
                    {name: "advertiser", title: "#Advertiser", width: 50, editing: false, align: "center"},
                    {name: "status", title: "Status", width: 50, align: "center",editing: false},
                    {name: "updated_at", title: "Last Modified", align: "center"},
                    {name: "action", title: "Edit | +Advertiser", sorting: false, width: 70, align: "center"},
                    {
                        type: "control",
                        deleteButton: false,
                        editButtonTooltip: "Edit",
                        editButton: true,
                        modeSwitchButton: false,
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
                    name: "required"
                },
                messages: {
                    name: "Please enter name"
                },
                submitHandler: function () {
                    formSubmitHandler();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, client) {

                formSubmitHandler = function () {
                    saveClient(client, dialogType === "Add");
                };
                $('#defaultModal').modal('show');
//                $("#detailsDialog").dialog("option", "title", dialogType + " Client")
//                        .dialog("open");
            };

            var saveClient = function (client, isNew) {
                $.extend(client, {
                    name: $("#name").val(),
                    active: $("#active").is(":checked")
                });
                console.log(client);
                $("#name").val('');
                $("#client_grid").jsGrid(isNew ? "insertItem" : "updateItem", client);
                $('#defaultModal').modal('hide');
//                $("#detailsDialog").dialog("close");
            };
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: "{{url('ajax/getAudit/client')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

        });
    </script>

@endsection
