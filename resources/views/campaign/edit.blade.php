@extends('Layout')
@section('siteTitle')Edit Campaign: {{$campaign_obj->name}} @endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"
                          rel="tooltip" data-placement="bottom"
                          data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings."
                          data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client: cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a>
                </li>
                <li>
                    <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->advertiser_id.'/edit')}}">Advertiser: adv{{$campaign_obj->advertiser_id}}</a>
                </li>
                <li>Campaign: cmp{{$campaign_obj->id}}</li>
            </ol>
            <!-- end breadcrumb -->


        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            {{--REAL TIME INFO--}}
            @if(isset($real_time))
            <div class="row">
                <div class="col-md-2">
                    <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #00c0ef " >
                        <i class="fa fa-eye" ></i>
                    </span>
                        <div class="real-time-content">
                            Imps to Now:
                            <br/>
                            <strong>{{$real_time[0]->impressions_shown_today_until_now}}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #dd4b39 " >
                        <i class="fa fa-eye" ></i>
                    </span>
                        <div class="real-time-content">
                            Total Imps:
                            <br/>
                            <strong>{{$real_time[0]->total_impression_show_until_now}}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #00a65a " >
                        <i class="fa fa-dollar" ></i>
                    </span>
                        <div class="real-time-content">
                            Budget to Now:
                            <br/>
                            <strong>{{$real_time[0]->daily_budget_spent_today_until_now}}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #f39c12 " >
                        <i class="fa fa-dollar" ></i>
                    </span>
                        <div class="real-time-content">
                            Total Budget:
                            <br/>
                            <strong>{{$real_time[0]->total_budget_spent_until_now}}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="real-time-box">
                    <span class="real-time-icon" style="background-color: #f39c12 " >
                        <i class="fa fa-gear" ></i>
                    </span>
                        <div class="real-time-content">
                            Last Shown:
                            <br/>
                            <strong>{{$real_time[0]->last_time_ad_shown}}</strong>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                                    <h2><strong>Edit Campaign: {{$campaign_obj->name}} </strong></h2>

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form"
                                              action="{{URL::route('campaign_update')}}" method="post"
                                              novalidate="novalidate">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>

                                            <header>
                                                General Information
                                            </header>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Name (required)</label>

                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
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
                                                    <section class="col col-2">
                                                        <label class="label" for="">Domain Name</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="advertiser_domain_name"
                                                                   placeholder="Domain Name"
                                                                   value="{{$campaign_obj->advertiser_domain_name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label for="" class="label">status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active" @if($campaign_obj->status=='Active') checked @endif>
                                                            <i></i>Active Status
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
                                            <div class="clearfix"></div>
                                            <header>
                                                Date Rang
                                            </header>
                                            <div class="well col-md-6">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-4">
                                                            <label class="label" for="">Start Date</label>
                                                            <label class="input"> <i
                                                                        class="icon-append fa fa-calendar"></i>
                                                                <input type="text" name="start_date" id="startdate"
                                                                       placeholder="Expected start date"
                                                                       value="{{$campaign_obj->start_date}}">
                                                            </label>
                                                        </section>
                                                        <section class="col col-4">
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
                                                <section class="col col-4">
                                                    <label class="label" for="">Description</label>
                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                        <textarea rows="5" name="description"
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
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0"
                                 data-widget-editbutton="false">
                                <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"

                            -->
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>

                                    <h2>List Of Target Group </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">

                                        <table id="dt_basic" class="table table-striped table-bordered table-hover"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i
                                                            class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>
                                                    Name
                                                </th>
                                                <th data-hide="phone,tablet"><i
                                                            class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>
                                                    Start Date
                                                </th>
                                                <th data-hide="phone,tablet"><i
                                                            class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>
                                                    End Date
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($campaign_obj->Targetgroup as $index_trg)
                                                <tr>
                                                    <td>trg{{$index_trg->id}}</td>
                                                    <td>
                                                        <a href="{{url('/targetgroup/edit/'.$index_trg->id)}}">{{$index_trg->name}}</a>
                                                    </td>
                                                    <td>{{$index_trg->start_date}}</td>
                                                    <td>{{$index_trg->end_date}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

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
    <script src="{{cdn('js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>


    <script>
        $(document).ready(function () {

            pageSetUp();


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


            // fuelux wizard
            var wizard = $('.wizard').wizard();

            wizard.on('finished', function (e, data) {
                //$("#fuelux-wizard").submit();
                //console.log("submitted!");
                $.smallBox({
                    title: "Congratulations! Your form was submitted",
                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                    color: "#5F895F",
                    iconSmall: "fa fa-check bounce animated",
                    timeout: 4000
                });

            });


        })

        /* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });

        /* END BASIC */


    </script>
@endsection