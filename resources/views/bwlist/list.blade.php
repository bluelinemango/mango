@extends('Layout')
@section('siteTitle')List Of Black \ White List for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

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
                <li>Black/White List</li>
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
                                        <h2>Black / White List</h2>
                                    </header>
                                    <!-- widget div-->
                                    <div>
                                        <!-- widget content -->
                                        <div class=" ">


                                            <!-- widget grid -->
                                            <section id="widget-grid" class="">

                                                <!-- row -->
                                                <div class="row">

                                                    <!-- NEW WIDGET START -->
                                                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                                                        <div id="bwlist_grid"></div>
                                                        {{--<table id="jqgrid"></table>--}}
                                                        {{--<div id="pjqgrid"></div>--}}

                                                    </div>
                                                    <!-- WIDGET END -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-heading">
                                                                <h2 class="pull-left">Activities</h2>
                                                                <select name="" id="" class="pull-right">
                                                                    <option value="entity">This Entity</option>
                                                                    <option value="all">All</option>
                                                                    <option value="user">User</option>
                                                                </select>
                                                                <div class="clearfix"></div>
                                                                <small>All Activities for this Entity </small>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="streamline b-l b-accent m-b">
                                                                    @for($i=0;$i<count($audit_obj);)
                                                                        <?php $change_key = $audit_obj[$i]->change_key; ?>
                                                                        <div class="sl-item">
                                                                            <div class="sl-content">
                                                                                <div class="text-muted-dk">{{$audit_obj[$i]->created_at}}</div>
                                                                                <p>
                                                                                    <a href="{{url('user/usr'.$audit_obj[$i]->user_id.'/edit')}}">{{$audit_obj[$i]->getUser->name}}</a>
                                                                                    @if($audit_obj[$i]->audit_type == 'add')
                                                                                        created a new {{$audit_obj[$i]->entity_type}}:
                                                                                    @elseif($audit_obj[$i]->audit_type == 'edit')
                                                                                        changed {{$audit_obj[$i]->entity_type}}:
                                                                                    @elseif($audit_obj[$i]->audit_type == 'del')
                                                                                        deleted {{$audit_obj[$i]->entity_type}}:
                                                                                    @endif
                                                                                    @if($audit_obj[$i]->entity_type == 'bwlist')
                                                                                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/bwlist/bwl'.$audit_obj[$i+1][0]->id.'/edit')}}">{{$audit_obj[$i+1][0]->name}}</a>
                                                                                        </strong>
                                                                                    @endif
                                                                                    @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                                                                                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/bwlist/bwl'.$audit_obj[$i]->after_value.'/edit')}}">bwl{{$audit_obj[$i]->after_value}}</a>
                                                                                        </strong>
                                                                                    @endif

                                                                                </p>

                                                                                @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key)

                                                                                    @if($audit_obj[$i]->audit_type == 'edit')
                                                                                        <div class="well well-sm display-inline">
                                                                                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='edit')
                                                                                                <p> <strong>{{$audit_obj[$i]->field}}</strong>
                                                                                                    from
                                                                                                    <strong>{{$audit_obj[$i]->before_value}}</strong>
                                                                                                    to
                                                                                                    <strong>{{$audit_obj[$i]->after_value}}</strong>
                                                                                                </p>
                                                                                                <?php $i = $i + 2; ?>
                                                                                            @endwhile
                                                                                        </div>

                                                                                    @endif

                                                                                    @if(isset($audit_obj[$i]->audit_type) and $audit_obj[$i]->audit_type == 'add' and $audit_obj[$i]->change_key==$change_key)
                                                                                        <div class="well well-sm display-inline">
                                                                                            @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                                                                                                Domain Name(s):
                                                                                            @endif
                                                                                            <?php $flg = 0; $count = 0; ?>
                                                                                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type == 'add')
                                                                                                @if($flg>=20)
                                                                                                    <?php $count++ ?>
                                                                                                @endif
                                                                                                <p>
                                                                                                    @if($audit_obj[$i]->entity_type == 'bwlistentrie' and $flg < 2)
                                                                                                        name:
                                                                                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                                                                                    @endif
                                                                                                </p>
                                                                                                <?php $i = $i + 2; $flg++; ?>
                                                                                            @endwhile
                                                                                            @if($flg>20)
                                                                                                <p> and other <strong>{{$count}}</strong>
                                                                                                    more...</p>
                                                                                            @endif
                                                                                        </div>
                                                                                    @endif
                                                                                    @if(isset($audit_obj[$i]->audit_type) and $audit_obj[$i]->audit_type == 'del' and $audit_obj[$i]->change_key==$change_key)
                                                                                        <div class="well well-sm display-inline">
                                                                                            @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                                                                                                Domain(s):
                                                                                            @endif
                                                                                            <?php $flg = 0; $count = 0; ?>
                                                                                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type == 'del')
                                                                                                @if($flg>=20)
                                                                                                    <?php $count++ ?>
                                                                                                @endif
                                                                                                <p>
                                                                                                    @if($audit_obj[$i]->entity_type == 'bwlistentrie' and $flg < 2)
                                                                                                        name:
                                                                                                        <strong>{{$audit_obj[$i]->before_value}}</strong>
                                                                                                    @endif
                                                                                                </p>
                                                                                                <?php $i = $i + 2; $flg++; ?>
                                                                                            @endwhile
                                                                                            <p>
                                                                                                @if($flg>20)
                                                                                                    and other <strong>{{$count}}</strong>
                                                                                                    more...</p>
                                                                                            @endif
                                                                                        </div>
                                                                                    @endif


                                                                                @endwhile
                                                                            </div>
                                                                            @endfor
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- WIDGET END -->

                                                    </div>

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
                        return $.grep(this.bwlist, function (bwlist) {
                            return (!filter.name || bwlist.name.indexOf(filter.name) > -1);
                        });
                    },

                    updateItem: function (updatingBWlist) {
                        updatingBWlist['oper'] = 'edit';
                        console.log(updatingBWlist);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/bwlist')}}",
                            data: updatingBWlist,
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

                db.bwlist = [

                    @foreach($bwlist_obj as $index)
                    {
                        "id": 'cmp{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name" : '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getEntries)>0)
                        "website": '{{$index->getEntries[0]->bwlist_count}}',
                        @else
                        "website" : '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<a id="bwlist{{$index->id}}" href="javascript: ChangeStatus(`bwlist`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="bwlist{{$index->id}}" href="javascript: ChangeStatus(`bwlist`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/bwl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#bwlist_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 10,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "advertiser_name", title: "Advertiser", type: "text", width: 60, align: "center",editing:false},
                        {name: "website", title: "#Entery", type: "text", width: 40, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | + B/W", sorting: false, width: 60, align: "center"},
                        {type: "control"}
                    ]

                });

            });












            {{--var jqgrid_data = [--}}
                {{--@foreach($bwlist_obj as $index)--}}
                {{--@if(!is_null($index->getAdvertiser->GetClientID))--}}
                {{--{--}}
                    {{--id   : 'bwl{{$index->id}}',--}}
                    {{--name : '{{$index->name}}',--}}
                    {{--advertiser_name : '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',--}}
                    {{--@if(count($index->getEntries)>0)--}}
                    {{--website: '{{$index->getEntries[0]->bwlist_count}} Domain(s)',--}}
                    {{--@else--}}
                    {{--website : 'Empty',--}}
                    {{--@endif--}}
                    {{--@if($index->status == 'Active')--}}
                    {{--status: '<a id="bwlist{{$index->id}}" href="javascript: ChangeStatus(`bwlist`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',--}}
                    {{--@elseif($index->status == 'Inactive')--}}
                    {{--status: '<a id="bwlist{{$index->id}}" href="javascript: ChangeStatus(`bwlist`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',--}}
                    {{--@endif--}}
                    {{--date_modify : '{{$index->updated_at}}',--}}
                    {{--full_edit: '<a class="btn btn-info" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/bwl'.$index->id.'/edit')}}"><i class="fa fa-edit "></i></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn bg-color-magenta txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/add')}}">+ Black/White List</a>'@endif--}}
                {{--},--}}
                {{--@endif--}}
                {{--@endforeach--}}
            {{--];--}}

            {{--jQuery("#jqgrid").jqGrid({--}}
                {{--data : jqgrid_data,--}}
                {{--datatype : "local",--}}
                {{--height : 'auto',--}}
                {{--colNames : ['Actions', 'ID', 'Name','Advertiser Name','# of Domain','Status','Modify Date','Full Actions'],--}}
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
                    {{--name : 'advertiser_name',--}}
                    {{--index : 'advertiser_name',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'website',--}}
                    {{--index : 'website',--}}
                    {{--width: '70%',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'status',--}}
                    {{--index : 'status',--}}
                    {{--width: '60%',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'date_modify',--}}
                    {{--index : 'date_modify',--}}
                    {{--width: '105%',--}}
                    {{--editable : false--}}
                {{--}, {--}}
                    {{--name : 'full_edit',--}}
                    {{--index : 'full_edit',--}}
                    {{--editable : false--}}
                {{--}],--}}
                {{--rowNum : 10,--}}
                {{--rowList : [10, 20, 30],--}}
                {{--pager : '#pjqgrid',--}}
                {{--sortname : 'date_modify',--}}
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
                {{--editurl : "{{url('/ajax/jqgrid/bwlist')}}",--}}
                {{--caption : "Black/White Lists",--}}
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
