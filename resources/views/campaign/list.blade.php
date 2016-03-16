@extends('Layout1')
@section('siteTitle')List Of Campaign for {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection

@section('content')
<div class="col-md-9">
    <div class="panel gray">
        <div class="panel-body hexagon-bg">
            <div class="panel-title"><h4>Campaign List</h4></div>
            <div id="campaign_grid"></div>
        </div><!--.panel-body-->
    </div><!--.panel-->
</div><!--.col-->
<div class="col-md-3">
    <div class="panel gray">
        <div class="panel-heading">
            <div class="panel-title">
                <h4 class="pull-left">Activities</h4>
                <div class="pull-right audit-select">
                    <select id="audit_status" class="selecter col-md-12" >
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
@endsection

@section('FooterScripts')
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
                            return (!filter.name || campaign.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
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
                            $("#campaign_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                                $.ajax({
                                    url: "{{url('ajax/getAudit/campaign')}}"
                                }).success(function (response) {
                                    $('#show_audit').html(response);
                                });
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
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
                        "status": '<div class="switcher"><input id="campaign{{$index->id}}" onchange="ChangeStatus(`campaign`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="campaign{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="campaign{{$index->id}}" onchange="ChangeStatus(`campaign`,`{{$index->id}}`)" type="checkbox" hidden><label for="campaign{{$index->id}}"></label></div>',
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
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]

                });

            });
        });

    </script>

@endsection
