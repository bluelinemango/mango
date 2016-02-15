@extends('Layout')
@section('siteTitle')List Of Creative for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

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
                <li>Creative List</li>
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
                        <div class="well">
                            <header>
                                <h2>Creative List</h2>
                            </header>

                            <!-- widget div-->
                                <!-- widget content -->

                                    <!-- widget grid -->

                                        <!-- row -->
                                        <div class="row">

                                            <!-- NEW WIDGET START -->
                                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                                                <div id="creative_grid"></div>
                                                {{--<table id="jqgrid"></table>--}}
                                                {{--<div id="pjqgrid"></div>--}}
                                            </div>
                                            <!-- WIDGET END -->
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
                                                <!-- WIDGET END -->

                                            </div>

                                        </div>

                                        <!-- end row -->

                                    <!-- end widget grid -->

                                <!-- end widget content -->
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

        $('#audit_status').change(function () {
            if($(this).val()=='all'){
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }else if($(this).val()=='entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/creative')}}"
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

        $(document).ready(function() {
            pageSetUp();
            $.ajax({
                url: "{{url('ajax/getAudit/creative')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.creative, function (creative) {
                            return (!filter.name || creative.name.indexOf(filter.name) > -1)
                                    && (!filter.size || creative.size.indexOf(filter.size) > -1)
                                    && (!filter.advertiser || creative.advertiser.indexOf(filter.advertiser) > -1)
                                    && (!filter.id || creative.id.indexOf(filter.id) > -1);
                        });
                    },

                    updateItem: function (updatingCreative) {
                        updatingCreative['oper'] = 'edit';
                        console.log(updatingCreative);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/creative')}}",
                            data: updatingCreative,
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

                db.creative = [
                        @foreach($creative_obj as $index)
                    {
                        "id": 'crt{{$index->id}}',
                        "name": '{{$index->name}}',
                        "size":'{{$index->size}}',
                        "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_CREATIVE',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#creative_grid").jsGrid({
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
                        {name: "id", title: "ID", width: 40, type: "text", align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "size", title: "Size", type: "text", width: 50, align: "center",editing:false},
                        {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit | +Creative", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });




            {{--var jqgrid_data = [--}}
                {{--@foreach($creative_obj as $index)--}}
                {{--@if(!is_null($index->getAdvertiser->GetClientID))--}}
                {{--{--}}
                    {{--id   : 'crt{{$index->id}}',--}}
                    {{--name : '{{$index->name}}',--}}
                    {{--size : '{{$index->size}}',--}}
                    {{--advertiser: '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',--}}
                    {{--@if($index->status == 'Active')--}}
                    {{--status: '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',--}}
                    {{--@elseif($index->status == 'Inactive')--}}
                    {{--status: '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',--}}
                    {{--@endif--}}
                    {{--date_modify : '{{$index->updated_at}}',--}}
                    {{--full_edit: '<a class="btn btn-info" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/edit')}}"><i class="fa fa-edit "></i></a>' @if(in_array('ADD_EDIT_CREATIVE',$permission)) +'| <a class="btn bg-color-magenta txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/add')}}">+ Creative</a>'@endif--}}
                {{--},--}}
                {{--@endif--}}
                {{--@endforeach--}}
            {{--];--}}

            {{--jQuery("#jqgrid").jqGrid({--}}
                {{--data : jqgrid_data,--}}
                {{--datatype : "local",--}}
                {{--height : 'auto',--}}
                {{--colNames : ['Actions', 'ID', 'Name','Size','Advertiser','Status','Modify Date','Full Actions'],--}}
                {{--colModel : [{--}}
                    {{--name : 'act',--}}
                    {{--index : 'act',--}}
                    {{--width: '100%',--}}
                    {{--sortable : false--}}
                {{--}, {--}}
                    {{--name : 'id',--}}
                    {{--width: '50%',--}}
                    {{--index : 'id'--}}
                {{--}, {--}}
                    {{--name : 'name',--}}
                    {{--index : 'name',--}}
                    {{--width: '100%',--}}
                    {{--editable : true--}}
                {{--}, {--}}
                    {{--name : 'size',--}}
                    {{--index : 'size',--}}
                    {{--width: '80%',--}}
                    {{--editable : true--}}
                {{--}, {--}}
                    {{--name : 'advertiser',--}}
                    {{--index : 'advertiser',--}}
                    {{--width: '100%',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'status',--}}
                    {{--index : 'status',--}}
                    {{--width: '60%',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'date_modify',--}}
                    {{--index : 'date_modify',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'full_edit',--}}
                    {{--index : 'full_edit',--}}
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
                        {{--be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";--}}
                        {{--se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";--}}
                        {{--ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";--}}
                        {{--jQuery("#jqgrid").jqGrid('setRowData', ids[i], {--}}
                            {{--act : be + se + ca--}}
                        {{--});--}}
                    {{--}--}}
                {{--},--}}
                {{--editurl : "{{url('/ajax/jqgrid/creative')}}",--}}
                {{--caption : "Creative List",--}}
                {{--multiselect : true,--}}
                {{--autowidth : true--}}

            {{--});--}}

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

        })

    </script>

@endsection
