<div class="col-md-3 pull-right">
    <div class="well"  >
        <button id="show_geoLocation" class="btn btn-primary btn-block">Assign Geo Location </button>
        <button id="show_creative" class="btn btn-primary btn-block">Assign Creative </button>
        <button id="show_geoSegment" class="btn btn-primary btn-block">Assign Geo Segment</button>
        <button id="show_bwList" class="btn btn-primary btn-block">Assign B/W List</button>
        <button id="show_segment" class="btn btn-primary btn-block">Assign Segment </button>

    </div>

</div>
<input type="hidden" id="active_show" value="geoLocation"/>
<div class="well col-md-9" id="geoLocation">
    <h4>Assign Geo Location</h4>
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

<div class="well col-md-9" id="creative" style="display: none">
    <h4>Assign Creative</h4>
    <!-- widget content -->
    <div style="margin: 20px 0;">
        <div class="col-xs-5">
            <select name="from_creative[]" id="assign_creative" class="form-control" size="8" multiple="multiple">
                @foreach($campaign_obj->getAdvertiser->Creative as $index)
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
    </div>

    <!-- end widget content -->
</div>

<div class="well col-md-9" id="bwList" style="display: none">

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
                                @foreach($campaign_obj->getAdvertiser->BWList as $index)
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
                                @foreach($campaign_obj->getAdvertiser->BWList as $index)
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

<div class="well col-md-9" id="geoSegment" style="display: none">
    <h4>Assign Geo Segment</h4>
    <!-- widget content -->

    <div style="margin: 20px 0;">
        <div class="col-xs-5">
            <select name="from_geosegment[]" id="assign_geosegment" class="form-control" size="8" multiple="multiple">
                @foreach($campaign_obj->getAdvertiser->GeoSegment as $index)
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
    </div>
    <!-- end widget content -->

</div>

<div class="well col-md-9" id="segment" style="display: none">
    <h4>Assign Segment</h4>
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
