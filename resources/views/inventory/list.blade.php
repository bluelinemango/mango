@extends('Layout')
@section('siteTitle')List Of Inventory @endsection
@section('header_extra')
    <style>
        .ui-widget *, .ui-widget input, .ui-widget select, .ui-widget button  {
            font-family: inherit;
            font-size: 14px;
            font-weight: 300 !important;
        }

        .details-form-field input,
        .details-form-field select {
            width: 250px;
            float: right;
        }

        .details-form-field {
            margin: 30px 0;
        }

        .details-form-field:first-child {
            margin-top: 10px;
        }

        .details-form-field:last-child {
            margin-bottom: 10px;
        }

        .details-form-field button {
            display: block;
            width: 100px;
            margin: 0 auto;
        }

        input.error, select.error {
            border: 1px solid #ff9999;
            background: #ffeeee;
        }

        label.error {
            float: right;
            margin-left: 100px;
            font-size: .8em;
            color: #ff6666;
        }
    </style>
@endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Inventory List</li>
            </ol>

        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">


            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="well" id="wid-id-3" >
                            <header>
                                <h2>Inventory List</h2>
                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget content -->
                                <div class="">

                                    <!-- widget grid -->
                                    <section id="widget-grid" class="">

                                        <!-- row -->
                                        <div class="row">

                                            <!-- NEW WIDGET START -->
                                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                                                <div id="jsGrid"></div>
                                                {{--<table id="jqgrid"></table>--}}
                                                {{--<div id="pjqgrid"></div>--}}

                                            </div>
                                            <!-- WIDGET END -->

                                        </div>

                                        <!-- end row -->

                                    </section>
                                    <!-- end widget grid -->

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->

                </div>

                <!-- end row -->

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->


    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="name">Name:</label>
                <input id="name" name="name" type="text" />
            </div>
            <div class="details-form-field">
                <label for="category">Category:</label>
                <input id="category" name="category" type="text" />
            </div>
            <div class="details-form-field">
                <label for="type">Type:</label>
                <input id="type" name="type" type="text" />
            </div>
            <div class="details-form-field">
                <label for="daily_limit">Daily Limit:</label>
                <input id="daily_limit" name="daily_limit" type="text" />
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
        $(document).ready(function() {
            pageSetUp();

            $(function() {

                var db = {

                    loadData: function(filter) {
                        return $.grep(this.inventory, function(inventory) {
                            return (!filter.name || inventory.name.indexOf(filter.name) > -1);
                        });
                    },

                    insertItem: function(insertingInventory) {
                        insertingInventory['oper']='add';
                        console.log(insertingInventory);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/inventory')}}",
                            data: insertingInventory,
                            dataType: "json"
                        }).done();

                    },

                    updateItem: function(updatingInventory) {
                        updatingInventory['oper']='edit';
                        console.log(updatingInventory) ;
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
                        "id" : '{{$index->id}}',
                        "name" : '{{$index->name}}',
                        "category" : '{{$index->category}}',
                        "type" : '{{$index->type}}',
                        "date_modify" : '{{$index->updated_at}}',
                        "action": '<a class="btn btn-info" href="{{url('/inventory/'.$index->id.'/edit')}}"><i class="fa fa-edit "></i></a>'

                    },
                    @endforeach
                ];

                $("#jsGrid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the inventory?",

                    controller: db,
                    fields: [
                        { name: "id",title: "ID", width: 20,align :"center" },
                        { name: "name",title: "Name", type: "text", width: 70 },
                        { name: "category",title: "Category", type: "text", width: 70 },
                        { name: "type",title: "Type", type: "text", width: 70 },
                        { name: "date_modify" ,title:"Date of Modify",align :"center"},
                        { name: "action", title: "Full Action", sorting: false,width: 50,align :"center" },
                        {
                            type: "control",
                            modeSwitchButton: false,
                            editButton: false,
                            headerTemplate: function() {
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
                    close: function() {
                        $("#detailsForm").validate().resetForm();
                        $("#detailsForm").find(".error").removeClass("error");
                    }
                });

                $("#detailsForm").validate({
                    rules: {
                        name: "required"
                    },
                    messages: {
                        name: "Please enter name"
                    },
                    submitHandler: function() {
                        formSubmitHandler();
                    }
                });

                var formSubmitHandler = $.noop;

                var showDetailsDialog = function(dialogType, inventory) {

                    formSubmitHandler = function() {
                        saveInventory(inventory, dialogType === "Add");
                    };

                    $("#detailsDialog").dialog("option", "title", dialogType + " Inventory")
                            .dialog("open");
                };

                var saveInventory = function(inventory, isNew) {
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
