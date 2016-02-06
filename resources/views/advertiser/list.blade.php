@extends('Layout')
@section('siteTitle')List Of Advertiser for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

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
               <li>Advertiser List</li>
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
                        <div class="well " >
                            <!-- widget div-->
                            <div>

                                <!-- widget content -->
                                <div class="">
                                    <!-- widget grid -->
                                    <section id="widget-grid" class="">

                                        <!-- row -->
                                        <div class="row">

                                            <!-- NEW WIDGET START -->
                                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                                                <div id="advertiser_grid"></div>

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
@endsection

@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    {{--<script src="{{cdn('js/plugin/jqgrid/jquery.jqGrid.min.js')}}"></script>--}}
    {{--<script src="{{cdn('js/plugin/jqgrid/grid.locale-en.min.js')}}"></script>--}}

    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            pageSetUp();

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.advertiser, function (advertiser) {
                            return (!filter.name || advertiser.name.indexOf(filter.name) > -1);
                        });
                    },

                    updateItem: function (updatingAdvertiser) {
                        updatingAdvertiser['oper'] = 'edit';
                        console.log(updatingAdvertiser);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/advertiser')}}",
                            data: updatingAdvertiser,
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
                    }

                };

                window.db = db;

                db.advertiser = [

                    @foreach($adver_obj as $index)
                    {
                        "id": 'adv{{$index->id}}',
                        "name": '{{$index->name}}',
                        @if(count($index->Campaign)>0)
                        "campaign": '{{$index->Campaign[0]->advertiser_count}} ',
                        @else
                        "campaign": '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn btn-info" href="{{url('/client/cl'.$index->GetClientID->id.'/advertiser/adv'.$index->id.'/edit')}}"><i class="fa fa-edit"></i></a>'

                    },
                    @endforeach
                ];

                $("#advertiser_grid").jsGrid({
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
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name",autosearch: true, type: "text", width: 70},
                        {name: "campaign", title: "# of CMP.", width: 50, align: "center"},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Full Action", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });


        });













            {{--var jqgrid_data = [--}}
                {{--@foreach($adver_obj as $index)--}}
                {{--@if(!is_null($index->GetClientID))--}}
                {{--{--}}

                    {{--id : 'adv{{$index->id}}',--}}
                    {{--name : '{{$index->name}}',--}}
                    {{--@if(count($index->Campaign)>0)--}}
                    {{--campaign: '{{$index->Campaign[0]->advertiser_count}} Campaign(s)',--}}
                    {{--@else--}}
                    {{--campaign: '0 Campaign',--}}
                    {{--@endif--}}
                    {{--@if($index->status == 'Active')--}}
                    {{--status: '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',--}}
                    {{--@elseif($index->status == 'Inactive')--}}
                    {{--status: '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',--}}
                    {{--@endif--}}
                    {{--date_modify : '{{$index->updated_at}}',--}}
                    {{--full_edit: '<a class="btn btn-info" href="{{url('/client/cl'.$index->GetClientID->id.'/advertiser/adv'.$index->id.'/edit')}}"><i class="fa fa-edit"></i></a>'--}}
                {{--},--}}
                {{--@endif--}}
                {{--@endforeach--}}
        {{--];--}}

            {{--jQuery("#jqgrid").jqGrid({--}}
                {{--data : jqgrid_data,--}}
                {{--datatype : "local",--}}
                {{--height : 'auto',--}}
                {{--colNames : ['Actions', 'ID', 'Name','# of Campaign','Status','Modify Date','Full Edit'],--}}
                {{--colModel : [{--}}
                    {{--name : 'act',--}}
                    {{--index : 'act',--}}
                    {{--width : '90%',--}}
                    {{--sortable : false--}}
                {{--}, {--}}
                    {{--name : 'id',--}}
                    {{--index : 'id',--}}
                    {{--width : '60%'--}}
                {{--}, {--}}
                    {{--name : 'name',--}}
                    {{--index : 'name',--}}
                    {{--editable : true--}}
                {{--}, {--}}
                    {{--name : 'campaign',--}}
                    {{--index : 'campaign',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'status',--}}
                    {{--index : 'status',--}}
                    {{--width : '100%',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'date_modify',--}}
                    {{--index : 'date_modify',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'full_edit',--}}
                    {{--index : 'full_edit',--}}
                    {{--width : '60%',--}}
                    {{--editable : false--}}
                {{--}],--}}
                {{--rowNum : 10,--}}
                {{--rowList : [10, 20, 30],--}}
                {{--pager : '#pjqgrid',--}}
                {{--sortname : 'campaign',--}}
                {{--ajaxRowOptions: { async: true },--}}
                {{--toolbarfilter : true,--}}
                {{--viewrecords : true,--}}
                {{--sortorder : "desc",--}}
                {{--gridComplete : function() {--}}
                    {{--var ids = jQuery("#jqgrid").jqGrid('getDataIDs');--}}
                    {{--for (var i = 0; i < ids.length; i++) {--}}
                        {{--var cl = ids[i];--}}
                        {{--be = "<a class='edit_jqgrid' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></a>";--}}
                        {{--se = "<a class='save_jqgrid' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></a>";--}}
                        {{--ca = "<a class='cancel_jqgrid' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></a>";--}}
{{--//                        ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";--}}
{{--//                        jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});--}}
                        {{--jQuery("#jqgrid").jqGrid('setRowData', ids[i], {--}}
                            {{--act : be + se + ca--}}
                        {{--});--}}
                    {{--}--}}
                {{--},--}}
                {{--editurl : "{{url('/ajax/jqgrid/advertiser')}}",--}}
                {{--caption : "Advertiser List",--}}
                {{--multiselect : true,--}}
                {{--autowidth : true--}}

            {{--});--}}
{{--//            jQuery('#jqgrid').jqGrid('clearGridData');--}}
{{--//            jQuery('#jqgrid').jqGrid('setGridParam', {data: [{id:2,name:"sss"},{id:3,name:"ddd"}]});--}}
{{--//            jQuery('#jqgrid').trigger('reloadGrid');--}}


            {{--jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {--}}
                {{--edit : false,--}}
                {{--add : false,--}}
                {{--del : false--}}
            {{--});--}}
            {{--jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");--}}
            {{--$('.navtable .ui-pg-button').tooltip({--}}
                {{--container : 'body'--}}
            {{--});--}}

            {{--jQuery("#m1").click(function() {--}}
                {{--var s;--}}
                {{--s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');--}}
                {{--alert(s);--}}
            {{--});--}}
            {{--jQuery("#m1s").click(function() {--}}
                {{--jQuery("#jqgrid").jqGrid('setSelection', "13");--}}
            {{--});--}}

            {{--// remove classes--}}
            {{--$(".ui-jqgrid").removeClass("ui-widget ui-widget-content");--}}
            {{--$(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");--}}
            {{--$(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");--}}
            {{--$(".ui-jqgrid-pager").removeClass("ui-state-default");--}}
            {{--$(".ui-jqgrid").removeClass("ui-widget-content");--}}

            {{--// add classes--}}
            {{--$(".ui-jqgrid-htable").addClass("table table-bordered table-hover");--}}
            {{--$(".ui-jqgrid-btable").addClass("table table-bordered table-striped");--}}

            {{--$(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");--}}
            {{--$(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");--}}
            {{--$(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");--}}
            {{--$(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");--}}
            {{--$(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");--}}
            {{--$(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");--}}
            {{--$(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");--}}
            {{--$(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");--}}

            {{--$(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");--}}
            {{--$(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");--}}

            {{--$(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");--}}
            {{--$(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");--}}

            {{--$(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");--}}
            {{--$(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");--}}

            {{--$(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");--}}
            {{--$(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");--}}




//        })

    </script>
@endsection
