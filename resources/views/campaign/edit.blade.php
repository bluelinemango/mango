@extends('Layout')
@section('siteTitle')Edit Campaign: {{$campaign_obj->name}} @endsection
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
                <li>Home</li>
                <li>Client: <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a></li>
                <li>Advertiser: <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->advertiser_id.'/edit')}}">adv{{$campaign_obj->advertiser_id}}</a></li>
                <li>Campaign: cmp{{$campaign_obj->id}}</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:
                        <span class="ribbon-button-alignment pull-right">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
            </span>

 -->

        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            @if(isset($errors))
                @foreach($errors->get('msg') as $error)
                    <div class="alert alert-block alert-{{($errors->get('success')[0] == true)?'success':'danger'}}">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
                        <p>
                            {{$error}}
                        </p>
                    </div>
                @endforeach
            @endif
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
                            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
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
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Edit Campaign: {{$campaign_obj->name}} </h2>

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

                                        <form id="order-form" class="smart-form" action="{{URL::route('campaign_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>

                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for="">Name</label>

                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$campaign_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Advertiser Domain Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="advertiser_domain_name" placeholder="Domain Name" value="{{$campaign_obj->advertiser_domain_name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" class="form-control" disabled value="{{$campaign_obj->getAdvertiser->name}}"/>
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" class="form-control" disabled value="{{$campaign_obj->getAdvertiser->GetClientID->name}}"/>
                                                        </label>
                                                    </section>
                                                </div>

                                            </fieldset>
                                            <header>
                                                Budget Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for="">Max Impression</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_impression" placeholder="Max Impression" value="{{$campaign_obj->max_impression}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Daily Max Impression</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="daily_max_impression" placeholder="Daily Max Impression" value="{{$campaign_obj->daily_max_impression}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Max Budget</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_budget" placeholder="Max Budget" value="{{$campaign_obj->max_budget}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Daily Max Budget</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="daily_max_budget" placeholder="Daily Max Budget" value="{{$campaign_obj->daily_max_budget}}">
                                                        </label>
                                                    </section>
                                                </div>
                                                <div class="row">
                                                    <section class="col col-3" >
                                                        <label class="label" for="">cpm name</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="cpm" placeholder="CPM" value="{{$campaign_obj->cpm}}">
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>
                                            <header>
                                                Time Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for="">Start Date</label>
                                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                            <input type="text" name="start_date" id="startdate" placeholder="Expected start date">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">End Date</label>
                                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                            <input type="text" name="end_date" id="finishdate" placeholder="Expected finish date">
                                                        </label>
                                                    </section>
                                                </div>

                                                <section>
                                                    <label class="label" for="">Description</label>
                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                        <textarea rows="5" name="description" placeholder="Tell us about your Campaign">{{$campaign_obj->description}}</textarea>
                                                    </label>
                                                </section>
                                            </fieldset>
                                            <footer>
                                                <button type="submit" class="btn btn-success">
                                                    Submit
                                                </button>
                                                <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/campaign/cmp'.$campaign_obj->id.'/targetgroup/add')}}" class=" btn btn-primary pull-left">
                                                    Add Target Group
                                                </a>
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
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
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

                                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Start Date</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> End Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($campaign_obj->Targetgroup as $index_trg)
                                                <tr>
                                                    <td>trg{{$index_trg->id}}</td>
                                                    <td><a href="{{url('/targetgroup/edit/'.$index_trg->id)}}">{{$index_trg->name}}</a></td>
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
                rules : {
                    name : {
                        required : true
                    },
                    advertiser_id : {
                        required : true
                    },
                    max_impression : {
                        required : true
                    },
                    daily_max_impression : {
                        required : true
                    },
                    max_budget : {
                        required : true
                    },
                    daily_max_budget : {
                        required : true
                    },
                    cpm : {
                        required : true
                    },
                    start_date : {
                        required : true
                    },
                    end_date : {
                        required : true
                    },
                    cpm : {
                        required : true
                    }
                },

                // Messages for form validation
                messages : {
                    name : {
                        required : 'Please enter your name'
                    },
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    phone : {
                        required : 'Please enter your phone number'
                    },
                    interested : {
                        required : 'Please select interested service'
                    },
                    budget : {
                        required : 'Please select your budget'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
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

            var $validator = $("#wizard-1").validate({

                rules: {
                    email: {
                        required: true,
                        email: "Your email address must be in the format of name@domain.com"
                    },
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    postal: {
                        required: true,
                        minlength: 4
                    },
                    wphone: {
                        required: true,
                        minlength: 10
                    },
                    hphone: {
                        required: true,
                        minlength: 10
                    }
                },

                messages: {
                    fname: "Please specify your First name",
                    lname: "Please specify your Last name",
                    email: {
                        required: "We need your email address to contact you",
                        email: "Your email address must be in the format of name@domain.com"
                    }
                },

                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#bootstrap-wizard-1').bootstrapWizard({
                'tabClass': 'form-wizard',
                'onNext': function (tab, navigation, index) {
                    var $valid = $("#wizard-1").valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    } else {
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                                'complete');
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                                .html('<i class="fa fa-check"></i>');
                    }
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
            tablet : 1024,
            phone : 480
        };

        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });

        /* END BASIC */


    </script>
@endsection