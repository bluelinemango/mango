@extends('Layout')
@section('siteTitle')List Of {{\Illuminate\Support\Facades\Auth::user()->name}} Clients @endsection

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
                <li>Home</li>
                <li>Client List</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

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
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">
                            <!-- widget options:
                                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                        data-widget-colorbutton="false"
                                        data-widget-editbutton="false"
                                        data-widget-togglebutton="false"
                                        data-widget-deletebutton="false"
                                        data-widget-fullscreenbutton="false"
                                        data-widget-custombutton="false"
                                        data-widget-collapsed="true"
                                        data-widget-sortable="false"

                                        -->
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Client List</h2>
                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body">

                                    <!-- widget grid -->
                                    <section id="widget-grid" class="">

                                        <!-- row -->
                                        <div class="row">

                                            <!-- NEW WIDGET START -->
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                                <table id="jqgrid"></table>
                                                <div id="pjqgrid"></div>

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

    @foreach($permission as $per_obj)
        @if($per_obj->getPermission->name == 'ADD_CLIENT')
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <a href="{{url('client/add')}}" class="btn btn-default btn-sm"> <i class="splashy-check"></i> Add Client</a>
                </div>
            </div>
        @endif
    @endforeach
@endsection
@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{cdn('js/plugin/jqgrid/jquery.jqGrid.min.js')}}"></script>
    <script src="{{cdn('js/plugin/jqgrid/grid.locale-en.min.js')}}"></script>

    <script src="{{cdn('js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            pageSetUp();

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
                    add_advertiser: '<a href="{{url('client/cl'.$index->id.'/advertiser/add')}}">Add Advertiser </a>',
                    date_modify : '{{$index->updated_at}}',
                    action: '<a href="{{url('/client/cl'.$index->id.'/edit')}}">Edit</a>'

                },
                @endforeach
            ];

            jQuery("#jqgrid").jqGrid({
                data : jqgrid_data,
                datatype : "local",
                height : 'auto',
                colNames : ['Actions', 'ID', 'Name','# of Advertiser','Add Advertiser','Modify Date','Action'],
                colModel : [{
                    name : 'act',
                    index : 'act',
                    sortable : false
                }, {
                    name : 'id',
                    index : 'id'
                }, {
                    name : 'name',
                    index : 'name',
                    editable : true
                }, {
                    name : 'advertiser',
                    index : 'advertiser',
                    editable : false
                }, {
                    name : 'add_advertiser',
                    index : 'add_advertiser',
                    editable : false
                }, {
                    name : 'date_modify',
                    index : 'date_modify',
                    editable : false
                }, {
                    name : 'action',
                    index : 'action',
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

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    },
                    advertiser_id : {
                        required : true
                    },
                    max_impression : {
                        required : true
                    },
                    daily_max_impression : {
                        required : true
                    },
                    max_budget : {
                        required : true
                    },
                    daily_max_budget : {
                        required : true
                    },
                    cpm : {
                        required : true
                    },
                    start_date : {
                        required : true
                    },
                    end_date : {
                        required : true
                    },
                    cpm : {
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
