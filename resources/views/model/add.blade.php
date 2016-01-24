@extends('Layout')
@section('siteTitle')Add Model @endsection
@section(('header_extra'))
    <style>
        .github.ribbon {
            position: fixed;
            display: block;
            top: 40px;
            right: 0;
            border: 0;
            z-index: 1001;
        }

        .prettyprint {
            padding: 10px!important;
        }

        #wrap {
            padding-top: 70px;
        }

        #home h1 {
            margin-bottom: 30px;
        }
        #demo,
        #examples,
        #support,
        #download {
            padding-top: 40px;
        }
        fieldset{
            background-color: #fff !important;
        }
    </style>
@endsection
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
                <li>Home</li>
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client:
                        cl{{$advertiser_obj->GetClientID->id}}</a></li>
                <li>
                    <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser:
                        adv{{$advertiser_obj->id}}</a></li>
                <li>Add Model</li>
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
                                    <h2>Model Registration </h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('model_create')}}"
                                              method="post" novalidate="novalidate">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="advertiser_id" value="{{$advertiser_obj->id }}">
                                            <header>
                                                General Information
                                            </header>

                                            <div class="col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label" for=""> Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name">
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input">
                                                            <h6>{{$advertiser_obj->name}}</h6>
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input">
                                                            <h6>{{$advertiser_obj->GetClientID->name}}</h6>
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="well">
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">Model Type</label>
                                                        <label class="select">
                                                            <select name="model_type" id="model_type">
                                                                <option value="0" selected="" disabled="">Select Type
                                                                    ...
                                                                </option>
                                                                <option value="pixel_model">Pixel Model</option>
                                                                <option value="seed_model">Seed Model</option>
                                                            </select> <i></i>
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label" for="">Segment Seed</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="segment_name_seed"
                                                                   placeholder="Segment Name Seed">
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label">Algorithm </label>
                                                        <label class="select">
                                                            <select name="algo">
                                                                <option value="0" selected="" disabled="">Select ALGO
                                                                    ...
                                                                </option>
                                                                <option value="lakers">laker</option>
                                                                <option value="heat">heat</option>
                                                            </select> <i></i>
                                                        </label>

                                                    </section>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">Feature Recency in Second </label>
                                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="feature_recency_in_sec"
                                                                   placeholder="Feature Recency in Sec">
                                                        </label>
                                                    </section>
                                                    <section class="col col-1"></section>
                                                    <section class="col col-2">
                                                        <label class="label">Cut Off Score</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="cut_off_score"
                                                                   placeholder="Cut Off Score">
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="well col-md-12" id="seed_model_div">
                                                <fieldset>
                                                    <section class="col col-3">
                                                        <label class="label">WebSite Seed </label>
                                                        <input name="seed_web_sites" class="form-control tagsinput"
                                                               value="" data-role="tagsinput"
                                                               placeholder="Enter website then click Enter">
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label">Negative Features Requested </label>
                                                        <input name="negative_features_requested" class="tagsinput"
                                                               value="" data-role="tagsinput"
                                                               placeholder="Enter website then click Enter">
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label">Max #Negative Feature</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_number_of_negative_feature_to_pick"
                                                                   placeholder="">
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>


                                            <div class="well col-md-12"  id="pixel_model_div">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">Pixel Hit Recency</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="pixel_hit_recency_in_seconds"
                                                                   placeholder="pixel hit">
                                                        </label>
                                                    </section>

                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <label class="label">All Offer(s)</label>
                                                            <select name="offer_id[]" id="multi_d" class="form-control" size="13" multiple="multiple">
                                                                @foreach($offer_obj as $index)
                                                                <option value="{{$index->id}}">{{$index->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-xs-1" style="margin: 10px 0 0 0">
                                                            <button type="button" id="multi_d_rightAll" class="btn btn-default btn-block" style="margin-top: 20px;"><i class="glyphicon glyphicon-forward"></i></button>
                                                            <button type="button" id="multi_d_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                                            <button type="button" id="multi_d_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                                            <button type="button" id="multi_d_leftAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>

                                                            <hr style="margin: 14px 0 16px;" />

                                                            <button type="button" id="multi_d_rightAll_2" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                                            <button type="button" id="multi_d_rightSelected_2" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                                            <button type="button" id="multi_d_leftSelected_2" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                                            <button type="button" id="multi_d_leftAll_2" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                                        </div>

                                                        <div class="col-xs-3">
                                                            <label class="label">Positive Offer(s)</label>
                                                            <select name="positive_offer_id[]" id="multi_d_to" class="form-control" size="5" multiple="multiple">
                                                            </select>

                                                            <hr style="margin: 14px 0 ;" />

                                                            <label class="label">Negative Offer(s)</label>
                                                            <select name="negative_offer_id[]" id="multi_d_to_2" class="form-control" size="5" multiple="multiple">
                                                            </select>
                                                        </div>
                                                    </div>


                                                </fieldset>
                                            </div>
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">Max #Device history</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_number_of_device_history_per_feature"
                                                                   placeholder="">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label">Max #Both Device </label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="max_num_both_neg_pos_devices"
                                                                   placeholder="Max Number of Both Negative & Posetive Devices">
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">#positive Device</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="number_of_positive_device_to_be_used_for_modeling"
                                                                   placeholder="">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label">#Negative Device</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="number_of_negative_device_to_be_used_for_modeling"
                                                                   placeholder="">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label">#both Device</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="number_of_both_negative_positive_device_to_be_used"
                                                                   placeholder="">
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-12">
                                                <fieldset>
                                                        <section class="col col-4">
                                                            <label class="label">Description </label>
                                                            <label class="textarea"> <i
                                                                        class="icon-append fa fa-comment"></i>
                                                                <textarea rows="8" name="description"
                                                                          placeholder="Tell us about your Campaign"></textarea>
                                                            </label>
                                                        </section>

                                                </fieldset>
                                            </div>
                                            <div class="clearfix"></div>
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
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{cdn('js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>

    <script type="text/javascript">

        $('#model_type').change(function () {
            var val=$('#model_type').val();
            if(val == 'pixel_model'){
                $('#pixel_model_div').show();
                $('#seed_model_div').hide();
            }else if(val == 'seed_model'){
                $('#pixel_model_div').hide();
                $('#seed_model_div').show();
            }
        });
        $(document).ready(function () {
            pageSetUp();
            window.prettyPrint && prettyPrint();

            if ( window.location.hash ) {
                scrollTo(window.location.hash);
            }

            $('.nav').on('click', 'a', function(e) {
                scrollTo($(this).attr('href'));
            });

            $('#multiselect').multiselect();

            $('[name="q"]').on('keyup', function(e) {
                var search = this.value;
                var $options = $(this).next('select').find('option');

                $options.each(function(i, option) {
                    if (option.text.indexOf(search) > -1) {
                        $(option).show();
                    } else {
                        $(option).hide();
                    }
                });
            });

            $('#search').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                }
            });
//
            $('#multi_d').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                },
                right: '#multi_d_to, #multi_d_to_2',
                rightSelected: '#multi_d_rightSelected, #multi_d_rightSelected_2',
                leftSelected: '#multi_d_leftSelected, #multi_d_leftSelected_2',
                rightAll: '#multi_d_rightAll, #multi_d_rightAll_2',
                leftAll: '#multi_d_leftAll, #multi_d_leftAll_2',

                moveToRight: function(Multiselect, options, event, silent, skipStack) {
                    var button = $(event.currentTarget).attr('id');

                    if (button == 'multi_d_rightSelected') {
                        var left_options = Multiselect.left.find('option:selected');
                        Multiselect.right.eq(0).append(left_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
                        }
                    } else if (button == 'multi_d_rightAll') {
                        var left_options = Multiselect.left.find('option');
                        Multiselect.right.eq(0).append(left_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
                        }
                    } else if (button == 'multi_d_rightSelected_2') {
                        var left_options = Multiselect.left.find('option:selected');
                        Multiselect.right.eq(1).append(left_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.right.eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
                        }
                    } else if (button == 'multi_d_rightAll_2') {
                        var left_options = Multiselect.left.find('option');
                        Multiselect.right.eq(1).append(left_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.right.eq(1).eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
                        }
                    }
                },

                moveToLeft: function(Multiselect, options, event, silent, skipStack) {
                    var button = $(event.currentTarget).attr('id');

                    if (button == 'multi_d_leftSelected') {
                        var right_options = Multiselect.right.eq(0).find('option:selected');
                        Multiselect.left.append(right_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                        }
                    } else if (button == 'multi_d_leftAll') {
                        var right_options = Multiselect.right.eq(0).find('option');
                        Multiselect.left.append(right_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                        }
                    } else if (button == 'multi_d_leftSelected_2') {
                        var right_options = Multiselect.right.eq(1).find('option:selected');
                        Multiselect.left.append(right_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                        }
                    } else if (button == 'multi_d_leftAll_2') {
                        var right_options = Multiselect.right.eq(1).find('option');
                        Multiselect.left.append(right_options);

                        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                            Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                        }
                    }
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

    </script>

    <script type="text/javascript">
        function scrollTo( id ) {
            if ( $(id).length ) {
                $('html,body').animate({scrollTop: $(id).offset().top - 40},'slow');
            }
        }
    </script>

@endsection