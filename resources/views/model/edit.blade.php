@extends('Layout1')
@section('siteTitle')Edit Model: {{$model_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$model_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client: cl{{$model_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$model_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$model_obj->advertiser_id.'/edit')}}">Advertiser: adv{{$model_obj->advertiser_id}}</a>
        </li>
        <li><a href="#" class="active">Model: mdl{{$model_obj->id}}</a></li>
    </ol>
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Edit Model: {{$model_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                                  action="{{URL::route('model_update')}}" method="post"
                                  novalidate="novalidate">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT"/>
                                    <input type="hidden" name="model_id" value="{{$model_obj->id}}"/>
                                <div class="form-body">
                                    <div class="note note-primary note-bottom-striped">
                                        <h4>General Informaition</h4>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" id="name" name="name" placeholder="Name"
                                                               class="form-control" value="{{$model_obj->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="control-label">Status</label>

                                                <div class="checkboxer">
                                                    <input type="checkbox" name="active"
                                                           class="switchery-teal" @if($model_obj->status=='Active')
                                                           checked @endif>
                                                    <label for="check1">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label" for="">Advertiser Name</label>
                                            <h5>{{$model_obj->getAdvertiser->name}}</h5>

                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label" for="">Client Name</label>
                                            <h5>{{$model_obj->getAdvertiser->GetClientID->name}}</h5>

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label" for="">Last Modified</label>
                                            <h5>{{$model_obj->updated_at}}</h5>

                                        </div>

                                        <div class="clearfix"></div>
                                        <!--.form-group-->
                                    </div>
                                    <hr/>
                                    <div class="note note-info note-bottom-striped">
                                        <h4>?????</h4>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="landing_page_url" class="control-label">Segment Name Seed</label>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="segment_name_seed"
                                                               placeholder="Segment Name Seed" value="{{$model_obj->segment_name_seed}}" id="segment_name_seed" class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Algorithm</label>

                                                <div class="">
                                                    <select name="algo" class="selecter">
                                                        <option value="0" selected="" disabled="">Select ALGO
                                                            ...
                                                        </option>
                                                        <option value="lakers" @if($model_obj->algo=='lakers') selected @endif>lakers</option>
                                                        <option value="heat" @if($model_obj->algo=='heat') selected @endif>heat</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label class="control-label">Feature Recency in Sec</label>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="feature_recency_in_sec" value="{{$model_obj->feature_recency_in_sec}}" class="form-control" id="feature_recency_in_sec"
                                                               placeholder="Feature Recency in Sec">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label class="control-label">Cut Off Score</label>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="cut_off_score"
                                                               value="{{$model_obj->cut_off_score}}"
                                                               placeholder="Cut Off Score" class="form-control" id="cut_off_score">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <hr/>
                                    <div class="note note-warning note-bottom-striped">
                                        <div class="col-md-3">
                                            <label class="control-label" for="">#Negative Device Used</label>
                                            <h5>{{$model_obj->num_neg_devices_used}}</h5>

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label" for="">#Positive Device Used</label>
                                            <h5>{{$model_obj->num_pos_devices_used}}</h5>

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label" for="">Process Result</label>
                                            <h5>{{$model_obj->process_result}}</h5>

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label" for="">Negative Feature used</label>
                                            <h5>{{$model_obj->negative_feature_used}}</h5>

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label" for="">Positive Feature used</label>
                                            <h5>{{$model_obj->positive_feature_used}}</h5>

                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <hr/>

                                    <div class="col-md-6 note note-warning note-bottom-striped">
                                        <h4>Feature Score Map</h4>
                                        <div id="feature_score_map_grid"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6 note note-warning note-bottom-striped">
                                        <h4>Top Feature Score Map</h4>
                                        <div id="top_feature_score_map_grid"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <hr/>
                                    <div class="clearfix"></div>
                                    @if($model_obj->model_type=='seed_model')
                                    <div class="note note-warning note-bottom-striped" id="seed_model_div">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">WebSite Seed </label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input name="seed_web_sites" class="form-control tagsinput"
                                                               value="{{json_decode($model_obj->seed_web_sites)}}" data-role="tagsinput" class="form-control" id="seed_web_sites"
                                                               placeholder="Enter website then click Enter">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Negative Features Requested </label>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input name="negative_features_requested" class="tagsinput"
                                                               value="{{json_decode($model_obj->negative_features_requested)}}" data-role="tagsinput" class="form-control" id="negative_features_requested"
                                                               placeholder="Enter website then click Enter">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Max #Negative Feature</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="max_number_of_negative_feature_to_pick" value="{{$model_obj->max_number_of_negative_feature_to_pick}}"
                                                               placeholder="Max Number of Negative Feature to Pick" rel="tooltip" data-placement="top" data-original-title="Max Number of Negative Feature to Pick" class="form-control" id="max_number_of_negative_feature_to_pick">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">WebSite Seed </label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input name="seed_web_sites" class="form-control tagsinput"
                                                               value="{{json_decode($model_obj->seed_web_sites)}}" data-role="tagsinput" class="form-control" id="seed_web_sites"
                                                               placeholder="Enter website then click Enter">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                        <hr/>

                                    @elseif($model_obj->model_type=='pixel_model')
                                    <div class="note note-warning note-bottom-striped" id="pixel_model_div">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Pixel Hit Recency</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="pixel_hit_recency_in_seconds" value="{{$model_obj->pixel_hit_recency_in_seconds}}" class="form-control" id="pixel_hit_recency_in_seconds"
                                                               placeholder="pixel hit">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="col-xs-3">
                                                <label class="control-label">All Offer(s)</label>
                                                <select name="offer_id[]" id="multi_d" class="form-control" size="13" multiple="multiple">
                                                    @foreach($offer_obj as $index)
                                                        {{--@if(!in_array($index->id,$positive_offer_id) and  !in_array($index->id,$negative_offer_id))--}}
                                                        <option value="{{$index->id}}">{{$index->name}}</option>
                                                        {{--@endif--}}
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
                                                <label class="control-label">Positive Offer(s)</label>
                                                <select name="positive_offer_id[]" id="multi_d_to" class="form-control" size="5" multiple="multiple">
                                                    @foreach($offer_obj as $index)
                                                        @if(in_array($index->id,$positive_offer_id) )
                                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                <hr style="margin: 14px 0 ;" />

                                                <label class="control-label">Negative Offer(s)</label>
                                                <select name="negative_offer_id[]" id="multi_d_to_2" class="form-control" size="5" multiple="multiple">
                                                    @foreach($offer_obj as $index)
                                                        @if(in_array($index->id,$negative_offer_id) )
                                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                        <hr/>

                                    @endif
                                    <div class="note note-warning note-bottom-striped">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Max #Device history</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="max_number_of_device_history_per_feature" value="{{$model_obj->max_number_of_device_history_per_feature}}" id="max_number_of_device_history_per_feature" class="form-control"
                                                               placeholder="" rel="tooltip" data-placement="top" data-original-title="Max Number of Device History per Feature">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Max #Both Device </label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="max_num_both_neg_pos_devices" value="{{$model_obj->max_num_both_neg_pos_devices}}" id="max_num_both_neg_pos_devices" class="form-control"
                                                               placeholder="Max Number of Both Negative & Posetive Devices" rel="tooltip" data-placement="top" data-original-title="Max Number of Both Negative & Posetive Devices">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">#positive Device</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="number_of_positive_device_to_be_used_for_modeling" value="{{$model_obj->number_of_positive_device_to_be_used_for_modeling}}" class="form-control" id="number_of_positive_device_to_be_used_for_modeling"
                                                               placeholder="Number of Positive Device to be used" rel="tooltip" data-placement="top" data-original-title="Number of Positive Device to be used ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">#Negative Device</label>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="number_of_negative_device_to_be_used_for_modeling" value="{{$model_obj->number_of_negative_device_to_be_used_for_modeling}}" id="number_of_negative_device_to_be_used_for_modeling" class="form-control"
                                                               placeholder="Number of Negative Device to be used " rel="tooltip" data-placement="top" data-original-title="Number of Negative Device to be used ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">#both Device</label>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="number_of_both_negative_positive_device_to_be_used" value="{{$model_obj->number_of_both_negative_positive_device_to_be_used}}" id="number_of_both_negative_positive_device_to_be_used" class="form-control"
                                                               placeholder="Number of both Negative Positive Device to be used " rel="tooltip" data-placement="top" data-original-title="Number of both Negative Positive Device to be used ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <hr/>
                                    <div style="padding: 15px">

                                        <div class="form-group">
                                            <label class="control-label">Description</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <textarea name="description" class="form-control" rows="3"
                                                              placeholder="type minimum 5 characters"
                                                              required>{{$model_obj->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                                            <button type="submit" class="btn btn-success" style="width:20%">Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
    <!--.col-->

        <div class="col-md-3">
            <div class="panel indigo">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class="pull-left">Activities</h4>

                        <div class="pull-right audit-select">
                            <select id="audit_status" class="selecter col-md-12">
                                <option value="entity">This Entity</option>
                                <option value="all">All</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body" style="padding: 0px 0 0 10px;">
                    <div class="timeline single" id="show_audit">
                    </div>
                    <!--.timeline-->
                </div>
                <!--.panel-body-->
            </div>
            <!--.panel-->
        </div>
                <!--.col-->
        <div class="clearfix"></div>

@endsection
@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{cdn('js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            FormsSwitchery.init();

            $.ajax({
                url: "{{url('ajax/getAudit/model/'.$model_obj->id)}}"
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
                        url: "{{url('ajax/getAudit/model/'.$model_obj->id)}}"
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




            @if(!is_null(json_decode($model_obj->feature_score_map)))
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.feature_score_map, function (feature_score_map) {
                            return (!filter.name || feature_score_map.name.indexOf(filter.name) > -1)
                                    && (!filter.score || feature_score_map.score.indexOf(filter.score) > -1);
                        });
                    }

                };

                window.db = db;

                db.feature_score_map = [
                    @foreach(json_decode($model_obj->feature_score_map) as $key => $value)
                    {
                        "name": '{{$key}}',
                        "score":'{{$value}}'
                    },
                    @endforeach
                ];

                $("#feature_score_map_grid").jsGrid({
                    width: "100%",
                    filtering: true,
                    editing: false,
                    sorting: true,
                    paging: true,
                    autoload: true,
                    pageSize: 10,
                    pageButtonCount: 5,
                    controller: db,
                    fields: [
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "score", title: "Score", type: "text", width: 50, align: "center",editing:false}
                    ]

                });

            });
            @endif
            @if(!is_null(json_decode($model_obj->top_feature_score_map)))
            $(function () {

                var db1 = {

                    loadData: function (filter) {
                        return $.grep(this.top_feature_score_map, function (top_feature_score_map) {
                            return (!filter.name || top_feature_score_map.name.indexOf(filter.name) > -1)
                                    && (!filter.score || top_feature_score_map.score.indexOf(filter.score) > -1);
                        });
                    }

                };

                window.db = db1;

                db1.top_feature_score_map = [
                    @foreach(json_decode($model_obj->top_feature_score_map) as $key => $value)
                    {
                        "name": '{{$key}}',
                        "score":'{{$value}}'
                    },
                    @endforeach
                ];

                $("#top_feature_score_map_grid").jsGrid({
                    width: "100%",
                    filtering: true,
                    editing: false,
                    sorting: true,
                    paging: true,
                    autoload: true,
                    pageSize: 10,
                    pageButtonCount: 5,
                    controller: db1,
                    fields: [
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "score", title: "Score", type: "text", width: 50, align: "center",editing:false}
                    ]

                });

            });

            @endif

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
                rules : {
                    name: {
                        required: true
                    },
                    advertiser_id: {
                        required: true
                    },
                    segment_name_seed: {
                        required: true
                    },
                    daily_max_impression: {
                        required: true
                    },
                    algo: {
                        required: true
                    },
                    model_type: {
                        required: true
                    },
                    feature_recency_in_sec: {
                        required: true
                    },
                    cut_off_score: {
                        required: true
                    },
                    max_number_of_device_history_per_feature: {
                        required: true
                    },
                    max_num_both_neg_pos_devices: {
                        required: true
                    },
                    number_of_positive_device_to_be_used_for_modeling: {
                        required: true
                    },
                    number_of_negative_device_to_be_used_for_modeling: {
                        required: true
                    },
                    number_of_both_negative_positive_device_to_be_used: {
                        required: true
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
        })

    </script>

@endsection