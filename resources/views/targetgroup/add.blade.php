@extends('Layout')
@section('siteTitle')Add Target Group @endsection
@section('header_extra')
    <style>
        td > span {
            color: #3ca319;
            font-size: 16px;
            font-weight: bold;
        }

        .well {
            padding: 15px !important;
        }

        .bg-color {
            display: block;
            padding: 10px 14px 5px;
            border: none;
            background: rgba(239, 242, 244, 0.3);
        }
        .time_table_unselect {
            background-color: rgba(17, 115, 119, 0.45);
            min-height: 30px;
            min-width: 30px;
            cursor: pointer;
        }
        .time-table-div-select {
            background-color: rgba(20, 24, 73, 0.98);
            min-height: 30px;
            min-width: 30px;
            cursor: pointer
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
                <li>Home</li>
                <li><a
                            href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client: cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a>
                </li>
                <li><a
                            href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/edit')}}">Advertiser: adv{{$campaign_obj->getAdvertiser->id}}</a>
                </li>
                <li><a
                            href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/campaign/cmp'.$campaign_obj->id.'/edit')}}">Campaign : cmp{{$campaign_obj->id}}</a>
                </li>
                <li>Target Group Registration</li>
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
                    <article class="col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="well">
                            <!-- widget div-->
                            <div>

                                <!-- widget content -->
                                <div class="">

                                    <div class="row">
                                        <form id="wizard-1" novalidate="novalidate"
                                              action="{{URL::route('targetgroup_create')}}" method="post"
                                              class="smart-form">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}">

                                            <div id="bootstrap-wizard-1" class="col-sm-12">
                                                <div class="form-bootstrapWizard">
                                                    <ul class="bootstrapWizard form-wizard">
                                                        <li class="active" data-target="#step1">
                                                            <a href="#tab1" data-toggle="tab"> <span
                                                                        class="step">1</span> <span class="title">Basic information</span>
                                                            </a>
                                                        </li>
                                                        <li data-target="#step2">
                                                            <a href="#tab2" data-toggle="tab"> <span
                                                                        class="step">2</span> <span class="title">Configuration</span>
                                                            </a>
                                                        </li>
                                                        <li data-target="#step3">
                                                            <a href="#tab3" data-toggle="tab"> <span
                                                                        class="step">3</span> <span class="title">Bid Adjustment</span>
                                                            </a>
                                                        </li>
                                                        <li data-target="#step4">
                                                            <a href="#tab4" data-toggle="tab"
                                                               onclick="setReview()"> <span
                                                                        class="step">4</span> <span class="title">Review And Submition</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab1">
                                                        <br>

                                                        <h3><strong>Step 1 </strong> - Basic Information</h3>


                                                        <!-- NEW WIDGET START -->
                                                        <article class="col-sm-12 col-md-12 col-lg-12">

                                                            <div class="well">
                                                                <!-- widget div-->
                                                                <div>
                                                                    <!-- widget content -->
                                                                    <div class="">

                                                                        <div id="myTabContent1"
                                                                             class="tab-content">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="s1">

                                                                                <h6>
                                                                                    General Information
                                                                                </h6>
                                                                                <hr class="simple">
                                                                                <div class="col-md-12 bg-color">
                                                                                    <section class="col col-2">
                                                                                        <label class="label" for="">Name(required)</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input type="text"
                                                                                                       name="name"
                                                                                                       placeholder="Name">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                    <section class="col col-2">
                                                                                        <label class="label" for="">IAB
                                                                                            Category</label>

                                                                                        <label class="input"> <i
                                                                                                    class="icon-append fa fa-user"></i>

                                                                                            <div class="form-group">
                                                                                                <select name="iab_category"
                                                                                                        class="form-control "
                                                                                                        id=""
                                                                                                        onchange="ShowSubCategory(this.value)">
                                                                                                    <option value="0"
                                                                                                            disabled>
                                                                                                        Select one ...
                                                                                                    </option>
                                                                                                    @foreach($iab_category_obj as $index)
                                                                                                        <option value="{{$index->id}}">{{$index->name}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </label>
                                                                                    </section>
                                                                                    <section class="col col-2">
                                                                                        <label class="label" for="">IAB Sub
                                                                                            Category</label>

                                                                                        <label class="input"> <i
                                                                                                    class="icon-append fa fa-user"></i>

                                                                                            <div class="form-group">
                                                                                                <select name="iab_sub_category"
                                                                                                        class="form-control "
                                                                                                        id="iab_sub_category">
                                                                                                    <option value="0"
                                                                                                            disabled>
                                                                                                        Select Iab
                                                                                                        Category First
                                                                                                        ...
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </label>
                                                                                    </section>
                                                                                    <section class="col col-2">
                                                                                        <label class="label" for="">Campaign
                                                                                            ID</label>
                                                                                        <label class="input">
                                                                                            <h6>
                                                                                                CMP{{$campaign_obj->id}}</h6>
                                                                                        </label>
                                                                                    </section>

                                                                                </div>
                                                                                <div class="col-md-12 bg-color">
                                                                                    <section class="col col-3">
                                                                                        <label class="label" for="">Domain
                                                                                            Name</label>

                                                                                        <label class="input"> <i
                                                                                                    class="icon-append fa fa-user"></i>

                                                                                            <div class="form-group">
                                                                                                <input type="text"
                                                                                                       name="advertiser_domain_name"
                                                                                                       placeholder="Domain Name"
                                                                                                       id="advertiser_domain_name">
                                                                                            </div>
                                                                                        </label>
                                                                                    </section>

                                                                                </div>
                                                                                <h6>
                                                                                    Budget Information
                                                                                </h6>
                                                                                <hr class="simple">
                                                                                <div class="col-md-6 bg-color">
                                                                                    <section class="col col-4">
                                                                                        <label class="label" for="">Max
                                                                                            Impression</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Max Impressions"
                                                                                                       type="text"
                                                                                                       name="max_impression"
                                                                                                       id="max_impression">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                    <section class="col col-4">
                                                                                        <label class="label" for="">Daily
                                                                                            Max Imps</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Daily Max Imps"
                                                                                                       type="text"
                                                                                                       name="daily_max_impression"
                                                                                                       id="daily_max_impression">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                </div>
                                                                                <div class="col-md-6 bg-color">
                                                                                    <section class="col col-4">
                                                                                        <label class="label" for="">Max
                                                                                            Budget</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Max Budget"
                                                                                                       type="text"
                                                                                                       name="max_budget"
                                                                                                       id="max_budget">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                    <section class="col col-4">
                                                                                        <label class="label" for="">Daily
                                                                                            Max Budget</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Daily Max Budget"
                                                                                                       type="text"
                                                                                                       name="daily_max_budget"
                                                                                                       id="daily_max_budget">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                </div>
                                                                                <div class="col-md-12 bg-color">
                                                                                    <section class="col col-2">
                                                                                        <label class="label" for="">Frequency
                                                                                            In Sec </label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Frequency per sec"
                                                                                                       type="text"
                                                                                                       name="frequency_in_sec"
                                                                                                       id="frequency_in_sec">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                    <section class="col col-2">
                                                                                        <label class="label"
                                                                                               for="">CPM</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="MAX CPM"
                                                                                                       type="text"
                                                                                                       name="cpm"
                                                                                                       id="cpm">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                    <section class="col col-2">
                                                                                        <label class="label" for="">Pacing
                                                                                            Plan</label>

                                                                                        <div class="form-group">
                                                                                            <label class="input"> <i
                                                                                                        class="icon-append fa fa-user"></i>

                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Pacing Plan"
                                                                                                       type="text"
                                                                                                       name="pacing_plan"
                                                                                                       id="pacing_plan">
                                                                                            </label>
                                                                                        </div>
                                                                                    </section>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <p>
                                                                                    Date Rang
                                                                                </p>
                                                                                <hr class="simple">

                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                    <span class="input-group-addon"><i
                                                                                                                class="fa fa-calendar fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       type="text"
                                                                                                       name="startdate"
                                                                                                       id="startdate"
                                                                                                       placeholder="Expected start date">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                    <span class="input-group-addon"><i
                                                                                                                class="fa fa-calendar fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       type="text"
                                                                                                       name="finishdate"
                                                                                                       id="finishdate"
                                                                                                       placeholder="Expected finish date">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <!-- end widget content -->

                                                                </div>
                                                                <!-- end widget div -->

                                                            </div>
                                                            <!-- end widget -->


                                                        </article>
                                                        <!-- WIDGET END -->
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">
                                                        <br>

                                                        <h3><strong>Step 2</strong> - CONFIGURATION</h3>
                                                        <!-- NEW WIDGET START -->
                                                        <article class="col-sm-12 col-md-12 col-lg-12">

                                                            <!-- Widget ID (each widget will need unique ID)-->
                                                            <div class="well">
                                                                <!-- widget div-->
                                                                <div>


                                                                    <!-- widget content -->
                                                                    <div class="">

                                                                        <ul id="myTab1" class="nav nav-tabs bordered">
                                                                            <li class="active">
                                                                                <a href="#v1" data-toggle="tab">Set Geo
                                                                                    Location</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#v2" data-toggle="tab"><i
                                                                                            class="fa fa-fw fa-lg fa-gear"></i>
                                                                                    Assign Creative</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#v3" data-toggle="tab"><i
                                                                                            class="fa fa-fw fa-lg fa-gear"></i>
                                                                                    Set Black\white list</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#v4" data-toggle="tab"><i
                                                                                            class="fa fa-fw fa-lg fa-gear"></i>
                                                                                    Set Geo Segments</a>
                                                                            </li>


                                                                        </ul>

                                                                        <div id="myTabContent2"
                                                                             class="tab-content">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="v1">

                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-offset-3">
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
                                                                                </div>

                                                                            </div>
                                                                            <div class="tab-pane fade"
                                                                                 id="v2">

                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-offset-3">
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
                                                                                </div>

                                                                            </div>
                                                                            <div class="tab-pane fade"
                                                                                 id="v3">

                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-offset-3">

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

                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade"
                                                                                 id="v4">

                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-offset-3">
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
                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <!-- end widget content -->

                                                                </div>
                                                                <!-- end widget div -->

                                                            </div>
                                                            <!-- end widget -->


                                                        </article>
                                                        <!-- WIDGET END -->
                                                        <div class="clearfix"></div>

                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <br>

                                                        <h3><strong>Step 3</strong> - Domain Setup</h3>
                                                        <!-- NEW WIDGET START -->
                                                        <article class="col-sm-12 col-md-12 col-lg-12">

                                                            <!-- Widget ID (each widget will need unique ID)-->
                                                            <div class=" well">
                                                                <!-- widget div-->
                                                                <div>

                                                                    <!-- widget content -->
                                                                    <div class="">

                                                                        <hr class="simple">
                                                                        <ul id="myTab2" class="nav nav-tabs bordered">
                                                                            <li class="active">
                                                                                <a href="#u1" data-toggle="tab">Bid by
                                                                                    publisher</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#u2" data-toggle="tab"><i
                                                                                            class="fa fa-fw fa-lg fa-gear"></i>
                                                                                    Hours</a>
                                                                            </li>


                                                                        </ul>

                                                                        <div id="myTabContent3"
                                                                             class="tab-content">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="u1">
                                                                                <div class="row"
                                                                                     id="advertiser_publisher">
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="publisher_name0"
                                                                                                       id="publisher_name">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Bid"
                                                                                                       type="text"
                                                                                                       name="bid0"
                                                                                                       id="bid">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <input type="button"
                                                                                               value="send"
                                                                                               onclick="submitForm() "/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <table class="table table-striped table-bordered ">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th>id</th>
                                                                                                <th>Publisher name</th>
                                                                                                <th>Bid :</th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody id="show_bid">

                                                                                            </tbody>
                                                                                        </table>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="tab-pane fade" id="u2">
                                                                                <div class="row">
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
                                                                                                            monday @elseif($i==1)
                                                                                                            tusday @elseif($i==2)
                                                                                                            wendsday @elseif($i==3)
                                                                                                            tursday @elseif($i==4)
                                                                                                            friday @elseif($i==5)
                                                                                                            satarday @elseif($i==6)
                                                                                                            sunday @endif</td>
                                                                                                    @for($j=0;$j<24;$j++)
                                                                                                        <td style="padding: 1px!important;">
                                                                                                            <div id="{{$i}}-{{$j}}-time" class="time_table_unselect" ></div>

                                                                                                            <input type="checkbox" name="{{$i}}-{{$j}}-hour" id="{{$i}}-{{$j}}-time-checkbox" style="display: none"/>
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
                                                                                        <select name=""
                                                                                                id="suggested">
                                                                                            <option value="business-hours">Business Hours</option>
                                                                                            <option value="happy-hours">Happy Hours</option>
                                                                                            <option value="business-hours">Business Hours</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <!-- end widget content -->

                                                                </div>
                                                                <!-- end widget div -->

                                                            </div>
                                                            <!-- end widget -->


                                                        </article>
                                                        <!-- WIDGET END -->
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="tab-pane" id="tab4">
                                                        <br>

                                                        <h3><strong>Step 4</strong> - Review And Submit</h3>
                                                        <br>

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
                                                            <div class="col-md-3">
                                                                <h3>Assigned Geo Location</h3>
                                                                <table class="table table-bordered table-responsive">
                                                                    <tr>
                                                                        <td><span id="rev_assign_geolocation"></span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h3>Assigned Creative</h3>
                                                                <table class="table table-bordered table-responsive">
                                                                    <tr>
                                                                        <td><span id="rev_assign_creative"></span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h3>Assigned Black/White List <span
                                                                            id="rev_bwlist"></span></h3>
                                                                <table class="table table-bordered table-responsive">
                                                                    <tr>
                                                                        <td><span id="rev_assign_bwlist"></span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h3>Assigned Geo Segment</h3>
                                                                <table class="table table-bordered table-responsive">
                                                                    <tr>
                                                                        <td><span id="rev_assign_geosegment"></span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <input class="btn btn-success" type="submit" value="SUBMIT"/>
                                                        <br>
                                                        <br>
                                                    </div>

                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <ul class="pager wizard no-margin">
                                                                    <!--<li class="previous first disabled">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
                                                                    </li>-->
                                                                    <li class="previous disabled">
                                                                        <a href="javascript:void(0);"
                                                                           class="btn btn-lg btn-default"> Previous </a>
                                                                    </li>
                                                                    <!--<li class="next last">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
                                                                    </li>-->
                                                                    <li class="next">
                                                                        <a href="javascript:void(0);"
                                                                           class="btn btn-lg txt-color-darken">
                                                                            Next </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
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

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
@endsection
@section('FooterScripts')

    <script src="{{cdn('js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{cdn('js/plugin/fuelux/wizard/wizard.min.js')}}"></script>
    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>
    <script src="{{cdn('js/plugin/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

    <script>
        for(var i=0; i<7; i++){
            for(var j=0;j<24;j++){
                $('#'+i+'-'+j+'-time').click(function () {
                    var id =$(this).attr('id');
                    $('#'+id+'-checkbox').prop('checked', true);
                    $(this).removeClass();
                    $(this).addClass('time-table-div-select');
                });
            }
        }
        $('#clear_all').click(function () {
            for(var i=0; i<7; i++){
                for(var j=0;j<24;j++){
                    var id =$('#'+i+'-'+j+'-time').attr('id');
                    $('#'+id+'-checkbox').prop('checked', false);
                    $('#'+i+'-'+j+'-time').removeClass();
                    $('#'+i+'-'+j+'-time').addClass('time_table_unselect');
                }
            }

        })
        $('#suggested').change(function () {
            if($(this).val()=='business-hours'){
                $('#clear_all').click();
                for(var i=0; i<5; i++){
                    for(var j=9;j<17;j++){
                        var id =$('#'+i+'-'+j+'-time').attr('id');
                        $('#'+id+'-checkbox').prop('checked', true);
                        $('#'+i+'-'+j+'-time').removeClass();
                        $('#'+i+'-'+j+'-time').addClass('time-table-div-select');
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
                    }
                }
                for(var i=5; i<7; i++){
                    for(var j=0;j<24;j++){
                        var id =$('#'+i+'-'+j+'-time').attr('id');
                        $('#'+id+'-checkbox').prop('checked', true);
                        $('#'+i+'-'+j+'-time').removeClass();
                        $('#'+i+'-'+j+'-time').addClass('time-table-div-select');
                    }
                }
            }
        })
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function submitForm() {
//            var form=$('#publisher_bid');
//            console.log(form);
            var url = '{{url('/advertiser_publisher/create')}}';
            var formData = {};
            formData['advertiser_id'] = '{{$campaign_obj->getAdvertiser->id}}';
            $('#advertiser_publisher').find("input").each(function (index, node) {
                formData[node.name] = node.value;
            });
            console.log(formData);
//
            $.post(url, formData).done(function (data) {
                $('#advertiser_publisher').find("input").each(function (index, node) {
                    node.value = '';
                });
                var data = JSON.parse(data);
                for (var i = 0; i < data.length; i = i + 3) {
                    var elem = '';
                    elem = "<tr><td>" + data[i] + "</td><td>" + data[i + 1] + "</td><td><input type='text' class='form-control' name='" + data[i] + "-bid' value='" + data[i + 2] + "'></td></tr>";
                    $('#show_bid').append(elem);
                }
            });
        }
        function ShowSubCategory(id) {
            $.ajax({
                url: "{{url('/get_iab_sub_category')}}" + '/' + id
            }).success(function (response) {
                var cb = '';
                var data = jQuery.parseJSON(response);
                var len = data.length;
                cb = '<option value="0" disabled>select one</option>';
                for (var i = 0; i < len; i++) {
                    cb += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }
                $('#iab_sub_category').html(cb);
            });
        }
        function setReview() {
            $('#rev_assign_creative').html('');
            $('#rev_assign_bwlist').html('');
            $('#rev_assign_geosegment').html('');
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
            $('#assign_geolocation_to').find('option').each(function () {
                $('#rev_assign_geolocation').append($(this).html() + '<br>');
            });
            console.log($('#initializeDuallistbox'));
            $('#rev_name').html($('#name').val());
            $('#rev_domain_name').html($('#nameadvertiser_domain_name').val());
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
        $(document).ready(function () {


            pageSetUp();
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
                }
            });

            $('#assign_geosegment').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
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


            var $validator = $("#wizard-1").validate({

                rules: {
                    name: {
                        required: true
                    },
                    advertiser_domain_name: {
                        required: true,
                        url: "site url like: www.yourdomain.com"
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

            $('#bootstrap-wizard-1').bootstrapWizard({
                'tabClass': 'form-wizard',
                'onNext': function (tab, navigation, index) {
                    var $valid = $("#wizard-1").valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    } else {
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                                'complete');
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                                .html('<i class="fa fa-check"></i>');
                    }
                }
            });

            // START AND FINISH DATE
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


        })

    </script>
@endsection