@extends('Layout')
@section('siteTitle')Bulk Editing @endsection
@section('header_extra')
    <style>
        .time_table_unselect {
            background-color: rgba(19, 222, 230, 0.45);
            min-height: 30px;
            min-width: 30px;
            cursor: pointer;
        }

        .time-table-div-select {
            background-color: rgba(71, 78, 170, 0.98);
            min-height: 30px;
            min-width: 30px;
            cursor: pointer
        }

        input:-moz-read-only {
            /* For Firefox */
            background-color: yellow !important;
        }

        select:disabled, textarea:disabled ,input:disabled , input:disabled + i {
            background-color: yellow !important;
        }
        .label{
            cursor: pointer;
        }
    </style>
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
                        <div class="well" id="wid-id-3">
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
                                                <label for="show_entity" class="label">Select Entity</label>
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
                <input id="name" name="name" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="category">Category:</label>
                <input id="category" name="category" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="type">Type:</label>
                <input id="type" name="type" type="text"/>
            </div>
            <div class="details-form-field">
                <label for="daily_limit">Daily Limit:</label>
                <input id="daily_limit" name="daily_limit" type="text"/>
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
                    url: "{{url('ajax/getTargetgroup')}}"
                }).success(function (response) {
                    $('#show_fields').html(response);

                });
            } else if ($(this).val() == 'creative') {
                $.ajax({
                    url: "{{url('ajax/getCreative')}}"
                }).success(function (response) {
                    $('#show_fields').html(response);
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
        $("#show_fields").on("click", ".label", function () {
            var id = $(this).attr('for');
            if(!$('#'+id).prop('disabled')){
                $('#'+id).prop('disabled', true)
            }else {
                $('#' + id).removeAttr('disabled');
            }
        });

        /////////////Target Group/////////////////
        function ShowSubCategory(id) {
            $.ajax({
                url: "{{url('/get_iab_sub_category')}}" + '/' + id
            }).success(function (response) {
                $('#iab_sub_category').html(response);
            });
        }
        function taggleBWList(type) {
            if (type == 'blacklist') {
                jQuery('#assign_whitelist_leftAll').click();
            }
            if (type == 'whitelist') {
                jQuery('#assign_blacklist_leftAll').click();
            }
        }
        /////////////End Target Group/////////////////

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            pageSetUp();
        });
    </script>

@endsection
