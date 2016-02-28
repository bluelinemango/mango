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
                                <div class="row">
                                    <!-- widget content -->
                                    <div class="col-md-9">

                                        <form id="order-form" class="smart-form" action="{{URL::route('pixel_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="pixel_id" value="{{$pixel_obj->id}}"/>

                                            <header>
                                                General Information
                                            </header>

                                            <div class="well">
                                            <fieldset>
                                                <section class="col col-3">
                                                    <label class="label" for="">Name (required)</label>

                                                    <label class="input">
                                                        <input type="text" name="name" placeholder="Name" value="{{$pixel_obj->name}}">
                                                    </label>
                                                </section>
                                                <section class="col col-2">
                                                    <label for="" class="label">Status</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="active" @if($pixel_obj->status=='Active') checked @endif>
                                                        <i></i>
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
                                            </fieldset>
                                            </div>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--ujarak button--border-thick button--text-upper button--size-s button--inverted button--text-thick">
                                                            Save
                                                        </button>
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

            $.ajax({
                url: "{{url('ajax/getAudit/pixel/'.$pixel_obj->id)}}"
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
                        url: "{{url('ajax/getAudit/pixel/'.$pixel_obj->id)}}"
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

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    advertiser_id: {
                        required: true
                    },
                    max_impression: {
                        required: true
                    },
                    daily_max_impression: {
                        required: true
                    },
                    max_budget: {
                        required: true
                    },
                    daily_max_budget: {
                        required: true
                    },
                    cpm: {
                        required: true
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true
                    },
                    cpm: {
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


        })

        /* END BASIC */


    </script>
@endsection