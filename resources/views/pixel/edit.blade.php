@extends('Layout')
@section('siteTitle')Edit Pixel: {{$pixel_obj->name}} @endsection
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
                <li><a href="{{url('/dashboard')}}">Home</a></li>
                <li><a href="{{url('/client/cl'.$pixel_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client: cl{{$pixel_obj->getAdvertiser->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$pixel_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$pixel_obj->advertiser_id.'/edit')}}">Advertiser: adv{{$pixel_obj->advertiser_id}}</a></li>
                <li>Pixel: pxl{{$pixel_obj->id}}</li>
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
                            <div class="well">
                                <header>
                                    <h2><strong>Edit Pixel: {{$pixel_obj->name}} </strong></h2>

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('pixel_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="pixel_id" value="{{$pixel_obj->id}}"/>

                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-2">
                                                        <label class="label" for="">Name (required)</label>

                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$pixel_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input">
                                                            <h6>{{$pixel_obj->getAdvertiser->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input">
                                                            <h6>{{$pixel_obj->getAdvertiser->GetClientID->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Last Modified</label>
                                                        <label class="input">
                                                            <h6>{{$pixel_obj->updated_at}}</h6>
                                                        </label>
                                                    </section>
                                                </div>

                                            </fieldset>
                                            <footer>
                                                <button type="submit" class="btn btn-success">
                                                    Submit
                                                </button>
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


        /* END BASIC */


    </script>
@endsection