@extends('Layout1')
@section('siteTitle')Bulk Editing @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li><a href="#" class="active">Bulk Editing</a></li>
    </ol>
@endsection
@section('headerCss')
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
        .control-label{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Bulk Editing</h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">
                <div class="form-body">
                    <div class="note note-primary note-bottom-striped">
                        <h4>General Informaition</h4>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Entity</label>

                                <select name="role_group" id="show_entity" class="selecter">
                                    <option value="0">Select One</option>
                                    <option value="campaign">Campaign</option>
                                    <option value="targetgroup">Target Group</option>
                                    <option value="creative">Creative</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <!--.form-group-->
                    </div>
                    <hr/>
                </div>

                <div class="clearfix"></div>
                <div id="show_fields"></div>
            </div>

            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
@endsection
@section('FooterScripts')
    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>

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
        $("#show_fields").on("click", ".control-label", function () {
            var id = $(this).attr('for');
            if($('#'+id).is("select")){
                $('#'+id).next().each(function(){
                    $(this).find('.disabled').removeClass('disabled');
                });
            }
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
        });
    </script>

@endsection
