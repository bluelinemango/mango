@extends('Layout1')
@section('siteTitle')List Of Campaign for {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection
@section('headerCss')
    <link rel="stylesheet" type="text/css" href="{{cdn('css/jsgrid/jsgrid.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{cdn('css/jsgrid/theme.css')}}" />
@endsection

@section('content')
    <div class="content">

        <div class="page-header full-content">
            <div class="row">
                <div class="col-sm-6">
                    <h1>NOMADINI <small>Diffrent Ads</small></h1>
                </div><!--.col-->
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ion-home"></i></a></li>
                        <li><a href="#">Campaign</a></li>
                        <li><a href="#" class="active">List</a></li>
                    </ol>
                </div><!--.col-->
            </div><!--.row-->
        </div><!--.page-header-->

        <!-- content -->
        <div class="col-md-9">
            <div class="panel red">
                <div class="panel-heading">
                    <div class="panel-title"><h4>Campaign List</h4></div>
                </div><!--.panel-heading-->
                <div class="panel-body">
                    <div id="campaign_grid"></div>
                </div><!--.panel-body-->
            </div><!--.panel-->
        </div><!--.col-->
        <div class="col-md-3">
            <div class="panel indigo">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class="pull-left">Activities</h4>
                        <select id="audit_status" class="pull-right">
                            <option value="entity">This Entity</option>
                            <option value="all">All</option>
                            <option value="user">User</option>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                </div><!--.panel-heading-->
                <div class="panel-body" style="padding: 0px 0 0 10px;">
                    <div class="timeline single" id="show_audit">
                    </div><!--.timeline-->
                </div><!--.panel-body-->
            </div><!--.panel-->
        </div><!--.col-->
        <!-- content -->

        <div class="footer-links margin-top-40">
            <div class="row no-gutters">
                <div class="col-xs-6 bg-indigo">
                    <a href="pages-timeline.html">
                        <span class="state">Pages</span>
                        <span>Timeline</span>
                        <span class="icon"><i class="ion-android-arrow-back"></i></span>
                    </a>
                </div><!--.col-->
                <div class="col-xs-6 bg-cyan">
                    <a href="components-offline-detector.html">
                        <span class="state">Components</span>
                        <span>Offline Detector</span>
                        <span class="icon"><i class="ion-android-arrow-forward"></i></span>
                    </a>
                </div><!--.col-->
            </div><!--.row-->
        </div><!--.footer-links-->

    </div><!--.content-->

@endsection

@section('FooterScripts')
    <!-- BEGIN INITIALIZATION-->
    <script>
        $(document).ready(function () {
            Pleasure.init();
            Layout.init();
        });
    </script>
    <!-- END INITIALIZATION-->
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
                    url: "{{url('ajax/getAudit/campaign')}}"
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

            $.ajax({
                url: "{{url('ajax/getAudit/campaign')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.campaign, function (campaign) {
                            return (!filter.name || campaign.name.indexOf(filter.name) > -1)
                                    && (!filter.daily_max_imp || campaign.daily_max_imp.indexOf(filter.daily_max_imp) > -1)
                                    && (!filter.cpm || campaign.cpm.indexOf(filter.cpm) > -1)
                                    && (!filter.id || campaign.id.indexOf(filter.id) > -1)
                                    && (!filter.daily_max_budget || campaign.daily_max_budget.indexOf(filter.daily_max_budget) > -1);
                        });
                    },

                    updateItem: function (updatingCampaign) {
                        updatingCampaign['oper'] = 'edit';
                        console.log(updatingCampaign);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/campaign')}}",
                            data: updatingCampaign,
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

                db.campaign = [
                    @foreach($campaign_obj as $index)
                    {
                        "id": 'cmp{{$index->id}}',
                        "name": '{{$index->name}}',
                        "daily_max_imp":'{{$index->daily_max_impression}}',
                        "cpm":'{{$index->cpm}}',
                        "daily_max_budget":'{{$index->daily_max_budget}}',
                        @if($index->status == 'Active')
                        "status": '<a id="campaign{{$index->id}}" href="javascript: ChangeStatus(`campaign`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="campaign{{$index->id}}" href="javascript: ChangeStatus(`campaign`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/cmp'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /> </a>' @if(in_array('ADD_EDIT_TARGETGROUP',$permission)) +' | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/cmp'.$index->id.'/targetgroup/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif @if(in_array('ADD_EDIT_CAMPAIGN',$permission)) +' | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a> | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/cmp'.$index->id.'/clone/1')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#campaign_grid").jsGrid({
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
                        {name: "daily_max_imp", title: "Daily Imps", type: "text", width: 70, align: "center"},
                        {name: "cpm", title: "CPM", type: "text", width: 60, align: "center"},
                        {name: "daily_max_budget", title: "Daily Budget", type: "text", width: 80, align: "center"},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +TG | +Camp | Clone", sorting: false, width: 160, align: "center"},
                        {type: "control"}
                    ]

                });

            });
        });

    </script>

@endsection
