@extends('Layout1')
@section('siteTitle')List Of {{\Illuminate\Support\Facades\Auth::user()->name}} Clients @endsection
@section('content')
    <div class="col-md-9">
        <div class="panel light-blue">
            <div class="panel-heading">
                <div class="panel-title"><h4>Client List</h4></div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body">
                <div id="client_grid"></div>
            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div><!--.col-->
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


    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="name">Name:</label>
                <input id="name" name="name" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="status">Is Active</label>
                <input id="status" name="status" type="checkbox"/>
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

                loadData: function (filter) {
                    return $.grep(this.clients, function (client) {
                        return (!filter.Name || client.Name.indexOf(filter.Name) > -1);
                    });
                },

                insertItem: function (insertingClient) {
                    insertingClient['oper'] = 'add';
                    console.log(insertingClient);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/client')}}",
                        data: insertingClient,
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

                updateItem: function (updatingClient) {
                    updatingClient['oper'] = 'edit';
                    console.log(updatingClient);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/client')}}",
                        data: updatingClient,
                        dataType: "json"
                    });
                },

                deleteItem: function (deletingClient) {
                    var clientIndex = $.inArray(deletingClient, this.clients);
                    this.clients.splice(clientIndex, 1);
                }

            };

            window.db = db;

            db.clients = [
                @foreach($clients as $index)
                {
                    "id": '{{$index->id}}',
                    "name": '{{$index->name}}',
                    @if(count($index->getAdvertiser)>0)
                    "advertiser": '{{$index->getAdvertiser[0]->client_count}}',
                    @else
                    "advertiser": '0',
                    @endif
                    "date_modify": '{{$index->updated_at}}',
                    "action": '<a class="btn" href="{{url('/client/cl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /> </a> |'@if(in_array('ADD_EDIT_ADVERTISER',$permission)) + ' <a class="btn txt-color-white" href="{{url('client/cl'.$index->id.'/advertiser/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif


                },
                @endforeach
            ];

            $("#client_grid").jsGrid({
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
                    {name: "id", title: "ID", width: 40, type: "text", align: "center", editing: false},
                    {name: "name", title: "Name", type: "text", width: 150},
                    {name: "advertiser", title: "#Advertiser", width: 50, editing: false, align: "center"},
                    {name: "date_modify", title: "Last Modified", align: "center"},
                    {name: "action", title: "Edit | +Client", sorting: false, width: 70, align: "center"},
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

//            $("#detailsForm").validate({
//                rules: {
//                    name: "required"
//                },
//                messages: {
//                    name: "Please enter name"
//                },
//                submitHandler: function() {
//                    formSubmitHandler();
//                }
//            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, client) {

                formSubmitHandler = function () {
                    saveClient(client, dialogType === "Add");
                };

                $("#detailsDialog").dialog("option", "title", dialogType + " Client")
                        .dialog("open");
            };

            var saveClient = function (client, isNew) {
                $.extend(client, {
                    name: $("#name").val(),
                    age: parseInt($("#age").val(), 10),
                    Address: $("#address").val(),
                    Country: parseInt($("#country").val(), 10),
                    Married: $("#married").is(":checked")
                });

                $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", client);

                $("#detailsDialog").dialog("close");
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
