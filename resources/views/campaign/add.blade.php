@extends('Layout')
@section('siteTitle')Add Campaign @endsection
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
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client: cl{{$advertiser_obj->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser: adv{{$advertiser_obj->id}}</a></li>
                <li>Campaign Registration</li>
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
                            <div class="well" >
                                <header>
                                    <h2>Campaign Registration </h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class=>

                                        <form id="order-form" class="smart-form" action="{{URL::route('campaign_create')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="advertiser_id" value="{{$advertiser_obj->id}}">
                                            <header>
                                                General Information
                                            </header>

                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-2">
                                                            <label class="label" for="">Name</label>
                                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                                <input type="text" name="name" placeholder="Name">
                                                            </label>
                                                        </section>
                                                        <section class="col col-2">
                                                            <label class="label" for="">Advertiser Name</label>
                                                            <label class="input">
                                                                <h6>{{$advertiser_obj->name}}</h6>
                                                            </label>
                                                        </section>
                                                        <section class="col col-2">
                                                            <label class="label" for="">Client Name</label>
                                                            <label class="input">
                                                                <h6>{{$advertiser_obj->GetClientID->name}}</h6>
                                                            </label>
                                                        </section>
                                                    </div>

                                                    <div class="row">
                                                        <section class="col col-2">
                                                            <label class="label" for="">Domain Name</label>
                                                            <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                                <input type="text" name="advertiser_domain_name" placeholder="Domain Name">
                                                            </label>
                                                        </section>

                                                    </div>
                                                </fieldset>

                                            </div>
                                            <header>
                                                Budget Information
                                            </header>
                                            <div class="well col-md-6 ">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-3">
                                                            <label class="label" for="">Max Impression</label>
                                                            <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                                <input type="text" name="max_impression" placeholder="Max Impression">
                                                            </label>
                                                        </section>
                                                        <section class="col col-3">
                                                            <label class="label" for="">Daily Max Impression</label>
                                                            <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                                <input type="text" name="daily_max_impression" placeholder="Daily Max Impression">
                                                            </label>
                                                        </section>
                                                </fieldset>
                                            </div>
                                            <div class="well col-md-6 ">

                                                <fieldset>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Max Budget</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_budget" placeholder="Max Budget">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Daily Max Budget</label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="daily_max_budget" placeholder="Daily Max Budget">
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="well col-md-6">

                                            <fieldset>
                                                <section class="col col-3" >
                                                    <label class="label" for="">CPM</label>
                                                    <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                        <input type="text" name="cpm" placeholder="CPM">
                                                    </label>
                                                </section>
                                            </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
                                            <header>
                                                Time Information
                                            </header>
                                            <div class="well col-md-6">

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-4">
                                                        <label class="label" for="">Start Date</label>
                                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                            <input type="text" name="start_date" id="startdate" placeholder="Expected start date">
                                                        </label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <label class="label" for="">End Date</label>
                                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                            <input type="text" name="end_date" id="finishdate" placeholder="Expected finish date">
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
                                                        <textarea rows="5" name="description" placeholder="Tell us about your Campaign"></textarea>
                                                    </label>
                                                </section>
                                            </fieldset>
                                            </div>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--antiman button--round-l button--text-medium">
                                                            Submit
                                                        </button>
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
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->
@endsection
@section('FooterScripts')
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

    </script>

@endsection