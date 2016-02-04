@extends('Layout')
@section('siteTitle')Edit Geo Segment List: {{$geosegment_obj->name}} @endsection
@section('header_extra')
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/your_style.css')}}">
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
                <li><a href="{{url('/client/cl'.$geosegment_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client : cl{{$geosegment_obj->getAdvertiser->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$geosegment_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$geosegment_obj->advertiser_id.'/edit/')}}">Advertiser : adv{{$geosegment_obj->getAdvertiser->id}}</a></li>
                <li>Geo Segment List Editing</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:
                        <span class="ribbon-button-alignment pull-right">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
            </span>

    -->

        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            @if(Session::has('CaptchaError'))
                <ul>
                    <li>{{Session::get('CaptchaError')}}</li>
                </ul>
                @endif
                        <!-- widget grid -->
                <section id="widget-grid" class="">
                    <!-- START ROW -->
                    <div class="row">
                        <!-- NEW COL START -->
                        <article class="col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <header>
                                    <h2>Geo Segment list edit: {{$geosegment_obj->name}} </h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('geosegmentlist_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="geosegmentlist_id" value="{{$geosegment_obj->id}}"/>
                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-2">
                                                        <label class="label" for=""> Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$geosegment_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label for="" class="label">status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active" @if($geosegment_obj->status=='Active') checked @endif>
                                                            <i></i>Active Status
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for=""> Advertiser Name</label>
                                                        <label class="input"> <h6>{{$geosegment_obj->getAdvertiser->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for=""> Client Name</label>
                                                        <label class="input"> <h6>{{$geosegment_obj->getAdvertiser->GetClientID->name}}</h6>
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--antiman button--round-l button--text-medium">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </form>
                                    </div>
                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- END COL -->
                    </div>
                    <!-- END ROW -->
                </section>
                <!-- end widget grid -->

                <!-- widget grid -->
                <section id="widget-grid" class="">

                    <!-- row -->
                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <table id="jqgrid"></table>
                            <div id="pjqgrid"></div>
                        </article>
                        <!-- WIDGET END -->

                    </div>

                    <!-- end row -->

                </section>
                <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->


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
                @foreach($geosegment_obj->getGeoEntries as $index)
                {
                    id : '{{$index->id}}',
                    name : '{{$index->name}}',
                    lat : '{{$index->lat}}',
                    lon : '{{$index->lon}}',
                    segment_radius : '{{$index->segment_radius}}',
                    geosegment_id : '{{$geosegment_obj->id}}',
                    created_at : '{{$index->created_at}}',
                    updated_at : '{{$index->updated_at}}'
                },
                @endforeach
            ];


        jQuery("#jqgrid").jqGrid({
                data : jqgrid_data,
                datatype : "local",
                height : 'auto',
                colNames : ['Actions', 'ID', 'Name','Lat','Lon','Radius','Geo Segment List','created_at','updated_at'],
                colModel : [{
                    name : 'act',
                    index : 'act',
                    sortable : false
                }, {
                    name : 'id',
                    index : 'id',
                    hidden: true
                }, {
                    name : 'name',
                    index : 'name',
                    editable : true
                }, {
                    name : 'lat',
                    index : 'lat',
                    editable : true
                }, {
                    name : 'lon',
                    index : 'lon',
                    editable : true
                }, {
                    name : 'segment_radius',
                    index : 'segment_radius',
                    editable : true
                }, {
                    name : 'geosegment_id',
                    index : 'geosegment_id',
                    editable : true ,
                    editoptions: { defaultValue: '{{$geosegment_obj->id}}'},
                    hidden:true
                }, {
                    name : 'created_at',
                    index : 'created_at',
                    hidden: true,
                    editable : false
                }, {
                    name : 'updated_at',
                    index : 'updated_at',
                    hidden: true,
                    editable : false
                }],
                rowNum : 10,
                rowList : [10, 20, 30],
                pager : '#pjqgrid',
                sortname : 'updated_at',
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
                editurl : "{{url('/geosegment_edit')}}",
                caption : "Geo Segment",
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
                    jQuery('#jqgrid').jqGrid('clearGridData');
                    jQuery('#jqgrid').jqGrid('setGridParam', {data: [{id:2,name:"sss"},{id:3,name:"ddd"}]});
                    jQuery('#jqgrid').trigger('reloadGrid');
                    alert('dd');
                    console.log(response);
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
                    var lat=String(data[0].lat);
                    var lon=String(data[0].lon);
                    var segment_radius=String(data[0].segment_radius);
                    $("#jqgrid").addRowData(id,{ id: + id ,name:name,lat:lat,lon:lon,segment_radius:segment_radius ,geosegment_id: +data[0].geosegment_id,created_at:data[0].created_at,updated_at:data[0].updated_at }, 'first');
                    $("#jqgrid").trigger("reloadGrid");
                    $.smallBox({
                        title : name+" Added Successfully",
                        content : "<i class='fa fa-clock-o'></i> <i>Moments ago...</i>",
                        color : "#0e846f",
                        iconSmall : "fa fa-thumbs-up bounce animated",
                        timeout : 4000
                    });

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