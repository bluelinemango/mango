@if($taskAjax=='showCampaignSelect')
    <option value="all">All Campaign</option>
    @foreach($next_child as $index)
        <option value="{{$index->id}}">
            {{$index->name}}
        </option>
    @endforeach
@elseif($taskAjax=='showCampaignList')
    <div id="campaign_grid"></div>
    <script>
        var campaing_list=[];
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
                    "id": '{{$index->id}}',
                    "name": '{{$index->name}}',
                    "daily_max_imp":'{{$index->daily_max_impression}}',
                    "cpm":'{{$index->cpm}}',
                    "daily_max_budget":'{{$index->daily_max_budget}}',
                    @if($index->status == 'Active')
                    "status": '<span class="label label-success">Active</span>',
                    @elseif($index->status == 'Inactive')
                    "status": '<span class="label label-danger">Inactive</span> ',
                    @endif
                    "date_modify": '{{$index->updated_at}}'

                    },
                @endforeach
            ];

            $("#campaign_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: false,
                sorting: true,
                paging: true,
                autoload: true,

                pageSize: 15,
                pageButtonCount: 5,

                deleteConfirm: "Do you really want to delete the client?",

                controller: db,
                fields: [
                    {
                        headerTemplate: function() {
                            return 'Check';
                        },
                        itemTemplate: function(_, item) {
                            return $("<input>").attr("type", "checkbox")
                                    .on("change", function () {
                                        console.log(item.id);
                                        $(this).is(":checked") ? campaing_list.push(item.id) : campaing_list.splice(item.id, 1);
                                        $('#campaign_list').val(campaing_list);
                                    });
                        },
                        align: "center",
                        width: 50
                    },
                    {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "daily_max_imp", title: "Daily Imps", type: "text", width: 70, align: "center"},
                    {name: "cpm", title: "CPM", type: "text", width: 60, align: "center"},
                    {name: "daily_max_budget", title: "Daily Budget", type: "text", width: 80, align: "center"},
                    {name: "status", title: "Status", width: 50, align: "center"},
                    {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
                ]

            });

        });

    </script>
@elseif($taskAjax=='showCreativeList')
    <div id="creative_grid"></div>
    <script>
        var creative_list=[];
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
                    "id": '{{$index->id}}',
                    "name": '{{$index->name}}',
                    "size":'{{$index->size}}',
                    "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                    @if($index->status == 'Active')
                    "status": '<span class="label label-success">Active</span> ',
                    @elseif($index->status == 'Inactive')
                    "status": '<span class="label label-danger">Inactive</span>',
                    @endif
                    "date_modify": '{{$index->updated_at}}'

                    },
                @endforeach
            ];

            $("#creative_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: false,
                sorting: true,
                paging: true,
                autoload: true,

                pageSize: 15,
                pageButtonCount: 5,

                deleteConfirm: "Do you really want to delete the client?",

                controller: db,
                fields: [
                    {
                        headerTemplate: function() {
                            return 'Check';
                        },
                        itemTemplate: function(_, item) {
                            return $("<input>").attr("type", "checkbox")
                                    .on("change", function () {
                                        console.log(item.id);
                                        $(this).is(":checked") ? creative_list.push(item.id) : creative_list.splice(item.id, 1);
                                        $('#creative_list').val(creative_list);
                                    });
                        },
                        align: "center",
                        width: 50
                    },
                    {name: "id", title: "ID", width: 40, type: "text", align: "center",editing:false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "size", title: "Size", type: "text", width: 50, align: "center",editing:false},
                    {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center",editing:false},
                    {name: "status", title: "Status", width: 50, align: "center"},
                    {name: "date_modify", title: "Last Modified", align: "center"}
                ]

            });

        });


    </script>
@elseif($taskAjax=='showTargetgroupList')
    <div id="targetgroup_grid"></div>
    <script>
        var tg_list=[];
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
                    "id": '{{$index->id}}',
                    "name": '{{$index->name}}',
                    "campaign_name":'<a href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/edit')}}">{{$index->getCampaign->name}}</a>',
                    @if($index->status == 'Active')
                    "status": '<span class="label label-success">Active</span>',
                    @elseif($index->status == 'Inactive')
                    "status": '<span class="label label-danger">Inactive</span> ',
                    @endif
                    "date_modify": '{{$index->updated_at}}'

                    },
                @endforeach
            ];

            $("#targetgroup_grid").jsGrid({
                width: "100%",

                filtering: true,
                editing: false,
                sorting: true,
                paging: true,
                autoload: true,

                pageSize: 15,
                pageButtonCount: 5,

                deleteConfirm: "Do you really want to delete the client?",

                controller: db,
                fields: [
                    {
                        headerTemplate: function() {
                            return 'Check';
                        },
                        itemTemplate: function(_, item) {
                            return $("<input>").attr("type", "checkbox")
                                    .on("change", function () {
                                        console.log(item.id);
                                        $(this).is(":checked") ? tg_list.push(item.id) : tg_list.splice(item.id, 1);
                                        $('#tg_list').val(tg_list);
                                    });
                        },
                        align: "center",
                        width: 50
                    },
                    {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "campaign_name", title: "Campaign", type: "text", width: 70, align: "center",editing:false},
                    {name: "status", title: "Status", width: 50, align: "center"},
                    {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
                ]

            });

        });
    </script>
@elseif($taskAjax=='showAdvertiserSelect')
    <option value="all">All Advertiser</option>
    @foreach($next_child as $index)
        <option value="{{$index->id}}">
            {{$index->name}}
        </option>
    @endforeach
    <script>
    </script>
@elseif($taskAjax=='showTargetgroupSelect')
    <option value="0">select one</option>
    @foreach($next_child as $index)
        <option value="{{$index->id}}">
            {{$index->name}}
        </option>
    @endforeach
@endif