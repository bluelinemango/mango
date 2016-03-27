@extends('Layout1')
@section('siteTitle')Edit Campaign: {{$campaign_obj->name}} @endsection
@section('headerCss')
    <link rel="stylesheet" href="{{cdn('newTheme/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}">


@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client:
                cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->advertiser_id.'/edit')}}">Advertiser:
                adv{{$campaign_obj->advertiser_id}}</a>
        </li>
        @if($clone==1)
            <li><a href="#" class="active">Add Campaign</a></li>
        @else
            <li><a href="#" class="active">Campaign: cmp{{$campaign_obj->id}}</a></li>
        @endif
    </ol>
@endsection
@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3" style="width: 20% !important;">
                    <div class="real-time-box">
                        <div class="hexagon pull-left hexagon-bg1">
                            <i class="fa fa-eye"></i>
                        </div>

                        <div class="real-time-content real-color1">
                            Imps to Now
                            <br/>
                            <br/>
                            <strong>{{(isset($real_time[0])) ? $real_time[0]->impressions_shown_today_until_now : '0'}}</strong>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-4 btn-border-real-box-left1">
                        </div>
                        <div class="col-md-8 btn-border-real-box-right1">
                        </div>

                    </div>
                </div>
                <div class="col-md-3" style="width: 20% !important;">
                    <div class="real-time-box">
                        <div class="hexagon pull-left hexagon-bg2">
                            <i class="fa fa-eye"></i>
                        </div>

                        <div class="real-time-content real-color2">
                            Total Imps
                            <br/>
                            <br/>
                            <strong>{{(isset($real_time[0])) ? $real_time[0]->total_impression_show_until_now : '0'}}</strong>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-4 btn-border-real-box-left2">
                        </div>
                        <div class="col-md-8 btn-border-real-box-right2 ">
                        </div>

                    </div>
                </div>
                <div class="col-md-3" style="width: 20% !important;">
                    <div class="real-time-box">
                        <div class="hexagon pull-left hexagon-bg3">
                            <i class="fa fa-dollar"></i>
                        </div>

                        <div class="real-time-content real-color3">
                            Budget to Now
                            <br/>
                            <br/>
                            <strong>{{(isset($real_time[0])) ? $real_time[0]->daily_budget_spent_today_until_now : '0'}}</strong>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-4 btn-border-real-box-left3">
                        </div>
                        <div class="col-md-8 btn-border-real-box-right3">
                        </div>

                    </div>
                </div>
                <div class="col-md-3" style="width: 20% !important;">
                    <div class="real-time-box">
                        <div class="hexagon pull-left hexagon-bg4">
                            <i class="fa fa-dollar"></i>
                        </div>

                        <div class="real-time-content real-color4">
                            Total Budget
                            <br/>
                            <br/>
                            <strong>{{(isset($real_time[0])) ? $real_time[0]->total_budget_spent_until_now : '0'}}</strong>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-4 btn-border-real-box-left4">
                        </div>
                        <div class="col-md-8 btn-border-real-box-right4">
                        </div>

                    </div>
                </div>
                <div class="col-md-3" style="width: 20% !important;">
                    <div class="real-time-box">
                        <div class="hexagon pull-left hexagon-bg5">
                            <i class="fa fa-eye"></i>
                        </div>

                        <div class="real-time-content real-color5">
                            Last Shown
                            <br/>
                            <br/>
                            <span style="font-size: 12px">
                                {{(isset($real_time[0])) ? $real_time[0]->last_time_ad_shown : '0'}}
                            </span>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-4 btn-border-real-box-left5">
                        </div>
                        <div class="col-md-8 btn-border-real-box-right5">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="col-md-9">
            <div class="panel gray">
                <div class="panel-heading with-gap">
                    <div class="panel-title">
                        @if($clone==1)
                            <h4>Add Campaign </h4>
                        @else
                            <h4>Edit Campaign: {{$campaign_obj->name}} </h4>
                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body" style="padding: 0">

                    @if($clone==1)
                        <form id="order-form" class="form-horizontal parsley-validate"
                              action="{{URL::route('campaign_create')}}" method="post"
                              novalidate="novalidate">
                            @else
                                <form id="order-form" class="form-horizontal parsley-validate"
                                      action="{{URL::route('campaign_update')}}" method="post"
                                      novalidate="novalidate">
                                    @endif
                                    <input type="hidden" name="_token"
                                           value="{{ csrf_token() }}">                                       @if($clone==0)
                                        <input type="hidden" name="_method" value="PUT"/>
                                        <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>
                                    @else
                                        <input type="hidden" name="advertiser_id"
                                               value="{{$campaign_obj->getAdvertiser->id}}"/>
                                    @endif
                                    <div class="form-body">
                                        <div class="note note-primary note-bottom-striped">
                                            <h4>General Informaition</h4>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" id="name" name="name" placeholder="Name"
                                                                   class="form-control" value="{{$campaign_obj->name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label" for="">Advertiser Name</label>
                                                <h5>{{$campaign_obj->getAdvertiser->name}}</h5>

                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label" for="">Client Name</label>
                                                <h5>{{$campaign_obj->getAdvertiser->GetClientID->name}}</h5>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label" for="">Last Modified</label>
                                                <h5>{{$campaign_obj->updated_at}}</h5>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Domain Name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="advertiser_domain_name"
                                                                   class="form-control" placeholder="Domain Name" id="advertiser_domain_name"
                                                                   value="{{$campaign_obj->advertiser_domain_name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="control-label">Status</label>
                                                    <div class="switcher">
                                                        <input type="checkbox" name="active" hidden @if($campaign_obj->status=='Active')
                                                               checked @endif id="active">
                                                        <label for="active"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!--.form-group-->
                                        </div>
                                        <hr/>
                                        <div class="note note-info note-bottom-striped">
                                            <h4>Budget Informaition</h4>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Max Impression</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="max_impression"
                                                                   placeholder="Max Impression"
                                                                   value="{{$campaign_obj->max_impression}}" id="max_impression"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">

                                                <div class="form-group">
                                                    <label class="control-label">Daily Max Impression</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="daily_max_impression"
                                                                   placeholder="Daily Max Impression"
                                                                   value="{{$campaign_obj->daily_max_impression}}" id="daily_max_impression"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Max Budget</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">

                                                            <input type="text" name="max_budget"
                                                                   placeholder="Max Budget" class="form-control" id="max_budget"
                                                                   value="{{$campaign_obj->max_budget}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Daily Max Budget</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="daily_max_budget"
                                                                   placeholder="Daily Max Budget" class="form-control" id="daily_max_budget"
                                                                   value="{{$campaign_obj->daily_max_budget}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">cpm</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="cpm" placeholder="CPM" id="cpm"
                                                                   class="form-control"
                                                                   value="{{$campaign_obj->cpm}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <hr/>
                                        <div class="note note-warning note-bottom-striped">
                                            <h4>Date Range</h4>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <span class="add-on input-group-addon"><i class="ion-android-calendar"></i></span>
                                                        <div class="inputer">
                                                            <div class="input-wrapper">
                                                                <input type="text" style="width: 200px" name="date_range" class="form-control bootstrap-daterangepicker-basic-range" value="{{\Carbon\Carbon::parse($campaign_obj->start_date)->format('m/d/Y')}} - {{\Carbon\Carbon::parse($campaign_obj->end_date)->format('m/d/Y')}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div style="padding: 15px">

                                            <div class="form-group">
                                                <label class="control-label">Description</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <textarea name="description" class="form-control" rows="3"
                                                                  placeholder="type minimum 5 characters"
                                                                  required>{{$campaign_obj->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                                                <button type="submit" class="btn btn-success" style="width:20%">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                </div>
                <!--.panel-body-->
            </div>
            <!--.panel-->
        </div>
        <!--.col-->
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
        <div class="clearfix"></div>




        <div class="col-md-12">
            <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title">
                    <h4 class="pull-left">List of Target Group </h4>
                    @if(in_array('ADD_EDIT_TARGETGROUP',$permission))
                        <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/campaign/cmp'.$campaign_obj->id.'/targetgroup/add')}}" type="button" class="btn btn-default bv-reset pull-right"> Add Target Group</a>

                        <button type="button" class="btn btn-default bv-reset pull-right" data-toggle="modal"
                                data-target="#myModal_targetgroup">
                            Upload Target Group
                        </button>
                        <h2 class="pull-right">
                            <a href="{{cdn('/excel_template/targetgroup.xls')}}" type="button" class="btn btn-default bv-reset pull-right">
                                Download Target Group Excel Template
                            </a>

                        </h2>

                    @endif

                </div>
                <div id="targetgroup_grid"></div>
            </div>
        </div>
        </div>
            <!-- content -->

        <!--.footer-links-->


    <!-- Modal -->
    <div class="modal fade" id="myModal_targetgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Target Group Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('targetgroup_upload')}}" method="post"
                                      novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@endsection
@section('FooterScripts')
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script src="{{cdn('newTheme/globals/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{cdn('newTheme/globals/scripts/forms-pickers.js')}}"></script>


    <!-- BEGIN INITIALIZATION-->
    <script>
        $(document).ready(function () {
            FormsPickers.init();
        });
    </script>
    <!-- END INITIALIZATION-->

    <script>
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
                        if (response.success == true) {
                            var title = "Success";
                            var color = "#739E73";
                            var icon = "fa fa-check";
                        } else if (response.success == false) {
                            var title = "Warning";
                            var color = "#C46A69";
                            var icon = "fa fa-bell";
                        }
                        ;

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
                @foreach($campaign_obj->Targetgroup as $index)
                {
                    "id": 'tg{{$index->id}}',
                    "name": '{{$index->name}}',
                    @if($index->status == 'Active')
                    "status": '<div class="switcher"><input id="targetgroup{{$index->id}}" onchange="ChangeStatus(`targetgroup`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="targetgroup{{$index->id}}"></label></div>',
                    @elseif($index->status == 'Inactive')
                    "status": '<div class="switcher"><input id="targetgroup{{$index->id}}" onchange="ChangeStatus(`targetgroup`,`{{$index->id}}`)" type="checkbox" hidden><label for="targetgroup{{$index->id}}"></label></div>',
                    @endif
                    "date_modify": '{{$index->updated_at}}',
                    "action": '<a class="btn" href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/targetgroup/tg'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_TARGETGROUP',$permission)) + ' <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/targetgroup/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif




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

                pageSize: 10,
                pageButtonCount: 5,

                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "status", title: "Status", width: 50, align: "center", editing: false},
                    {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                    {name: "action", title: "Edit / +TG", sorting: false, width: 70, align: "center"},
                    {type: "control",
                        deleteButton: false,
                        editButtonTooltip: "Edit",
                        editButton: true
                    }
                ]

            });

        });
    </script>

    <script>
        $(document).ready(function () {

            var $orderForm = $("#order-form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    advertiser_domain_name: {
                        required: true,
                        domain: true
                    },
                    max_impression: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    daily_max_impression: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    max_budget: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    daily_max_budget: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    cpm: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    interested: {
                        required: 'Please select interested service'
                    },
                    budget: {
                        required: 'Please select your budget'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });


            $.ajax({
                url: "{{url('ajax/getAudit/campaign/'.$campaign_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });



        });
        $('#audit_status').change(function () {
            if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/campaign/'.$campaign_obj->id)}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }
        });


    </script>
@endsection