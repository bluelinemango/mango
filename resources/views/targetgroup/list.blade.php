@extends('Layout1')
@section('siteTitle')List Of Target Group for {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Target Group List</h4></div>
                <div id="targetgroup_grid"></div>
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
        $(document).ready(function() {
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.targetgroup, function (targetgroup) {
                            return (!filter.name || targetgroup.name.indexOf(filter.name) > -1)
                                    && (!filter.campaign_name || targetgroup.campaign_name.indexOf(filter.campaign_name) > -1)
                                    && (!filter.id || targetgroup.id.indexOf(filter.id) > -1);
                        });
                    },

                    updateItem: function (updatingTargetgroup) {
                        updatingTargetgroup['oper'] = 'edit';
                        console.log(updatingTargetgroup);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/targetgroup')}}",
                            data: updatingTargetgroup,
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

                db.targetgroup = [
                    @foreach($targetgroup_obj as $index)
                    {
                        "id": 'tg{{$index->id}}',
                        "name": '{{$index->name}}',
                        "campaign_name":'<a href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/edit')}}">{{$index->getCampaign->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<a id="targetgroup{{$index->id}}" href="javascript: ChangeStatus(`targetgroup`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="targetgroup{{$index->id}}" href="javascript: ChangeStatus(`targetgroup`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/targetgroup/tg'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_TARGETGROUP',$permission)) +' <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/targetgroup/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#targetgroup_grid").jsGrid({
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
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "campaign_name", title: "Campaign", type: "text", width: 70, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit / +TG", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });
        })

    </script>

@endsection
