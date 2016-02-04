@extends('Layout')
@section('siteTitle')Add Creative @endsection
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
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client: cl{{$advertiser_obj->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser: adv{{$advertiser_obj->id}}</a></li>
                <li>Creative Registration</li>
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
                                    <h2>Creative Registration </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('creative_create')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="advertiser_id" value="{{$advertiser_obj->id}}">
                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-2">
                                                        <label class="label" for=""> Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Domain Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="advertiser_domain_name" placeholder="Domain Name">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label for="" class="label">Status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active">
                                                            <i></i>Active
                                                        </label>
                                                    </section>

                                                    <section class="col col-2">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" value="{{$advertiser_obj->name}}" disabled>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" value="{{$advertiser_obj->GetClientID->name}}" disabled>
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>
                                            <header>
                                                URL infromation
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for="">Ad Tag</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="ad_tag" placeholder="Ad Tag">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Landign Page URL</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="landing_page_url" placeholder="Landign Page URL">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Width</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="size_width" placeholder="Width">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Height</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="size_height" placeholder="Height">
                                                        </label>
                                                    </section>
                                                </div>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for="">Attributes</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="attributes" placeholder="Attributes">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Preview URL</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="preview_url" placeholder="Preview URL">
                                                        </label>
                                                    </section>
                                                </div>
                                                <section>
                                                    <label class="label" for="">Description</label>
                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                        <textarea rows="5" name="description" placeholder="Tell us about your Creative"></textarea>
                                                    </label>
                                                </section>
                                            </fieldset>
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
                    advertiser_domain_name : {
                        required: true,
                        domain: true
                    },
                    ad_tag : {
                        required : true
                    },
                    landing_page_url : {
                        required : true
                    },
                    size_width : {
                        required : true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    size_height : {
                        required : true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    attributes : {
                        required : true
                    },
                    preview_url : {
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