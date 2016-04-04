@extends('Layout1')
@section('siteTitle')Edit Target Group @endsection
@section('headerCss')
    <link rel="stylesheet" href="{{cdn('newTheme/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}">
    <style>
        td > span {
            color: #3ca319;
            font-size: 16px;
            font-weight: bold;
        }
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
        .hour-table th,td,tr{
            font-size:10px;
            font-weight: 500;
        }
        .panel-body{
            padding: 0 !important;

        }
    </style>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$targetgroup_obj->getCampaign->getAdvertiser->GetClientID->id.'/edit')}}">Client: cl{{$targetgroup_obj->getCampaign->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$targetgroup_obj->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$targetgroup_obj->getCampaign->getAdvertiser->id.'/edit')}}">Advertiser: adv{{$targetgroup_obj->getCampaign->getAdvertiser->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$targetgroup_obj->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$targetgroup_obj->getCampaign->getAdvertiser->id.'/campaign/cmp'.$targetgroup_obj->getCampaign->id.'/edit')}}">Campaign : cmp{{$targetgroup_obj->getCampaign->id}}</a>
        </li>
        <li><a href="#" class="active">Target Group : tg{{$targetgroup_obj->id}}</a></li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3" style="width: 20% !important;">
                <div class="real-time-box">
                    <div class="hexagon pull-left hexagon-bg1">
                        <i class="fa fa-eye"></i>
                    </div>

                    <div class="real-time-content real-color1">
                        Imps to Now
                        <br/>
                        <br/>
                        <strong>{{(isset($real_time[0])) ? $real_time[0]->impressions_shown_today_until_now : '0'}}</strong>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-4 btn-border-real-box-left1">
                    </div>
                    <div class="col-md-8 btn-border-real-box-right1">
                    </div>

                </div>
            </div>
            <div class="col-md-3" style="width: 20% !important;">
                <div class="real-time-box">
                    <div class="hexagon pull-left hexagon-bg2">
                        <i class="fa fa-eye"></i>
                    </div>

                    <div class="real-time-content real-color2">
                        Total Imps
                        <br/>
                        <br/>
                        <strong>{{(isset($real_time[0])) ? $real_time[0]->total_impression_show_until_now : '0'}}</strong>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-4 btn-border-real-box-left2">
                    </div>
                    <div class="col-md-8 btn-border-real-box-right2 ">
                    </div>

                </div>
            </div>
            <div class="col-md-3" style="width: 20% !important;">
                <div class="real-time-box">
                    <div class="hexagon pull-left hexagon-bg3">
                        <i class="fa fa-dollar"></i>
                    </div>

                    <div class="real-time-content real-color3">
                        Budget to Now
                        <br/>
                        <br/>
                        <strong>{{(isset($real_time[0])) ? $real_time[0]->daily_budget_spent_today_until_now : '0'}}</strong>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-4 btn-border-real-box-left3">
                    </div>
                    <div class="col-md-8 btn-border-real-box-right3">
                    </div>

                </div>
            </div>
            <div class="col-md-3" style="width: 20% !important;">
                <div class="real-time-box">
                    <div class="hexagon pull-left hexagon-bg4">
                        <i class="fa fa-dollar"></i>
                    </div>

                    <div class="real-time-content real-color4">
                        Total Budget
                        <br/>
                        <br/>
                        <strong>{{(isset($real_time[0])) ? $real_time[0]->total_budget_spent_until_now : '0'}}</strong>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-4 btn-border-real-box-left4">
                    </div>
                    <div class="col-md-8 btn-border-real-box-right4">
                    </div>

                </div>
            </div>
            <div class="col-md-3" style="width: 20% !important;">
                <div class="real-time-box">
                    <div class="hexagon pull-left hexagon-bg5">
                        <i class="fa fa-eye"></i>
                    </div>

                    <div class="real-time-content real-color5">
                        Last Shown
                        <br/>
                        <br/>
                            <span style="font-size: 12px">
                                {{(isset($real_time[0])) ? $real_time[0]->last_time_ad_shown : '0'}}
                            </span>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-4 btn-border-real-box-left5">
                    </div>
                    <div class="col-md-8 btn-border-real-box-right5">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content -->
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    {{--@if($clone==1)--}}
                        {{--<h4>Add Target Group </h4>--}}
                    {{--@else--}}
                        <h4>Edit Target Group: {{$targetgroup_obj->name}} </h4>
                    {{--@endif--}}
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="panel bs-wizard bs-wizard-steps-with-progress">
                        <div class="panel-heading">
                            <div class="panel-title text-center"><h4>Basic information</h4></div>

                            <div class="steps-centered">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div><!--.progress-->

                                <ul class="wizard-steps">
                                    <li class="step" data-title="Basic information">
                                        <a href="#form3_tab1" data-toggle="tab" class="btn btn-primary"><i class="glyphicon glyphicon-star"></i></a>
                                    </li>
                                    <li class="step" data-title="Configuration">
                                        <a href="#form3_tab2" data-toggle="tab" class="btn btn-white"><i class="glyphicon glyphicon-music"></i></a>
                                    </li>
                                    <li class="step" data-title="Bid Adjustment">
                                        <a href="#form3_tab3" data-toggle="tab" class="btn btn-white"><i class="glyphicon glyphicon-cloud"></i></a>
                                    </li>
                                    <li class="step" data-title="Review And Submition">
                                        <a href="#form3_tab4" data-toggle="tab" class="btn btn-white"><i class="glyphicon glyphicon-cloud"></i></a>
                                    </li>
                                </ul><!--.wizard-steps-->
                            </div><!--.steps-centered-->

                        </div><!--.panel-heading-->
                        <div class="panel-body">
                            <form id="form3" method="post" action="{{URL::route('targetgroup_update')}}" class="" novalidate="novalidate">
                                <input type="hidden" name="_method" value="PUT"/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="targetgroup_id" value="{{$targetgroup_obj->id}}">

                                <div class="tab-content">
                                    <div class="tab-pane" id="form3_tab1">
                                        <div class="note note-primary note-bottom-striped">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" id="name" name="name" placeholder="Name"
                                                                   class="form-control" value="{{$targetgroup_obj->name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="control-label">Status</label>
                                                    <div class="switcher">
                                                        <input type="checkbox" name="active" hidden @if($targetgroup_obj->status=='Active')
                                                               checked @endif id="active">
                                                        <label for="active"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="control-label" for="">Last Modified</label>
                                                <h5>{{$targetgroup_obj->updated_at}}</h5>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Domain Name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="advertiser_domain_name"
                                                                   class="form-control" placeholder="Domain Name" id="advertiser_domain_name"
                                                                   value="{{$targetgroup_obj->advertiser_domain_name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">IAB Category</label>
                                                    <select name="iab_category"
                                                            class="selecter"
                                                            id="iab_category"
                                                            onchange="ShowSubCategory(this.value)">
                                                        <option value="0">
                                                            Select one ...
                                                        </option>
                                                        @foreach($iab_category_obj as $index)
                                                            <option value="{{$index->id}}" @if($targetgroup_obj->iab_category == $index->id) selected @endif>{{$index->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">IAB Sub Category</label>
                                                    <select name="iab_sub_category"
                                                            class="selecter "
                                                            id="iab_sub_category">
                                                        @if(!is_null($targetgroup_obj->iab_sub_category))
                                                            <option value="{{$targetgroup_obj->iab_sub_category}}">
                                                                {{$targetgroup_obj->iab_sub_category}}
                                                            </option>
                                                        @else
                                                            <option value="0"
                                                                    disabled>
                                                                Select Iab
                                                                Category First
                                                                ...
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="note note-info note-bottom-striped">
                                            <h4>Budget Informaition</h4>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Max Impression</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="max_impression"
                                                                   placeholder="Max Impression"
                                                                   value="{{$targetgroup_obj->max_impression}}" id="max_impression"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">

                                                <div class="form-group">
                                                    <label class="control-label">Daily Max Impression</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="daily_max_impression"
                                                                   placeholder="Daily Max Impression"
                                                                   value="{{$targetgroup_obj->daily_max_impression}}" id="daily_max_impression"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Max Budget</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">

                                                            <input type="text" name="max_budget"
                                                                   placeholder="Max Budget" class="form-control" id="max_budget"
                                                                   value="{{$targetgroup_obj->max_budget}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Daily Max Budget</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="daily_max_budget"
                                                                   placeholder="Daily Max Budget" class="form-control" id="daily_max_budget"
                                                                   value="{{$targetgroup_obj->daily_max_budget}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">cpm</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="cpm" placeholder="CPM" id="cpm"
                                                                   class="form-control"
                                                                   value="{{$targetgroup_obj->cpm}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Frequency In Sec </label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input class="form-control"
                                                                   placeholder="Frequency per sec"
                                                                   type="text"
                                                                   value="{{$targetgroup_obj->frequency_in_sec}}"
                                                                   name="frequency_in_sec"
                                                                   id="frequency_in_sec">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Pacing Plan</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input class="form-control"
                                                                   placeholder="Pacing Plan"
                                                                   type="text"
                                                                   value="{{$targetgroup_obj->pacing_plan}}"
                                                                   name="pacing_plan"
                                                                   id="pacing_plan">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label class="control-label">Ad Position</label>
                                                    <select name="ad_position[]" multiple class="selecter">
                                                        <option value="ANY" @if(in_array('ANY',$ad_select)) selected @endif>Any</option>
                                                        <option value="ABOVE_THE_FOLD" @if(in_array('ABOVE_THE_FOLD',$ad_select)) selected @endif>Above the Fold</option>
                                                        <option value="BELOW_THE_FOLD" @if(in_array('BELOW_THE_FOLD',$ad_select)) selected @endif>Below the Fold</option>
                                                        <option value="HEADER" @if(in_array('HEADER',$ad_select)) selected @endif>Header</option>
                                                        <option value="FOOTER" @if(in_array('FOOTER',$ad_select)) selected @endif>Footer</option>
                                                        <option value="SIDEBAR" @if(in_array('SIDEBAR',$ad_select)) selected @endif>Sidebar</option>
                                                        <option value="FULL_SCREEN" @if(in_array('FULL_SCREEN',$ad_select)) selected @endif>Full Screen</option>


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="note note-warning note-bottom-striped">
                                            <h4>Date Range</h4>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <span class="add-on input-group-addon"><i class="ion-android-calendar"></i></span>
                                                        <div class="inputer">
                                                            <div class="input-wrapper">
                                                                <input type="text" style="width: 200px" name="date_range" class="form-control bootstrap-daterangepicker-basic-range" value="{{\Carbon\Carbon::parse($targetgroup_obj->start_date)->format('m/d/Y')}} - {{\Carbon\Carbon::parse($targetgroup_obj->end_date)->format('m/d/Y')}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding: 15px">

                                            <div class="form-group">
                                                <label class="control-label">Description</label>

                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <textarea name="description" class="form-control" rows="3"
                                                                  placeholder="type minimum 5 characters"
                                                                  required>{{$targetgroup_obj->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div><!--.tab-pane-->

                                    <div class="tab-pane" id="form3_tab2">
                                        <div style="margin-top: 20px;">
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
                                                        <select name="to_geolocation[]" id="assign_geolocation_to" class="form-control" size="8" multiple="multiple">
                                                            @foreach($geolocation_obj as $index)
                                                                @if(in_array($index->id,$targetgroupGeoLocation))
                                                                    <option value="{{$index->id}}">{{$index->state}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
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
                                                        <select name="to_creative[]" id="assign_creative_to" class="form-control" size="8" multiple="multiple">
                                                            @foreach($campaign_obj->getAdvertiser->Creative as $index)
                                                                @if(in_array($index->id,$targetgroupCreative))
                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br/>
                                                    <div class="col-md-12" id="creativeTable">

                                                    </div>

                                                </div>

                                                <!-- end widget content -->
                                            </div>

                                            <div class="well col-md-9" id="bwList" style="display: none">

                                                <div class="panel-group accordion" id="accordion">
                                                    <!-- accordion 1 -->
                                                    <div class="panel">
                                                        <div class="panel-heading active">
                                                            <!-- panel-heading -->
                                                                <!-- title 1 -->
                                                                <a class="panel-title"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion"
                                                                   href="#blacklist"
                                                                   onclick="taggleBWList('blacklist')">
                                                                    Assign Black
                                                                    List
                                                                </a>
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
                                                                        <select name="to_blacklist[]" id="assign_blacklist_to" class="form-control" size="8" multiple="multiple">
                                                                            @foreach($campaign_obj->getAdvertiser->BWList as $index)
                                                                                @if($index->list_type == 'black' and in_array($index->id,$targetgroupBWList))
                                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                                @endif
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <!-- end widget content -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel">
                                                        <!-- accordion 2 -->
                                                        <div class="panel-heading">
                                                                <!-- title 2 -->
                                                                <a class="panel-title"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion"
                                                                   href="#accordionTwo"
                                                                   onclick="taggleBWList('whitelist')">
                                                                    Assign White
                                                                    List
                                                                </a>
                                                        </div>
                                                        <!-- panel body -->
                                                        <div id="accordionTwo" class="panel-collapse collapse">
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
                                                                        <select name="to_whitelist[]" id="assign_whitelist_to" class="form-control" size="8" multiple="multiple">
                                                                            @foreach($campaign_obj->getAdvertiser->BWList as $index)
                                                                                @if($index->list_type == 'white' and in_array($index->id,$targetgroupBWList))
                                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                                @endif
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <!-- end widget content -->
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="clearfix"></div>
                                                <br/>
                                                <div class="col-md-12" id="bwlistTable">

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
                                                        <select name="to_geosegment[]" id="assign_geosegment_to" class="form-control" size="8" multiple="multiple">
                                                            @foreach($campaign_obj->getAdvertiser->GeoSegment as $index)
                                                                @if(in_array($index->id,$targetgroupGeoSegment))
                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br/>
                                                    <div class="col-md-12" id="geoSegmentTable">

                                                    </div>
                                                </div>
                                                <!-- end widget content -->

                                            </div>
                                            <div class="well col-md-9" id="segment" style="display: none">
                                                <h4>Assign Segment</h4>
                                                <!-- widget content -->

                                                <div style="margin: 20px 0;">
                                                    <div class="col-xs-5">
                                                        <select name="from_segment[]" id="assign_segment" class="form-control" size="8" multiple="multiple">
                                                            @foreach($campaign_obj->getAdvertiser->Segment as $index)
                                                                <option value="{{$index->id}}">{{$index->name}}</option>
                                                            @endforeach
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
                                                            @foreach($campaign_obj->getAdvertiser->Segment as $index)
                                                                @if(in_array($index->id,$targetgroupSegment))
                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <!-- end widget content -->

                                            </div>

                                            <div class="well col-md-9" id="bid_profile" style="display: none">
                                                <h4>Assign Bid Profile</h4>
                                                <!-- widget content -->

                                                <div style="margin: 20px 0;">
                                                    <div class="col-xs-5">
                                                        <select name="from_bid_profile[]" id="assign_bid_profile" class="form-control" size="8" multiple="multiple">
                                                            @foreach($campaign_obj->getAdvertiser->BidProfile as $index)
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
                                                            @foreach($campaign_obj->getAdvertiser->BidProfile as $index)
                                                                @if(in_array($index->id,$targetgroupBidProfile))
                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                @endif
                                                            @endforeach


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

                                    </div><!--.tab-pane-->

                                    <div class="tab-pane" id="form3_tab3">
                                        <div class="note note-primary note-bottom-striped">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-hover time-table hour-table">
                                                        <thead>
                                                        <tr>
                                                            <th>Hours</th>
                                                            <th>12am</th>
                                                            <th>1</th>
                                                            <th>2</th>
                                                            <th>3</th>
                                                            <th>4</th>
                                                            <th>5</th>
                                                            <th>6</th>
                                                            <th>7</th>
                                                            <th>8</th>
                                                            <th>9</th>
                                                            <th>10</th>
                                                            <th>11</th>
                                                            <th>12pm</th>
                                                            <th>1</th>
                                                            <th>2</th>
                                                            <th>3</th>
                                                            <th>4</th>
                                                            <th>5</th>
                                                            <th>6</th>
                                                            <th>7</th>
                                                            <th>8</th>
                                                            <th>9</th>
                                                            <th>10</th>
                                                            <th>11</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @for($i=0;$i<7;$i++)
                                                            <tr>
                                                                <td>@if($i==0)
                                                                        Monday @elseif($i==1)
                                                                        Tusday @elseif($i==2)
                                                                        Wendsday @elseif($i==3)
                                                                        Tursday @elseif($i==4)
                                                                        Friday @elseif($i==5)
                                                                        Satarday @elseif($i==6)
                                                                        Sunday @endif</td>
                                                                @for($j=0;$j<24;$j++)
                                                                    <td style="padding: 1px!important;">
                                                                        <div id="{{$i}}-{{$j}}-time" @if(isset($hours[$i][$j]) and $hours[$i][$j]==1) class="time-table-div-select" @else class="time_table_unselect" @endif  ></div>

                                                                        <input type="checkbox" name="{{$i}}-{{$j}}-hour" id="{{$i}}-{{$j}}-time-checkbox" @if(isset($hours[$i][$j]) and $hours[$i][$j]==1) checked @endif style="display: none"/>
                                                                    </td>
                                                                @endfor
                                                            </tr>
                                                        @endfor

                                                        </tbody>
                                                    </table>


                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a id="clear_all" class="btn btn-primary">Clear All</a>
                                                </div>
                                                <div class="col-md-5">
                                                    <h4 style="float: left; padding: 5px 10px;">Legend:</h4>
                                                    <div class="time_table_unselect" style="max-width: 40px; float: left; padding: 5px 10px;"></div>
                                                    <div style="float: left; padding: 5px 10px;">Inactive</div>
                                                    <div class="time-table-div-select" style="max-width: 40px; float: left; padding: 5px 10px;"></div>
                                                    <div style="float: left; padding: 5px 10px;">Active</div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="form-group">

                                                    <select name="" class="selecter"
                                                            id="suggested">
                                                        <option value="0">Select One..</option>
                                                        <option value="happy-hours">Happy Hours</option>
                                                        <option value="business-hours">Business Hours</option>
                                                    </select>

                                                </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div><!--.tab-pane-->

                                    <div class="tab-pane" id="form3_tab4">
                                        <div class="note note-primary note-bottom-striped">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Step 1</h2>
                                                    <table class="table table-bordered table-responsive">
                                                        <tr>
                                                            <td>name: <span id="rev_name"></span></td>
                                                            <td>IAB Cat: <span id="rev_iab"></span></td>
                                                            <td>Sub IAB cat: <span id="rev_sub_iab"></span>
                                                            </td>
                                                            <td>Domain name: <span
                                                                        id="rev_domain_name"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Max Impressions: <span
                                                                        id="rev_max_imp"></span></td>
                                                            <td>Daily max imp: <span
                                                                        id="rev_daily_max_imp"></span></td>
                                                            <td>Max budget: <span
                                                                        id="rev_max_budget"></span></td>
                                                            <td>Daily Max budget: <span
                                                                        id="rev_daily_max_budget"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Frequency in sec: <span
                                                                        id="rev_frequency_in_sec"></span>
                                                            </td>
                                                            <td>Max CPM: <span id="rev_cpm"></span></td>
                                                            <td colspan="2">Pacing plan: <span
                                                                        id="rev_pacing_plan"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Start Date: <span
                                                                        id="rev_start_date"></span></td>
                                                            <td colspan="2">End Date: <span
                                                                        id="rev_end_date"></span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Step 2</h2>
                                                </div>
                                                <div class="col-md-2">
                                                    <h3>Assigned Geo Location</h3>
                                                    <table class="table table-bordered table-responsive">
                                                        <tr>
                                                            <td><span id="rev_assign_geolocation"></span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-2">
                                                    <h3>Assigned Creative</h3>
                                                    <table class="table table-bordered table-responsive">
                                                        <tr>
                                                            <td><span id="rev_assign_creative"></span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-2">
                                                    <h3>Assigned Black/White List <span
                                                                id="rev_bwlist"></span></h3>
                                                    <table class="table table-bordered table-responsive">
                                                        <tr>
                                                            <td><span id="rev_assign_bwlist"></span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-2">
                                                    <h3>Assigned Geo Segment</h3>
                                                    <table class="table table-bordered table-responsive">
                                                        <tr>
                                                            <td><span id="rev_assign_geosegment"></span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-2">
                                                    <h3>Assigned Segment</h3>
                                                    <table class="table table-bordered table-responsive">
                                                        <tr>
                                                            <td><span id="rev_assign_segment"></span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="panel-group toggle" id="accordion2">
                                                <div class="panel">
                                                    <div class="panel-heading active">
                                                        <a class="panel-title" data-toggle="collapse" href="#collapse4">Bid Hours</a>
                                                    </div>
                                                    <div id="collapse4" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                            <div class="">
                                                                <h4>Bid Hours </h4>
                                                                <div class="col-md-12">
                                                                    <table class="table table-hover time-table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Hours</th>
                                                                            <th>12am</th>
                                                                            <th>1</th>
                                                                            <th>2</th>
                                                                            <th>3</th>
                                                                            <th>4</th>
                                                                            <th>5</th>
                                                                            <th>6</th>
                                                                            <th>7</th>
                                                                            <th>8</th>
                                                                            <th>9</th>
                                                                            <th>10</th>
                                                                            <th>11</th>
                                                                            <th>12pm</th>
                                                                            <th>1</th>
                                                                            <th>2</th>
                                                                            <th>3</th>
                                                                            <th>4</th>
                                                                            <th>5</th>
                                                                            <th>6</th>
                                                                            <th>7</th>
                                                                            <th>8</th>
                                                                            <th>9</th>
                                                                            <th>10</th>
                                                                            <th>11</th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @for($i=0;$i<7;$i++)
                                                                            <tr>
                                                                                <td>@if($i==0)
                                                                                        Monday @elseif($i==1)
                                                                                        Tusday @elseif($i==2)
                                                                                        Wendsday @elseif($i==3)
                                                                                        Tursday @elseif($i==4)
                                                                                        Friday @elseif($i==5)
                                                                                        Satarday @elseif($i==6)
                                                                                        Sunday @endif</td>
                                                                                @for($j=0;$j<24;$j++)
                                                                                    <td style="padding: 1px!important;">
                                                                                        <div id="{{$i}}-{{$j}}-time-review" @if(isset($hours[$i][$j]) and $hours[$i][$j]==1) class="time-table-div-select" @else class="time_table_unselect" @endif ></div>

                                                                                    </td>
                                                                                @endfor
                                                                            </tr>
                                                                        @endfor

                                                                        </tbody>
                                                                    </table>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div><!--.panel-group-->


                                        </div>
                                    </div><!--.tab-pane-->
                                </div><!--.tab-content-->


                        </div><!--.panel-body-->
                        <div class="panel-footer">
                            <ul class="wizard clearfix">
                                <li class="bs-wizard-prev pull-left"><button class="btn btn-flat btn-default previous-btn">Previous</button></li>
                                <li class="bs-wizard-next pull-right"><button class="btn btn-blue next-btn">Next</button></li>
                                <li class="bs-wizard-submit pull-right"><button type="submit" class="btn btn-blue">Complete setup</button></li>
                            </ul>
                        </div><!--.panel-footer-->
                        </form>

                    </div><!--.panel-->
                </div>

            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
    <!--.col-->
    <div class="col-md-3">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4 class="pull-left">Activities</h4>
                    <div class="pull-right audit-select">
                        <select id="audit_status" class="selecter col-md-12" >
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
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <!-- BEGIN PLUGINS AREA -->
    <script src="{{cdn('newTheme/globals/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{cdn('newTheme/globals/scripts/forms-wizard.js')}}"></script>
    <!-- END PLUGINS INITIALIZATION AND SETTINGS -->
    <script src="{{cdn('newTheme/globals/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{cdn('newTheme/globals/scripts/forms-pickers.js')}}"></script>

    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#show_geoLocation').click(function (e) {
            e.preventDefault();
            var active_Show= $('#active_show').val();
            $('#active_show').val('geoLocation');
            $('#'+active_Show).hide();
            $('#geoLocation').fadeIn("slow");
        });
        $('#show_creative').click(function (e) {
            e.preventDefault();
            var active_Show= $('#active_show').val();
            $('#active_show').val('creative');
            $('#'+active_Show).hide();
            $('#creative').fadeIn("slow");
        });
        $('#show_geoSegment').click(function (e) {
            e.preventDefault();
            var active_Show= $('#active_show').val();
            $('#active_show').val('geoSegment');
            $('#'+active_Show).hide();
            $('#geoSegment').fadeIn("slow");
        });
        $('#show_segment').click(function (e) {
            e.preventDefault();
            var active_Show= $('#active_show').val();
            $('#active_show').val('segment');
            $('#'+active_Show).hide();
            $('#segment').fadeIn("slow");
        });
        $('#show_bid_profile').click(function (e) {
            e.preventDefault();
            var active_Show= $('#active_show').val();
            $('#active_show').val('bid_profile');
            $('#'+active_Show).hide();
            $('#bid_profile').fadeIn("slow");
        });
        $('#show_bwList').click(function (e) {
            e.preventDefault();
            var active_Show= $('#active_show').val();
            $('#active_show').val('bwList');
            $('#'+active_Show).hide();
            $('#bwList').fadeIn("slow");
        });
        function ShowSubCategory(id) {
            $.ajax({
                url: "{{url('/get_iab_sub_category')}}" + '/' + id
            }).success(function (response) {
                console.log(response);
                $('#iab_sub_category').html(response);
                $('select.selecter').selectpicker('refresh');
            });
        }
        function setReview() {
            $('#rev_assign_geolocation').html('');
            $('#rev_assign_creative').html('');
            $('#rev_assign_bwlist').html('');
            $('#rev_assign_geosegment').html('');
            $('#rev_assign_segment').html('');
            $('#rev_bwlist').html('');
            $('#assign_creative_to').find('option').each(function () {
                $('#rev_assign_creative').append($(this).html() + '<br>');
            });
            if ($('#assign_blacklist_to').find('option').length > 0) {
                $('#rev_bwlist').html('(Black List)');
                $('#assign_blacklist_to').find('option').each(function () {
                    $('#rev_assign_bwlist').append($(this).html() + '<br>');
                });
            } else if ($('#assign_whitelist_to').find('option').length > 0) {
                $('#rev_bwlist').html('(White List)');
                $('#assign_whitelist_to').find('option').each(function () {
                    $('#rev_assign_bwlist').append($(this).html() + '<br>');
                });

            }
            $('#assign_geosegment_to').find('option').each(function () {
                $('#rev_assign_geosegment').append($(this).html() + '<br>');
            });
            $('#assign_segment_to').find('option').each(function () {
                $('#rev_assign_segment').append($(this).html() + '<br>');
            });
            $('#assign_geolocation_to').find('option').each(function () {
                $('#rev_assign_geolocation').append($(this).html() + '<br>');
            });
            console.log($('#initializeDuallistbox'));
            $('#rev_name').html($('#name').val());
            $('#rev_domain_name').html($('#advertiser_domain_name').val());
            $('#rev_max_imp').html($('#max_impression').val());
            $('#rev_daily_max_imp').html($('#daily_max_impression').val());
            $('#rev_max_budget').html($('#max_budget').val());
            $('#rev_daily_max_budget').html($('#daily_max_budget').val());
            $('#rev_frequency_in_sec').html($('#frequency_in_sec').val());
            $('#rev_cpm').html($('#cpm').val());
            $('#rev_pacing_plan').html($('#pacing_plan').val());
            $('#rev_start_date').html($('#startdate').val());
            $('#rev_end_date').html($('#finishdate').val());
//            $('#rev_').html($('#name').val());

        }
        function taggleBWList(type) {
            if (type == 'blacklist') {
                jQuery('#assign_whitelist_leftAll').click();
            }
            if (type == 'whitelist') {
                jQuery('#assign_blacklist_leftAll').click();
            }
        }
    </script>
    <script>
        /////////////////////////Bid By Hour////////////////////////
        $('#clear_all').click(function () {
            for(var i=0; i<7; i++){
                for(var j=0;j<24;j++){
                    var id =$('#'+i+'-'+j+'-time').attr('id');
                    $('#'+id+'-checkbox').prop('checked', false);
                    $('#'+i+'-'+j+'-time').removeClass();
                    $('#'+i+'-'+j+'-time').addClass('time_table_unselect');
                    $('#'+id+'-review').removeClass();
                    $('#'+id+'-review').addClass('time_table_unselect');

                }
            }

        });
        $('#suggested').change(function () {
            if($(this).val()=='business-hours'){
                $('#clear_all').click();
                for(var i=0; i<5; i++){
                    for(var j=9;j<17;j++){
                        var id =$('#'+i+'-'+j+'-time').attr('id');
                        $('#'+id+'-checkbox').prop('checked', true);
                        $('#'+i+'-'+j+'-time').removeClass();
                        $('#'+i+'-'+j+'-time').addClass('time-table-div-select');
                        $('#'+id+'-review').removeClass();
                        $('#'+id+'-review').addClass('time-table-div-select');

                    }
                }
            }
            if($(this).val()=='happy-hours'){
                $('#clear_all').click();
                for(var i=0; i<5; i++){
                    for(var j=17;j<24;j++){
                        var id =$('#'+i+'-'+j+'-time').attr('id');
                        $('#'+id+'-checkbox').prop('checked', true);
                        $('#'+i+'-'+j+'-time').removeClass();
                        $('#'+i+'-'+j+'-time').addClass('time-table-div-select');
                        $('#'+id+'-review').removeClass();
                        $('#'+id+'-review').addClass('time-table-div-select');

                    }
                }
                for(var i=5; i<7; i++){
                    for(var j=0;j<24;j++){
                        var id =$('#'+i+'-'+j+'-time').attr('id');
                        $('#'+id+'-checkbox').prop('checked', true);
                        $('#'+i+'-'+j+'-time').removeClass();
                        $('#'+i+'-'+j+'-time').addClass('time-table-div-select');
                        $('#'+id+'-review').removeClass();
                        $('#'+id+'-review').addClass('time-table-div-select');

                    }
                }
            }
        })
    </script>
    <script>
        $(document).ready(function () {
            FormsWizard.init();
            FormsPickers.init();
            $('.previous-btn').click(function (e) {
                e.preventDefault();
            });
            $('.next-btn').click(function (e) {
                e.preventDefault();
            });
            for(var i=0; i<7; i++){
                for(var j=0;j<24;j++){
                    $('#'+i+'-'+j+'-time').click(function () {
                        var id =$(this).attr('id');
                        if($(this).hasClass('time_table_unselect')){
                            $('#'+id+'-checkbox').prop('checked', true);
                            $('#'+id+'-review').removeClass();
                            $('#'+id+'-review').addClass('time-table-div-select');
                            $(this).removeClass();
                            $(this).addClass('time-table-div-select');
                        }else{
                            $('#'+id+'-checkbox').prop('checked', false);
                            $('#'+id+'-review').removeClass();
                            $('#'+id+'-review').addClass('time_table_unselect');
                            $(this).removeClass();
                            $(this).addClass('time_table_unselect');

                        }
                    });
                }
            }
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
                },
                afterMoveToRight: function($left, $right, $options) {
                    var data=[];
                    $('#assign_blacklist_to').find('option').each(function() {
                        data.push($(this).val());
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{url('/getTableGridTG')}}",
                        data: {data:data,entity_type:'bwlist'}
                    }).success(function (response) {
                        $('#bwlistTable').html(response);
                    });

                },
                afterMoveToLeft: function($left, $right, $options) {
                    var data=[];
                    $('#assign_blacklist_to').find('option').each(function() {
                        data.push($(this).val());
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{url('/getTableGridTG')}}",
                        data: {data:data,entity_type:'bwlist'}
                    }).success(function (response) {
                        $('#bwlistTable').html(response);
                    });
                }
            });

            $('#assign_whitelist').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
                },
                afterMoveToRight: function($left, $right, $options) {
                    var data=[];
                    $('#assign_whitelist_to').find('option').each(function() {
                        data.push($(this).val());
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{url('/getTableGridTG')}}",
                        data: {data:data,entity_type:'bwlist'}
                    }).success(function (response) {
                        $('#bwlistTable').html(response);
                    });

                },
                afterMoveToLeft: function($left, $right, $options) {
                    var data=[];
                    $('#assign_whitelist_to').find('option').each(function() {
                        data.push($(this).val());
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{url('/getTableGridTG')}}",
                        data: {data:data,entity_type:'bwlist'}
                    }).success(function (response) {
                        $('#bwlistTable').html(response);
                    });
                }
            });

            $.ajax({
                url: "{{url('ajax/getAudit/targetgroup/'.$targetgroup_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });


            var $validator = $("#form3").validate({

                rules: {
                    name: {
                        required: true
                    },
                    advertiser_domain_name: {
                        required: true,
                        domain: true
                    },
                    iab_sub_category: {
                        required: true
                    },
                    max_impression: {
                        required: true
                    },
                    daily_max_impression: {
                        required: true,
                        number: 'Enter number Plz'
                    },
                    max_budget: {
                        required: true,
                        number: 'Enter number Plz'
                    },
                    daily_max_budget: {
                        required: true,
                        minlength: 2,
                        number: 'Enter number Plz'
                    },
                    frequency_in_sec: {
                        required: true,
                        minlength: 2,
                        number: 'Enter number Plz'
                    },
                    cpm: {
                        required: true,
                        minlength: 2,
                        number: 'Enter number Plz'
                    },
                    pacing_plan: {
                        required: true,
                        minlength: 2,
                        number: 'Enter number Plz'
                    },
                    startdate: {
                        required: true
                    },
                    finishdate: {
                        required: true
                    }
                },

                messages: {
                    fname: "Please specify your First name",
                    lname: "Please specify your Last name",
                    advertiser_domain_name: "Your site must be in the format of http://www.yourdomian.com",
                    email: {
                        required: "We need your email address to contact you",
                        email: "Your email address must be in the format of name@domain.com"
                    }
                },

                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });

        $('#audit_status').change(function () {
            if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/targetgroup/'.$targetgroup_obj->id)}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }
        });

    </script>

@endsection