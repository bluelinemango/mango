@extends('Layout')
@section('siteTitle')Bulk Editing @endsection
@section('header_extra')
@endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">


            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Bulk Editing</li>
            </ol>

        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">


            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="well" id="wid-id-3" >
                            <header>
                                <h2>Bulk Editing</h2>
                            </header>

                            <!-- widget div-->
                            <div class="row">

                                <!-- widget content -->
                                <div class="col-md-12">
                                    <div class="smart-form">
                                    <fieldset>
                                    <section class="col col-3">
                                        <label for="" class="label">Select Entity</label>
                                        <label class="select"><i></i>
                                            <select name="role_group" id="show_entity">
                                                <option value="0">Select One</option>
                                                <option value="campaign">Campaign</option>
                                                <option value="targetgroup">Target Group</option>
                                                <option value="creative">Creative</option>
                                            </select>
                                        </label>
                                    </section>
                                    </fieldset>
                                    <div class="clearfix"></div>
                                        <div id="show_fields"></div>

                                    </div>
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


    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="name">Name:</label>
                <input id="name" name="name" type="text" />
            </div>
            <div class="details-form-field">
                <label for="category">Category:</label>
                <input id="category" name="category" type="text" />
            </div>
            <div class="details-form-field">
                <label for="type">Type:</label>
                <input id="type" name="type" type="text" />
            </div>
            <div class="details-form-field">
                <label for="daily_limit">Daily Limit:</label>
                <input id="daily_limit" name="daily_limit" type="text" />
            </div>
            <div class="details-form-field">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('FooterScripts')
<script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#show_entity').change(function () {
            if ($(this).val() == 'campaign') {
                $.ajax({
                    url: "{{url('ajax/getCampaign')}}"
                }).success(function (response) {
                    $('#show_fields').html(response);
                    var $orderForm = $("#order-form").validate({
                        rules: {
                            name: {
                                required: true
                            },
                            advertiser_domain_name: {
                                required: true,
                                domain: true
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
                });
            } else if ($(this).val() == 'targetgroup') {
                $.ajax({
                    url: "{{url('ajax/getCampaign')}}"
                }).success(function (response) {
                    $('#show_fields').html(response);
                });
            } else if ($(this).val() == 'creative') {
                $.ajax({
                    url: "{{url('ajax/getCreative')}}"
                }).success(function (response) {
                    $('#show_fields').html(response);
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
                            ad_tag: {
                                required: true
                            },
                            landing_page_url: {
                                required: true
                            },
                            size_width: {
                                required: true,
                                min: 0,
                                number: 'Enter number Plz'
                            },
                            size_height: {
                                required: true,
                                min: 0,
                                number: 'Enter number Plz'
                            },
                            attributes: {
                                required: true
                            },
                            preview_url: {
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
                });
            }
        });


    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            pageSetUp();
        });
    </script>

@endsection
