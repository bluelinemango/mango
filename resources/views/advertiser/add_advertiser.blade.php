@extends('Layout')
@section('siteTitle')Add Advertiser @endsection
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
                <li>Client: <a href="{{url('/client/cl'.$client_obj->id.'/edit')}}">cl{{$client_obj->id}}</a></li>
                <li>Advertiser Registration</li>
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
                            <div class="well" >
                                <header>
                                    <h2>Add Advertiser </h2>

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('advertiser_create')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="client_id" value="{{$client_obj->id}}">
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
                                                        <label class="label" for=""> Domain Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="domain_name" placeholder="Domain Name">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label for="" class="label">Status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active">
                                                            <i></i>Active
                                                        </label>
                                                    </section>

                                                </div>


                                            </fieldset>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label for="" class="label">Client Name</label>
                                                        <label class="input"><i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="client_name" value="{{$client_obj->name}}" disabled>
                                                        </label>
                                                    </section>


                                                </div>

                                                <section>
                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                        <textarea rows="5" name="description" placeholder="Tell us about your advertiser"></textarea>
                                                    </label>
                                                </section>
                                            </fieldset>
                                            <fieldset>
                                                <div style="margin: 20px 0;">
                                                    <h5>Assign Models</h5>
                                                    <div class="col-xs-5">
                                                        <select name="from_model[]" id="assign_model" class="form-control" size="8" multiple="multiple">
                                                            @foreach($model_obj as $index)
                                                                <option value="{{$index->id}}">{{$index->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-xs-2">
                                                        <button type="button" id="assign_model_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                                        <button type="button" id="assign_model_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                                        <button type="button" id="assign_model_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                                        <button type="button" id="assign_model_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                                    </div>

                                                    <div class="col-xs-5">
                                                        <select name="to_model[]" id="assign_model_to" class="form-control" size="8" multiple="multiple"></select>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

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
    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            pageSetUp();

            $('#assign_model').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
                }
            });

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    },
                    domain_name: {
                        required: true,
                        domain: true
                    },
                    client_id : {
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
                    client_id : {
                        required : 'Please select Client Name'
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