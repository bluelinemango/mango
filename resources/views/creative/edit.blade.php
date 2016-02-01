@extends('Layout')
@section('siteTitle')Edit Creative: {{$creative_obj->name}} @endsection
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
                <li><a href="{{url('/client/cl'.$creative_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client : cl{{$creative_obj->getAdvertiser->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$creative_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$creative_obj->advertiser_id.'/edit/')}}">Advertiser : adv{{$creative_obj->getAdvertiser->id}}</a></li>
                <li>Edit Creative: {{$creative_obj->name}} </li>
            </ol>
            <!-- end breadcrumb -->

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
                            <div class="well">
                                <header>
                                    <h2>Edit Creative: {{$creative_obj->name}} </h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('creative_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="creative_id" value="{{$creative_obj->id}}"/>

                                            <header>
                                                General Information
                                            </header>

                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$creative_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input">
                                                            <h6>{{$creative_obj->getAdvertiser->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input">
                                                            <h6>{{$creative_obj->getAdvertiser->GetClientID->name}}</h6>
                                                        </label>
                                                    </section>
                                                </fieldset>
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Domain Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="advertiser_domain_name" placeholder="Domain Name" value="{{$creative_obj->advertiser_domain_name}}">
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <header>
                                                URL infromation
                                            </header>

                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-3">
                                                            <label class="label" for="">Landign Page URL</label>
                                                            <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                                <input type="text" name="landing_page_url" placeholder="Landign Page URL" value="{{$creative_obj->landing_page_url}}">
                                                            </label>
                                                        </section>
                                                        <?php $size = explode('x',$creative_obj->size);?>
                                                        <section class="col col-1"></section>
                                                        <section class="col col-2">
                                                            <label class="label" for="">Width</label>
                                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                                <input type="text" name="size_width" placeholder="Width" value="{{$size[0]}}">
                                                            </label>
                                                        </section>
                                                        <section class="col col-1"></section>
                                                        <section class="col col-2">
                                                            <label class="label" for="">Height</label>
                                                            <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                                <input type="text" name="size_height" placeholder="Height" value="{{$size[1]}}">
                                                            </label>
                                                        </section>
                                                    </div>
                                                    <div class="row">
                                                        <section class="col col-3">
                                                            <label class="label" for="">Attributes</label>
                                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                                <input type="text" name="attributes" placeholder="Attributes" value="{{$creative_obj->attributes}}">
                                                            </label>
                                                        </section>
                                                        <section class="col col-1"></section>
                                                        <section class="col col-3">
                                                            <label class="label" for="">Preview URL</label>
                                                            <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                                <input type="text" name="preview_url" placeholder="Preview URL" value="{{$creative_obj->preview_url}}">
                                                            </label>
                                                        </section>
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label class="label" for="">Ad Tag</label>
                                                        <label class="textarea"> <i class="icon-append fa fa-user"></i>
                                                            <textarea rows="5" name="ad_tag" placeholder="Tell us about your Creative">
                                                                {{$creative_obj->ad_tag}}</textarea>
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label class="label" for="">Description</label>
                                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                            <textarea rows="5" name="description" placeholder="Tell us about your Creative">{{$creative_obj->description}}</textarea>
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
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
                        required : true,
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