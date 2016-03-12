@extends('Layout1')
@section('siteTitle')List Of Inventory @endsection
@section('header_extra')
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
            </div>
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Inventory List</h4></div>
                <div id="inventory_grid"></div>
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
                        <h4 class="modal-title">Add Inventory</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row example-row">
                            <div class="col-md-3">Name</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Inventory Name">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Category</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="category" name="category" class="form-control"
                                               placeholder="category">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Type</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="type" name="type" class="form-control"
                                               placeholder="Type">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <div class="row example-row">
                            <div class="col-md-3">Daily Limit</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="daily_limit" name="daily_limit" class="form-control"
                                               placeholder="Daily Limit">
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

    <script type="text/javascript">

        $('#audit_status').change(function () {
            if ($(this).val() == 'all') {
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
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

                loadData: function(filter) {
                    var d = $.Deferred();
                    $.ajax({
                        type: "POST",
                        url: "{{url('/inventory/load-list')}}",
                        data: filter,
                        dataType: "json"
                    }).success(function(result) {
                        result = $.grep(result, function(item) {
                            return (!filter.name || item.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    &&(!filter.category || item.category.toLowerCase().indexOf(filter.category.toLowerCase()) > -1)
                                    &&(!filter.type || item.type.toLowerCase().indexOf(filter.type.toLowerCase()) > -1)
                                    && (!filter.id || item.id ==filter.id );
                        });
                        d.resolve(result);
                    });
                    return d.promise();
                },

                insertItem: function (insertingInventory) {
                    insertingInventory['oper'] = 'add';
                    console.log(insertingInventory);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/inventory')}}",
                        data: insertingInventory,
                        dataType: "json"
                    }).done(function (response) {
                        $("#inventory_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/inventory')}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });
                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }

                    });

                },

                updateItem: function (updatingInventory) {
                    updatingInventory['oper'] = 'edit';
                    console.log(updatingInventory);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/inventory')}}",
                        data: updatingInventory,
                        dataType: "json"
                    }).done(function (response) {
                        $("#inventory_grid").jsGrid("render");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/inventory')}}"
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

            $("#inventory_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: true,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 10,
                pageButtonCount: 5,
                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 20, align: "center", editing: false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "category", title: "Category", type: "text", width: 70},
                    {name: "type", title: "Type", type: "text", width: 70},
                    {name: "status", title: "Status", width: 50, align: "center",editing: false},
                    {name: "updated_at", title: "Date of Modify", align: "center"},
                    {name: "action", title: "Full Action", sorting: false, width: 50, align: "center"},
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
                    name: "required",
                    category: "required",
                    type: "required",
                    daily_limit: "required"
                },
                messages: {
                    name: "Please enter name"
                },
                submitHandler: function () {
                    formSubmitHandler();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, inventory) {

                formSubmitHandler = function () {
                    saveInventory(inventory, dialogType === "Add");
                };

                $('#defaultModal').modal('show');
            };

            var saveInventory = function (inventory, isNew) {
                $.extend(inventory, {
                    name: $("#name").val(),
                    category: $("#category").val(),
                    type: $("#type").val(),
                    daily_limit: $("#daily_limit").val(),
                    active: $("#active").is(":checked")
                });
                $("#name").val('');
                $("#category").val('');
                $("#type").val('');
                $("#daily_limit").val('');
                $("#inventory_grid").jsGrid(isNew ? "insertItem" : "updateItem", inventory);
                $('#defaultModal').modal('hide');

            };
        });


        $(document).ready(function () {
            $.ajax({
                url: "{{url('ajax/getAllAudits')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });


        });
    </script>

@endsection
