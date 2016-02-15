@extends('Layout')
@section('siteTitle')List Of {{\Illuminate\Support\Facades\Auth::user()->name}} Clients @endsection
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
                <li>Client List</li>
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
                        <div class="well" >
                            <header>
                                <h2>Client List</h2>
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

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-heading">
                                                        <h2 class="pull-left">Activities</h2>
                                                        <select id="audit_status" class="pull-right">
                                                            <option value="entity">This Entity</option>
                                                            <option value="all">All</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                        <div class="clearfix"></div>
                                                        <small>All Activities for this Entity </small>
                                                    </div>
                                                    <div class="card-body" >
                                                        <div class="streamline b-l b-accent m-b" id="show_audit">
                                                        </div>
                                                    </div>
                                                </div>
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
                <label for="status">Is Active</label>
                <input id="status" name="status" type="checkbox" />
            </div>
            <div class="details-form-field">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('FooterScripts')
    {{--<script src="{{cdn('js/plugin/jqgrid/jquery.jqGrid.min.js')}}"></script>--}}
{{--    <script src="{{cdn('js/plugin/jqgrid/grid.locale-en.min.js')}}"></script>--}}
    {{--////////////////////////////////////////////////////////////////////////--}}
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
            if($(this).val()=='all'){
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }else if($(this).val()=='entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/client')}}"
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
    </script>
    <script> //NEW JS GRID
        $(function() {

            var db = {

                loadData: function(filter) {
                    return $.grep(this.clients, function(client) {
                        return (!filter.Name || client.Name.indexOf(filter.Name) > -1);
                    });
                },

                insertItem: function(insertingClient) {
                    insertingClient['oper']='add';
                    console.log(insertingClient);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/client')}}",
                        data: insertingClient,
                        dataType: "json"
                    }).done(function (response) {
                        console.log(response);
                        if(response.success==true){
                            var title= "Success";
                            var color="#739E73";
                            var icon="fa fa-check";
                        }else if(response.success==false) {
                            var title= "Warning";
                            var color="#C46A69";
                            var icon="fa fa-bell";
                        };

                        $.smallBox({
                            title: title,
                            content: response.msg,
                            color: color,
                            icon: icon,
                            timeout: 8000
                        });
                    });

                },

                updateItem: function(updatingClient) {
                    updatingClient['oper']='edit';
                    console.log(updatingClient) ;
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/client')}}",
                        data: updatingClient,
                        dataType: "json"
                    });
                },

                deleteItem: function(deletingClient) {
                    var clientIndex = $.inArray(deletingClient, this.clients);
                    this.clients.splice(clientIndex, 1);
                }

            };

            window.db = db;

            db.clients = [
                @foreach($clients as $index)
                {
                    "id" : '{{$index->id}}',
                    "name" : '{{$index->name}}',
                    @if(count($index->getAdvertiser)>0)
                    "advertiser": '{{$index->getAdvertiser[0]->client_count}}',
                    @else
                    "advertiser": '0',
                    @endif
                    "date_modify" : '{{$index->updated_at}}',
                    "action": '<a class="btn" href="{{url('/client/cl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /> </a> |'@if(in_array('ADD_EDIT_ADVERTISER',$permission)) +' <a class="btn txt-color-white" href="{{url('client/cl'.$index->id.'/advertiser/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

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

                deleteConfirm: "Do you really want to delete the client?",

                controller: db,
                fields: [
                    { name: "id",title: "ID", width: 40, type: "text",align :"center",editing:false },
                    { name: "name",title: "Name", type: "text", width: 150 },
                    { name: "advertiser",title: "#Advertiser", width: 50,editing:false,align :"center" },
                    { name: "date_modify" ,title:"Last Modified",align :"center"},
                    { name: "action", title: "Edit | +Advertiser", sorting: false,width: 70,align :"center" },
                    {
                        type: "control",
                        modeSwitchButton: false,
                        editButton: false,
                        headerTemplate: function() {
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

            var showDetailsDialog = function(dialogType, client) {

                formSubmitHandler = function() {
                    saveClient(client, dialogType === "Add");
                };

                $("#detailsDialog").dialog("option", "title", dialogType + " Client")
                        .dialog("open");
            };

            var saveClient = function(client, isNew) {
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
        $(document).ready(function() {
            pageSetUp();
            $.ajax({
                url: "{{url('ajax/getAudit/client')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            var jqgrid_data = [
                @foreach($clients as $index)
                {
                    id : '{{$index->id}}',
                    name : '{{$index->name}}',
                    @if(count($index->getAdvertiser)>0)
                    advertiser: '{{$index->getAdvertiser[0]->client_count}}',
                    @else
                    advertiser: '0',
                    @endif
                    @if(in_array('ADD_EDIT_ADVERTISER',$permission))
                    add_advertiser: '<a class="btn bg-color-magenta txt-color-white" href="{{url('client/cl'.$index->id.'/advertiser/add')}}">Add Advertiser </a>',
                    @endif
                    date_modify : '{{$index->updated_at}}',
                    action: '<a class="btn btn-info" href="{{url('/client/cl'.$index->id.'/edit')}}"><i class="fa fa-edit "></i></a>'

                },
                @endforeach
            ];

            jQuery("#jqgrid").jqGrid({
                data : jqgrid_data,
                datatype : "local",
                height : 'auto',
                colNames : ['Actions', 'ID', 'Name','# of Advertiser',@if(in_array('ADD_EDIT_ADVERTISER',$permission))'Add Advertiser',@endif 'Modify Date','Action'],
                colModel : [{
                    name : 'act',
                    index : 'act',
                    width :'100%',
                    sortable : false
                }, {
                    name : 'id',
                    index : 'id',
                    width :'30%'
                }, {
                    name : 'name',
                    index : 'name',
                    width :'99%',
                    editable : true
                }, {
                    name : 'advertiser',
                    index : 'advertiser',
                    width :'100%',
                    editable : false
                }@if(in_array('ADD_EDIT_ADVERTISER',$permission)), {
                    name : 'add_advertiser',
                    index : 'add_advertiser',
                    width :'100%',
                    editable : false
                }@endif, {
                    name : 'date_modify',
                    index : 'date_modify',
                    width :'100%',
                    editable : false
                }, {
                    name : 'action',
                    index : 'action',
                    width :'50%',
                    editable : false
                }],
                rowNum : 10,
                rowList : [10, 20, 30],
                pager : '#pjqgrid',
                sortname : 'advertiser',
                ajaxRowOptions: { async: true },
                toolbarfilter : true,
                viewrecords : true,
                sortorder : "desc",
                gridComplete : function() {
                    var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                    for (var i = 0; i < ids.length; i++) {
                        var cl = ids[i];
                        be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                        se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                        ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
//                        ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
//                        jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                        jQuery("#jqgrid").jqGrid('setRowData', ids[i], {
                            act : be + se + ca
                        });
                    }
                },
                editurl : "{{url('/ajax/jqgrid/client')}}",
                caption : "Clients List",
                multiselect : true,
                autowidth : true

            });
//            jQuery('#jqgrid').jqGrid('clearGridData');
//            jQuery('#jqgrid').jqGrid('setGridParam', {data: [{id:2,name:"sss"},{id:3,name:"ddd"}]});
//            jQuery('#jqgrid').trigger('reloadGrid');


            jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {
                edit : false,
                add : true,
                del : true
            },{
                afterSubmit:function(response)
                {
                },
                closeAfterAdd: true,
                closeAfterEdit: true,
                reloadAfterSubmit:true
            },{
                afterSubmit:function(response)
                {
                    var data = JSON.parse(response['responseText']);
                    var id = data[0].id;
                    var name=String(data[0].name);
                    $("#jqgrid").addRowData(id,{ id: + id ,name:name ,add_advertiser:'<a href="client/cl' + id + '/advertiser/add">Add Advertiser </a>',date_modify:data[0].updated_at,advertiser:'0' }, 'first');
                    $("#jqgrid").trigger("reloadGrid");
                },
                closeAfterAdd: true,
                closeAfterEdit: true,
                reloadAfterSubmit:true
            },{
                closeAfterAdd: true,
                closeAfterEdit: true,
                reloadAfterSubmit:true
            });
            jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");
            /* Add tooltips */
            $('.navtable .ui-pg-button').tooltip({
                container : 'body'
            });

            jQuery("#m1").click(function() {
                var s;
                s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
                alert(s);
            });
            jQuery("#m1s").click(function() {
                jQuery("#jqgrid").jqGrid('setSelection', "13");
            });

            // remove classes
            $(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
            $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
            $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
            $(".ui-jqgrid-pager").removeClass("ui-state-default");
            $(".ui-jqgrid").removeClass("ui-widget-content");

            // add classes
            $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
            $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");

            $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
            $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
            $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
            $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
            $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
            $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
            $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
            $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

            $(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
            $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

            $(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
            $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

            $(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
            $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

            $(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
            $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");
        })

    </script>

@endsection
