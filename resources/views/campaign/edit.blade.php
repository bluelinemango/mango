@extends('Layout')
@section('siteTitle')Edit Campaign: {{$campaign_obj->name}} @endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client:
                        cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a>
                </li>
                <li>
                    <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->advertiser_id.'/edit')}}">Advertiser:
                        adv{{$campaign_obj->advertiser_id}}</a>
                </li>
                @if($clone==1)
                    <li>Add Campaign</li>
                @else
                    <li>Campaign: cmp{{$campaign_obj->id}}</li>
                @endif
            </ol>
            <!-- end breadcrumb -->


        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            {{--REAL TIME INFO--}}
            {{--END REAL TIME INFO--}}



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
                                    @if($clone==1)
                                        <h2><strong>Add Campaign </strong></h2>
                                    @else
                                        <h2><strong>Edit Campaign: {{$campaign_obj->name}} </strong></h2>
                                    @endif
                                </header>

                                <!-- widget div-->
                                <div class="row">
                                    <!-- widget content -->
                                    <div class="col-md-9">

                                        @if($clone==1)
                                            <form id="order-form" class="smart-form"
                                              action="{{URL::route('campaign_create')}}" method="post"
                                              novalidate="novalidate">
                                        @else
                                            <form id="order-form" class="smart-form"
                                                  action="{{URL::route('campaign_update')}}" method="post"
                                                  novalidate="novalidate">
                                        @endif
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                                       @if($clone==0)
                                            <input type="hidden" name="_method" value="PUT"/>
                                            @endif
                                            <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>

                                            <header>
                                                Real Time Information
                                            </header>

                                            <div class="well col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #00c0ef ">
                        <i class="fa fa-eye"></i>
                    </span>

                                                            <div class="real-time-content">
                                                                Imps to Now:
                                                                <br/>
                                                                <strong>{{(isset($real_time[0])) ? $real_time[0]->impressions_shown_today_until_now : '0'}}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #dd4b39 ">
                        <i class="fa fa-eye"></i>
                    </span>

                                                            <div class="real-time-content">
                                                                Total Imps:
                                                                <br/>
                                                                <strong>{{(isset($real_time[0])) ? $real_time[0]->total_impression_show_until_now : '0'}}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #00a65a ">
                        <i class="fa fa-dollar"></i>
                    </span>

                                                            <div class="real-time-content">
                                                                Budget to Now:
                                                                <br/>
                                                                <strong>{{(isset($real_time[0])) ? $real_time[0]->daily_budget_spent_today_until_now : '0'}}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #f39c12 ">
                        <i class="fa fa-dollar"></i>
                    </span>

                                                            <div class="real-time-content">
                                                                Total Budget:
                                                                <br/>
                                                                <strong>{{(isset($real_time[0])) ? $real_time[0]->total_budget_spent_until_now : '0'}}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #f39c12 ">
                        <i class="fa fa-gear"></i>
                    </span>

                                                            <div class="real-time-content">
                                                                Last Shown:
                                                                <br/>
                                                                {{(isset($real_time[0])) ? $real_time[0]->last_time_ad_shown : '0'}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <header>
                                                General Information
                                            </header>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label class="label" for="">Name (required)</label>

                                                        <label class="input">
                                                            <input type="text" name="name" placeholder="Name"
                                                                   value="{{$campaign_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input">
                                                            <h6>{{$campaign_obj->getAdvertiser->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input">
                                                            <h6>{{$campaign_obj->getAdvertiser->GetClientID->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Last Modified</label>
                                                        <label class="input">
                                                            <h6>{{$campaign_obj->updated_at}}</h6>
                                                        </label>
                                                    </section>

                                                </fieldset>
                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label class="label" for="">Domain Name</label>
                                                        <label class="input">
                                                            <input type="text" name="advertiser_domain_name"
                                                                   placeholder="Domain Name"
                                                                   value="{{$campaign_obj->advertiser_domain_name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label for="" class="label">Status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox"
                                                                   name="active" @if($campaign_obj->status=='Active')
                                                                   checked @endif>
                                                            <i></i>
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <header>
                                                Budget Information
                                            </header>
                                            <div class="well col-md-6">
                                                <fieldset>
                                                    <section class="col col-5">
                                                        <label class="label" for="">Max Impression</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_impression"
                                                                   placeholder="Max Impression"
                                                                   value="{{$campaign_obj->max_impression}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-5">
                                                        <label class="label" for="">Daily Max Impression</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="daily_max_impression"
                                                                   placeholder="Daily Max Impression"
                                                                   value="{{$campaign_obj->daily_max_impression}}">
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="well col-md-6 ">
                                                <fieldset>
                                                    <section class="col col-5">
                                                        <label class="label" for="">Max Budget</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_budget"
                                                                   placeholder="Max Budget"
                                                                   value="{{$campaign_obj->max_budget}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-5">
                                                        <label class="label" for="">Daily Max Budget</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="daily_max_budget"
                                                                   placeholder="Daily Max Budget"
                                                                   value="{{$campaign_obj->daily_max_budget}}">
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="well col-md-6">

                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label class="label" for="">cpm</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="cpm" placeholder="CPM"
                                                                   value="{{$campaign_obj->cpm}}">
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="well col-md-6">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="label" for="">Start Date</label>
                                                            <label class="input"> <i
                                                                        class="icon-append fa fa-calendar"></i>
                                                                <input type="text" name="start_date" id="startdate"
                                                                       placeholder="Expected start date"
                                                                       value="{{$campaign_obj->start_date}}">
                                                            </label>
                                                        </section>
                                                        <section class="col col-6">
                                                            <label class="label" for="">End Date</label>
                                                            <label class="input"> <i
                                                                        class="icon-append fa fa-calendar"></i>
                                                                <input type="text" name="end_date" id="finishdate"
                                                                       placeholder="Expected finish date"
                                                                       value="{{$campaign_obj->end_date}}">
                                                            </label>
                                                        </section>
                                                    </div>

                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-8">
                                                        <label class="label" for="">Description</label>
                                                        <label class="textarea"> <i
                                                                    class="icon-append fa fa-comment"></i>
                                                        <textarea rows="3" name="description"
                                                                  placeholder="Tell us about your Campaign">{{$campaign_obj->description}}</textarea>
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--ujarak button--border-thick button--text-upper button--size-s button--inverted button--text-thick">
                                                            Save
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3 pull-right ">
                                                        @if(in_array('ADD_EDIT_TARGETGROUP',$permission))
                                                            <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/campaign/cmp'.$campaign_obj->id.'/targetgroup/add')}}"
                                                               class=" btn btn-primary pull-right">
                                                                Add Target Group
                                                            </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </footer>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-heading">
                                                <h2 class="pull-left">Activities</h2>
                                                <select id="audit_status" class="pull-right">
                                                    <option value="entity">This Entity</option>
                                                    <option value="entity">This Entity</option>
                                                    <option value="all">All</option>
                                                    <option value="user">User</option>
                                                </select>

                                                <div class="clearfix"></div>
                                                <small>All Activities for this Entity</small>
                                            </div>
                                            <div class="card-body">
                                                <div class="streamline b-l b-accent m-b" id="show_audit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- WIDGET END -->

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
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <header>
                                    <h2>List of Target Group </h2>
                                </header>
                                <div id="targetgroup_grid"></div>
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

    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>


    <script>
        $(document).ready(function () {

            pageSetUp();

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
                        "campaign_name": '<a href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/edit')}}">{{$index->getCampaign->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<a id="targetgroup{{$index->id}}" href="javascript: ChangeStatus(`targetgroup`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="targetgroup{{$index->id}}" href="javascript: ChangeStatus(`targetgroup`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
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

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {
                            name: "campaign_name",
                            title: "Campaign",
                            type: "text",
                            width: 70,
                            align: "center",
                            editing: false
                        },
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit / +TG", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    advertiser_domain_name: {
                        required: true,
                        domain: true
                    },
                    advertiser_id: {
                        required: true
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
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true
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

            // START AND FINISH DATE
            $('#startdate').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#finishdate').datepicker('option', 'minDate', selectedDate);
                }
            });

            $('#finishdate').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#startdate').datepicker('option', 'maxDate', selectedDate);
                }
            });


            $.ajax({
                url: "{{url('ajax/getAudit/campaign/'.$campaign_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'all') {
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                } else if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/campaign/'.$campaign_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                } else if ($(this).val() == 'user') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/user')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });


        })


    </script>
@endsection