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

    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="name">Name:</label>
                <input id="name" name="name" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="category">Category:</label>
                <input id="category" name="category" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="type">Type:</label>
                <input id="type" name="type" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="daily_limit">Daily Limit:</label>
                <input id="daily_limit" name="daily_limit" type="text"/>
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

        $(document).ready(function () {
            $.ajax({
                url: "{{url('ajax/getAllAudits')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.inventory, function (inventory) {
                            return (!filter.name || inventory.name.indexOf(filter.name) > -1)
                                    && (!filter.category || inventory.category.indexOf(filter.category) > -1)
                                    && (!filter.type || inventory.type.indexOf(filter.type) > -1)
                                    && (!filter.id || inventory.id.indexOf(filter.id) > -1);
                        });
                    },

                    insertItem: function (insertingInventory) {
                        insertingInventory['oper'] = 'add';
                        console.log(insertingInventory);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/inventory')}}",
                            data: insertingInventory,
                            dataType: "json"
                        }).done();

                    },

                    updateItem: function (updatingInventory) {
                        updatingInventory['oper'] = 'edit';
                        console.log(updatingInventory);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/inventory')}}",
                            data: updatingInventory,
                            dataType: "json"
                        });
                    }

                };

                window.db = db;

                db.inventory = [
                    @foreach($inventory as $index)
                    {
                        "id": '{{$index->id}}',
                        "name": '{{$index->name}}',
                        "category": '{{$index->category}}',
                        "type": '{{$index->type}}',
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/inventory/'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>'

                    },
                    @endforeach
                ];

                $("#inventory_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 10,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the inventory?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 20, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "category", title: "Category", type: "text", width: 70},
                        {name: "type", title: "Type", type: "text", width: 70},
                        {name: "date_modify", title: "Date of Modify", align: "center"},
                        {name: "action", title: "Full Action", sorting: false, width: 50, align: "center"},
                        {
                            type: "control",
                            modeSwitchButton: false,
                            editButton: false,
                            headerTemplate: function () {
                                return $("<button>").attr("type", "button").text("Add")
                                        .on("click", function () {
                                            showDetailsDialog("Add Inventory", {});
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

//                $("#detailsForm").validate({
//                    rules: {
//                        name: "required"
//                    },
//                    messages: {
//                        name: "Please enter name"
//                    },
//                    submitHandler: function() {
//                        formSubmitHandler();
//                    }
//                });

                var formSubmitHandler = $.noop;

                var showDetailsDialog = function (dialogType, inventory) {

                    formSubmitHandler = function () {
                        saveInventory(inventory, dialogType === "Add");
                    };

                    $("#detailsDialog").dialog("option", "title", dialogType + " Inventory")
                            .dialog("open");
                };

                var saveInventory = function (inventory, isNew) {
                    $.extend(inventory, {
                        name: $("#name").val(),
                        age: parseInt($("#age").val(), 10),
                        Address: $("#address").val(),
                        Country: parseInt($("#country").val(), 10),
                        Married: $("#married").is(":checked")
                    });

                    $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", inventory);

                    $("#detailsDialog").dialog("close");
                };
            });

        });
    </script>

@endsection
