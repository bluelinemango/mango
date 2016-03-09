<div id="assign_box">
    <div class="col-md-3 pull-right">
        <div class="well"  >
            <button id="show_geoLocation" class="btn btn-primary btn-block">Assign Geo Location </button>
            <button id="show_creative" class="btn btn-primary btn-block">Assign Creative </button>
            <button id="show_geoSegment" class="btn btn-primary btn-block">Assign Geo Segment</button>
            <button id="show_bwList" class="btn btn-primary btn-block">Assign B/W List</button>
            <button id="show_segment" class="btn btn-primary btn-block">Assign Segment </button>
            <button id="show_bid_profile" class="btn btn-primary btn-block">Assign Bid Profile </button>

        </div>

    </div>
    <input type="hidden" id="active_show" value="geoLocation"/>
    <div class="col-md-9" id="geoLocation">
        <h4 class="pull-left">Assign Geo Location</h4>
        <h4 class="pull-right">Unassign all Geo Locations <input type="checkbox" class="form-conroller" name="unassign_geolocation"/></h4>
        <div class="clearfix"></div>
        <!-- widget content -->
        <div style="margin: 20px 0;">
            <div class="col-xs-5">
                <select name="from_geolocation[]" id="assign_geolocation" class="form-control" size="8" multiple="multiple">
                    @foreach($geolocation_obj as $index)
                        <option value="{{$index->id}}">{{$index->state}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-2">
                <button type="button" id="assign_geolocation_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="assign_geolocation_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="assign_geolocation_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="assign_geolocation_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>

            <div class="col-xs-5">
                <select name="to_geolocation[]" id="assign_geolocation_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
            <div class="clearfix"></div>
        </div>


        <!-- end widget content -->
    </div>

    <div class="col-md-9" id="creative" style="display: none">
        <h4 class="pull-left">Assign Creative</h4>
        <h4 class="pull-right">Unassign all Creative <input type="checkbox" class="form-conroller" name="unassign_creative"/></h4>
        <div class="clearfix"></div>
        <!-- widget content -->
        <div style="margin: 20px 0;">
            <div class="col-xs-5">
                <select name="from_creative[]" id="assign_creative" class="form-control" size="8" multiple="multiple">
                    @foreach($adver_obj->Creative as $index)
                        <option value="{{$index->id}}">{{$index->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-2">
                <button type="button" id="assign_creative_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="assign_creative_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="assign_creative_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="assign_creative_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>

            <div class="col-xs-5">
                <select name="to_creative[]" id="assign_creative_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-12" id="creativeTable">

            </div>

        </div>

        <!-- end widget content -->
    </div>

    <div class="col-md-9" id="bwList" style="display: none">

        <div class="panel-group"
             id="accordion">
            <!-- accordion 1 -->
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <!-- panel-heading -->
                    <h4 class="panel-title">
                        <!-- title 1 -->
                        <a data-toggle="collapse"
                           data-parent="#accordion"
                           href="#blacklist"
                           onclick="taggleBWList('blacklist')">
                            Assign Black
                            List
                        </a>
                    </h4>
                </div>
                <!-- panel body -->
                <div id="blacklist"
                     class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- widget content -->
                        <div style="margin: 20px 0;">
                            <div class="col-xs-5">
                                <select name="from_blacklist[]" id="assign_blacklist" class="form-control" size="8" multiple="multiple">
                                    @foreach($adver_obj->BWList as $index)
                                        @if($index->list_type == 'black')
                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="assign_blacklist_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="assign_blacklist_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="assign_blacklist_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="assign_blacklist_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <select name="to_blacklist[]" id="assign_blacklist_to" class="form-control" size="8" multiple="multiple"></select>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <!-- end widget content -->
                    </div>
                </div>
            </div>

            <div class="panel panel-success">
                <!-- accordion 2 -->

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <!-- title 2 -->
                        <a data-toggle="collapse"
                           data-parent="#accordion"
                           href="#accordionTwo"
                           onclick="taggleBWList('whitelist')">
                            Assign White
                            List
                        </a>
                    </h4>
                </div>
                <!-- panel body -->
                <div id="accordionTwo"
                     class="panel-collapse collapse">
                    <div class="panel-body">
                        <!-- widget content -->
                        <div style="margin: 20px 0;">
                            <div class="col-xs-5">
                                <select name="from_whitelist[]" id="assign_whitelist" class="form-control" size="8" multiple="multiple">
                                    @foreach($adver_obj->BWList as $index)
                                        @if($index->list_type == 'white')
                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="assign_whitelist_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="assign_whitelist_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="assign_whitelist_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="assign_whitelist_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <select name="to_whitelist[]" id="assign_whitelist_to" class="form-control" size="8" multiple="multiple"></select>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <!-- end widget content -->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-md-9" id="geoSegment" style="display: none">
        <h4 class="pull-left">Assign Geo Segment</h4>
        <h4 class="pull-right">Unassign all Geo Segment <input type="checkbox" class="form-conroller" name="unassign_geosegment"/></h4>
        <div class="clearfix"></div>
        <!-- widget content -->

        <div style="margin: 20px 0;">
            <div class="col-xs-5">
                <select name="from_geosegment[]" id="assign_geosegment" class="form-control" size="8" multiple="multiple">
                    @foreach($adver_obj->GeoSegment as $index)
                        <option value="{{$index->id}}">{{$index->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-2">
                <button type="button" id="assign_geosegment_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="assign_geosegment_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="assign_geosegment_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="assign_geosegment_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>

            <div class="col-xs-5">
                <select name="to_geosegment[]" id="assign_geosegment_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-12" id="geoSegmentTable"></div>
        </div>
        <!-- end widget content -->

    </div>

    <div class="col-md-9" id="segment" style="display: none">
        <h4 class="pull-left">Assign Segment</h4>
        <h4 class="pull-right">Unassign all Segment <input type="checkbox" class="form-conroller" name="unassign_segment"/></h4>
        <div class="clearfix"></div>
        <!-- widget content -->

        <div style="margin: 20px 0;">
            <div class="col-xs-5">
                <select name="from_segment[]" id="assign_segment" class="form-control" size="8" multiple="multiple">
                    {{--@foreach($campaign_obj->getAdvertiser->Segment as $index)--}}
                    {{--<option value="{{$index->id}}">{{$index->name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </div>

            <div class="col-xs-2">
                <button type="button" id="assign_segment_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="assign_segment_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="assign_segment_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="assign_segment_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>

            <div class="col-xs-5">
                <select name="to_segment[]" id="assign_segment_to" class="form-control" size="8" multiple="multiple">


                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end widget content -->

    </div>

    <div class="col-md-9" id="bid_profile" style="display: none">
        <h4 class="pull-left">Assign Bid Profile</h4>
        <h4 class="pull-right">Unassign all Bid Profile <input type="checkbox" class="form-conroller" name="unassign_bidprofile"/></h4>
        <div class="clearfix"></div>
        <!-- widget content -->

        <div style="margin: 20px 0;">
            <div class="col-xs-5">
                <select name="from_bid_profile[]" id="assign_bid_profile" class="form-control" size="8" multiple="multiple">
                    @foreach($adver_obj->BidProfile as $index)
                        <option value="{{$index->id}}">{{$index->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-2">
                <button type="button" id="assign_bid_profile_rightAll" class="btn btn-block" onclick="bid_profile_table()"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="assign_bid_profile_rightSelected" class="btn btn-block" onclick="bid_profile_table()"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="assign_bid_profile_leftSelected" class="btn btn-block" onclick="bid_profile_table()"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="assign_bid_profile_leftAll" class="btn btn-block" onclick="bid_profile_table()"><i class="glyphicon glyphicon-backward"></i></button>
            </div>

            <div class="col-xs-5">
                <select name="to_bid_profile[]" id="assign_bid_profile_to" class="form-control" size="8" multiple="multiple">
                </select>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-12" id="bidProfileTable">

            </div>
        </div>
        <!-- end widget content -->

    </div>

</div>
<script>
    $('#assign_geolocation').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        }
    });

    $('#assign_creative').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        },
        afterMoveToRight: function($left, $right, $options) {
            var data=[];
            $('#assign_creative_to').find('option').each(function() {
                data.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('/getTableGridTG')}}",
                data: {data:data,entity_type:'creative'}
            }).success(function (response) {
                $('#creativeTable').html(response);
            });

        },
        afterMoveToLeft: function($left, $right, $options) {
            var data=[];
            $('#assign_creative_to').find('option').each(function() {
                data.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('/getTableGridTG')}}",
                data: {data:data,entity_type:'creative'}
            }).success(function (response) {
                $('#creativeTable').html(response);
            });
        }
    });

    $('#assign_geosegment').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        },
        afterMoveToRight: function($left, $right, $options) {
            var data=[];
            $('#assign_geosegment_to').find('option').each(function() {
                data.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('/getTableGridTG')}}",
                data: {data:data,entity_type:'geosegment'}
            }).success(function (response) {
                $('#geoSegmentTable').html(response);
            });

        },
        afterMoveToLeft: function($left, $right, $options) {
            var data=[];
            $('#assign_geosegment_to').find('option').each(function() {
                data.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('/getTableGridTG')}}",
                data: {data:data,entity_type:'geosegment'}
            }).success(function (response) {
                $('#geoSegmentTable').html(response);
            });
        }
    });

    $('#assign_segment').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        }
    });

    $('#assign_bid_profile').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        },
        afterMoveToRight: function($left, $right, $options) {
            var data=[];
            $('#assign_bid_profile_to').find('option').each(function() {
                data.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('/getTableGridTG')}}",
                data: {data:data,entity_type:'bid_profile'}
            }).success(function (response) {
                $('#bidProfileTable').html(response);
            });

        },
        afterMoveToLeft: function($left, $right, $options) {
            var data=[];
            $('#assign_bid_profile_to').find('option').each(function() {
                data.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('/getTableGridTG')}}",
                data: {data:data,entity_type:'bid_profile'}
            }).success(function (response) {
                $('#bidProfileTable').html(response);
            });
        }
    });

    $('#assign_blacklist').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        }
    });

    $('#assign_whitelist').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
        }
    });



    $('#show_geoLocation').click(function (e) {
        e.preventDefault();
        var active_Show = $('#active_show').val();
        $('#active_show').val('geoLocation');
        $('#' + active_Show).hide();
        $('#geoLocation').fadeIn("slow");
    });
    $('#show_creative').click(function (e) {
        e.preventDefault();
        var active_Show = $('#active_show').val();
        $('#active_show').val('creative');
        $('#' + active_Show).hide();
        $('#creative').fadeIn("slow");
    });
    $('#show_geoSegment').click(function (e) {
        e.preventDefault();
        var active_Show = $('#active_show').val();
        $('#active_show').val('geoSegment');
        $('#' + active_Show).hide();
        $('#geoSegment').fadeIn("slow");
    });
    $('#show_bid_profile').click(function (e) {
        e.preventDefault();
        var active_Show= $('#active_show').val();
        $('#active_show').val('bid_profile');
        $('#'+active_Show).hide();
        $('#bid_profile').fadeIn("slow");
    });
    $('#show_segment').click(function (e) {
        e.preventDefault();
        var active_Show = $('#active_show').val();
        $('#active_show').val('segment');
        $('#' + active_Show).hide();
        $('#segment').fadeIn("slow");
    });
    $('#show_bwList').click(function (e) {
        e.preventDefault();
        var active_Show = $('#active_show').val();
        $('#active_show').val('bwList');
        $('#' + active_Show).hide();
        $('#bwList').fadeIn("slow");
    });

</script>
