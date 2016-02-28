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
                @if($clone==1)
                    <li>Add Creative </li>
                @else
                    <li>Edit Creative: {{$creative_obj->name}} </li>
                @endif
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
                                    @if($clone==1)
                                        <h2>Add Creative </h2>
                                    @else
                                        <h2>Edit Creative: {{$creative_obj->name}} </h2>
                                    @endif
                                </header>

                                <!-- widget div-->
                                <div class="row">
                                    <!-- widget content -->
                                    <div class="col-md-9">

                                        @if($clone==1)
                                        <form id="order-form" class="smart-form" action="{{URL::route('creative_create')}}" method="post" novalidate="novalidate" >
                                        @else
                                        <form id="order-form" class="smart-form" action="{{URL::route('creative_update')}}" method="post" novalidate="novalidate" >
                                        @endif
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            @if($clone==0)
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="creative_id" value="{{$creative_obj->id}}"/>
                                            @else
                                                <input type="hidden" name="advertiser_id" value="{{$creative_obj->getAdvertiser->id}}"/>
                                            @endif

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
                                                    <section class="col col-3">
                                                        <label for="" class="label">Status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active" @if($creative_obj->status=='Active') checked @endif>
                                                            <i></i>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label for="" class="label">Ad Type</label>
                                                        <label class="select"><i></i>
                                                            <select name="ad_type">
                                                                <option value="0">Select One</option>
                                                                <option value="IFRAME" @if($creative_obj->ad_type=='IFRAME') selected @endif>IFrame</option>
                                                                <option value="JAVASCRIPT" @if($creative_obj->ad_type=='JAVASCRIPT') selected @endif>Javascript</option>
                                                                <option value="XHTML_BANNER_AD" @if($creative_obj->ad_type=='XHTML_BANNER_AD') selected @endif>XHTML Banner Ad</option>
                                                                <option value="XHTML_TEXT_AD" @if($creative_obj->ad_type=='XHTML_TEXT_AD') selected @endif>XHTML Text Ad</option>

                                                            </select>
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


                                                    <section class="col col-4">
                                                        <label class="label">API</label>
                                                        <label class="select select-multiple">
                                                            <select name="api[]" multiple class="custom-scroll">
                                                                <option value="VPAID_1.0" @if(in_array('VPAID_1.0',$api_select)) selected @endif>VPAID 1.0</option>
                                                                <option value="VPAID_2.0" @if(in_array('VPAID_2.0',$api_select)) selected @endif>VPAID 2.0</option>
                                                                <option value="MRAID-1" @if(in_array('MRAID-1',$api_select)) selected @endif> MRAID-1</option>
                                                                <option value="ORMMA" @if(in_array('ORMMA',$api_select)) selected @endif>ORMMA</option>
                                                                <option value="MRAID-2" @if(in_array('MRAID-2',$api_select)) selected @endif>MRAID-2</option>
                                                            </select> </label>
                                                        <div class="note">
                                                            <strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.
                                                        </div>
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
                                    @if($clone==0)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-heading">
                                                <h2 class="pull-left">Activities</h2>
                                                <select id="audit_status" class="pull-right">
                                                    <option value="entity">This Entity</option>
                                                    <option value="all">All</option>
                                                    <option value="user">User</option>
                                                </select>
                                                <div class="clearfix"></div>
                                                <small>All Activities for this Entity </small>
                                            </div>
                                            <div class="card-body" >
                                                <div class="streamline b-l b-accent m-b" id="show_audit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- WIDGET END -->

                                    </div>
                                    @endif
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

            $.ajax({
                url: "{{url('ajax/getAudit/creative/'.$creative_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if($(this).val()=='all'){
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }else if($(this).val()=='entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/creative/'.$creative_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }else if($(this).val()=='user') {
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