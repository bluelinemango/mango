@extends('Layout')
@section('siteTitle')Edit Target Group @endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Home</li>
                <li>Client: <a
                            href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a>
                </li>
                <li>Advertiser: <a
                            href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/edit')}}">adv{{$campaign_obj->getAdvertiser->id}}</a>
                </li>
                <li>Campaign : <a
                            href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/campaign/cmp'.$campaign_obj->id.'/edit')}}">cmp{{$campaign_obj->id}}</a>
                </li>
                <li>Target Group Registration</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:

            <span class="ribbon-button-alignment pull-right">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
            </span> -->

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
                        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false"
                             data-widget-deletebutton="false">
                            <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"

                            -->
                            <header>
                                <span class="widget-icon"> <i class="fa fa-check"></i> </span>

                                <h2>Add Target group </h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body">

                                    <div class="row">
                                        <form id="wizard-1" novalidate="novalidate"
                                              action="{{URL::route('targetgroup_update')}}" method="post">
                                            <input type="hidden" name="_method" value="PUT"/>

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="targetgroup_id" value="{{$targetgroup_obj->id}}">

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
                                                            <a href="#tab4" data-toggle="tab"> <span
                                                                        class="step">4</span> <span class="title">Save Form</span>
                                                            </a>
                                                        </li>
                                                        <li data-target="#step5">
                                                            <a href="#tab5" data-toggle="tab"
                                                               onclick="setReview()"> <span
                                                                        class="step">5</span> <span class="title">Review And Submition</span>
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

                                                            <!-- Widget ID (each widget will need unique ID)-->
                                                            <div class="jarviswidget well" id="wid-id-3"
                                                                 data-widget-colorbutton="false"
                                                                 data-widget-editbutton="false"
                                                                 data-widget-togglebutton="false"
                                                                 data-widget-deletebutton="false"
                                                                 data-widget-fullscreenbutton="false"
                                                                 data-widget-custombutton="false"
                                                                 data-widget-sortable="false">
                                                                <!-- widget options:
                                                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                                                data-widget-colorbutton="false"
                                                                data-widget-editbutton="false"
                                                                data-widget-togglebutton="false"
                                                                data-widget-deletebutton="false"
                                                                data-widget-fullscreenbutton="false"
                                                                data-widget-custombutton="false"
                                                                data-widget-collapsed="true"
                                                                data-widget-sortable="false"

                                                                -->
                                                                <header>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-comments"></i> </span>

                                                                    <h2>Default Tabs with border </h2>

                                                                </header>

                                                                <!-- widget div-->
                                                                <div>

                                                                    <!-- widget edit box -->
                                                                    <div class="jarviswidget-editbox">
                                                                        <!-- This area used as dropdown edit box -->

                                                                    </div>
                                                                    <!-- end widget edit box -->

                                                                    <!-- widget content -->
                                                                    <div class="widget-body">

                                                                        <p>
                                                                            Tabs inside
                                                                            <code>
                                                                                .jarviswidget .well
                                                                            </code>
                                                                            (Bordered Tabs)
                                                                        </p>
                                                                        <hr class="simple">


                                                                        <div id="myTabContent1"
                                                                             class="tab-content padding-10">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="s1">

                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Name Of Target Group"
                                                                                                       type="text"
                                                                                                       name="name"
                                                                                                       value="{{$targetgroup_obj->name}}"
                                                                                                       id="name">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <select name="iab_category"
                                                                                                        class="form-control "
                                                                                                        id=""
                                                                                                        onchange="ShowSubCategory(this.value)">
                                                                                                    <option value="0"
                                                                                                            disabled>
                                                                                                        Select one ...
                                                                                                    </option>
                                                                                                    @foreach($iab_category_obj as $index)
                                                                                                        <option value="{{$index->id}}" @if($targetgroup_obj->iab_category == $index->id) selected @endif>{{$index->name}}</option>
                                                                                                    @endforeach
                                                                                                </select>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    {{--[7:28:13 PM] Mahmoud Taabodi: entertainment--}}
                                                                                    {{--[7:28:15 PM] Mahmoud Taabodi: financial--}}
                                                                                    {{--[7:28:19 PM] Mahmoud Taabodi: health--}}
                                                                                    {{--[7:28:38 PM] Mahmoud Taabodi: ke entertainment in sub category haaro dare :   movies, theater, sport--}}
                                                                                    {{--[7:28:59 PM] Mahmoud Taabodi: financial  inaaro dare :  banking, insurance, investment--}}
                                                                                    {{--[7:29:13 PM] Mahmoud Taabodi: health :  women health, family health, insurance                                                                                    --}}

                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <select name="iab_sub_category"
                                                                                                        class="form-control "
                                                                                                        id="iab_sub_category">

                                                                                                @if(!is_null($targetgroup_obj->iab_sub_category))
                                                                                                    <option value="{{$targetgroup_obj->iab_sub_category}}"
                                                                                                            >
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
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       type="text"
                                                                                                       placeholder="Domain Name"
                                                                                                       name="advertiser_domain_name"
                                                                                                       value="{{$targetgroup_obj->advertiser_domain_name}}"
                                                                                                       id="advertiser_domain_name"
                                                                                                        >

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-eye fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Max Impressions"
                                                                                                       type="text"
                                                                                                       name="max_impression"
                                                                                                       value="{{$targetgroup_obj->max_impression}}"
                                                                                                       id="max_impression">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-eye fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Daily Max Imps"
                                                                                                       type="text"
                                                                                                       name="daily_max_impression"
                                                                                                       value="{{$targetgroup_obj->daily_max_impression}}"
                                                                                                       id="daily_max_impression">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-dollar fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Max Budget"
                                                                                                       type="text"
                                                                                                       name="max_budget"
                                                                                                       value="{{$targetgroup_obj->max_budget}}"
                                                                                                       id="max_budget">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-dollar fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Daily Max Budget"
                                                                                                       type="text"
                                                                                                       name="daily_max_budget"
                                                                                                       value="{{$targetgroup_obj->daily_max_budget}}"
                                                                                                       id="daily_max_budget">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-eye fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Frequency per sec"
                                                                                                       type="text"
                                                                                                       name="frequency_in_sec"
                                                                                                       value="{{$targetgroup_obj->frequency_in_sec}}"
                                                                                                       id="frequency_in_sec">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-eye fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="MAX CPM"
                                                                                                       type="text"
                                                                                                       name="cpm"
                                                                                                       value="{{$targetgroup_obj->cpm}}"
                                                                                                       id="cpm">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-eye fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Pacing Plan"
                                                                                                       type="text"
                                                                                                       name="pacing_plan"
                                                                                                       value="{{$targetgroup_obj->pacing_plan}}"
                                                                                                       id="pacing_plan">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                                                                                                       value="{{$targetgroup_obj->start_date}}"

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
                                                                                                       value="{{$targetgroup_obj->end_date}}"

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

                                                        <h3><strong>Step 4</strong> - CONFIGURATION</h3>
                                                        <!-- NEW WIDGET START -->
                                                        <article class="col-sm-12 col-md-12 col-lg-12">

                                                            <!-- Widget ID (each widget will need unique ID)-->
                                                            <div class="jarviswidget well" id="wid-id-3"
                                                                 data-widget-colorbutton="false"
                                                                 data-widget-editbutton="false"
                                                                 data-widget-togglebutton="false"
                                                                 data-widget-deletebutton="false"
                                                                 data-widget-fullscreenbutton="false"
                                                                 data-widget-custombutton="false"
                                                                 data-widget-sortable="false">
                                                                <!-- widget options:
                                                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                                                data-widget-colorbutton="false"
                                                                data-widget-editbutton="false"
                                                                data-widget-togglebutton="false"
                                                                data-widget-deletebutton="false"
                                                                data-widget-fullscreenbutton="false"
                                                                data-widget-custombutton="false"
                                                                data-widget-collapsed="true"
                                                                data-widget-sortable="false"

                                                                -->
                                                                <header>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-comments"></i> </span>

                                                                    <h2>Default Tabs with border </h2>

                                                                </header>

                                                                <!-- widget div-->
                                                                <div>

                                                                    <!-- widget edit box -->
                                                                    <div class="jarviswidget-editbox">
                                                                        <!-- This area used as dropdown edit box -->

                                                                    </div>
                                                                    <!-- end widget edit box -->

                                                                    <!-- widget content -->
                                                                    <div class="widget-body">

                                                                        <p>
                                                                            Tabs inside
                                                                            <code>
                                                                                .jarviswidget .well
                                                                            </code>
                                                                            (Bordered Tabs)
                                                                        </p>
                                                                        <hr class="simple">
                                                                        <ul id="myTab1" class="nav nav-tabs bordered">
                                                                            <li class="active">
                                                                                <a href="#v1" data-toggle="tab">Set Geo
                                                                                    Target</a>
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

                                                                        <div id="myTabContent1"
                                                                             class="tab-content padding-10">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="v1">

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="fname"
                                                                                                       id="fname">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="tab-pane fade in active"
                                                                                 id="v2">

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <!-- widget content -->
                                                                                        <div class="widget-body">

                                                                                            <select multiple="multiple"
                                                                                                    size="10"
                                                                                                    name="creative[]"
                                                                                                    id="initializeDuallistbox_creative">

                                                                                                @foreach($campaign_obj->getAdvertiser->Creative as $index)
                                                                                                        <option value="{{$index->id}}" @if(in_array($index->id,$targetgroupCreative)) selected @endif>{{$index->name}}</option>
                                                                                                @endforeach
                                                                                            </select>

                                                                                        </div>
                                                                                        <!-- end widget content -->
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="tab-pane fade in active"
                                                                                 id="v3">

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">

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
                                                                                                            Assign Black List
                                                                                                        </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <!-- panel body -->
                                                                                                <div id="blacklist"
                                                                                                     class="panel-collapse collapse in">
                                                                                                    <div class="panel-body">
                                                                                                        <!-- widget content -->
                                                                                                        <div class="widget-body" id="blacklist_select">

                                                                                                            <select multiple="multiple"
                                                                                                                    size="10"
                                                                                                                    name="blacklist[]"
                                                                                                                    id="initializeDuallistbox_blacklist">

                                                                                                                @foreach($campaign_obj->getAdvertiser->BWList as $index)
                                                                                                                    @if($index->list_type == 'black')
                                                                                                                        <option value="{{$index->id}}" @if(in_array($index->id,$targetgroupBWList)) selected @endif>{{$index->name}}</option>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </select>

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
                                                                                                            Assign White List
                                                                                                        </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <!-- panel body -->
                                                                                                <div id="accordionTwo"
                                                                                                     class="panel-collapse collapse">
                                                                                                    <div class="panel-body">
                                                                                                        <!-- widget content -->
                                                                                                        <div class="widget-body">

                                                                                                            <select multiple="multiple"
                                                                                                                    size="10"
                                                                                                                    name="whitelist[]"
                                                                                                                    id="initializeDuallistbox_whitelist">

                                                                                                                @foreach($campaign_obj->getAdvertiser->BWList as $index)
                                                                                                                    @if($index->list_type == 'white')
                                                                                                                        <option value="{{$index->id}}" @if(in_array($index->id,$targetgroupBWList)) selected @endif>{{$index->name}}</option>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </select>

                                                                                                        </div>
                                                                                                        <!-- end widget content -->
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade in active"
                                                                                 id="v4">

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <!-- widget content -->
                                                                                        <div class="widget-body">

                                                                                            <select multiple="multiple"
                                                                                                    size="10"
                                                                                                    name="geosegment[]"
                                                                                                    id="initializeDuallistbox">

                                                                                                @foreach($campaign_obj->getAdvertiser->GeoSegment as $index)
                                                                                                    <option value="{{$index->id}}" @if(in_array($index->id,$targetgroupGeoSegment)) selected @endif>{{$index->name}}</option>
                                                                                                @endforeach
                                                                                            </select>

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
                                                            <div class="jarviswidget well" id="wid-id-3"
                                                                 data-widget-colorbutton="false"
                                                                 data-widget-editbutton="false"
                                                                 data-widget-togglebutton="false"
                                                                 data-widget-deletebutton="false"
                                                                 data-widget-fullscreenbutton="false"
                                                                 data-widget-custombutton="false"
                                                                 data-widget-sortable="false">
                                                                <!-- widget options:
                                                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                                                data-widget-colorbutton="false"
                                                                data-widget-editbutton="false"
                                                                data-widget-togglebutton="false"
                                                                data-widget-deletebutton="false"
                                                                data-widget-fullscreenbutton="false"
                                                                data-widget-custombutton="false"
                                                                data-widget-collapsed="true"
                                                                data-widget-sortable="false"

                                                                -->
                                                                <header>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-comments"></i> </span>

                                                                    <h2>Default Tabs with border </h2>

                                                                </header>

                                                                <!-- widget div-->
                                                                <div>

                                                                    <!-- widget edit box -->
                                                                    <div class="jarviswidget-editbox">
                                                                        <!-- This area used as dropdown edit box -->

                                                                    </div>
                                                                    <!-- end widget edit box -->

                                                                    <!-- widget content -->
                                                                    <div class="widget-body">

                                                                        <p>
                                                                            Tabs inside
                                                                            <code>
                                                                                .jarviswidget .well
                                                                            </code>
                                                                            (Bordered Tabs)
                                                                        </p>
                                                                        <hr class="simple">
                                                                        <ul id="myTab1" class="nav nav-tabs bordered">
                                                                            <li class="active">
                                                                                <a href="#u1" data-toggle="tab">Bid by
                                                                                    publisher</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#u2" data-toggle="tab"><i
                                                                                            class="fa fa-fw fa-lg fa-gear"></i>
                                                                                    Publisher name</a>
                                                                            </li>


                                                                        </ul>

                                                                        <div id="myTabContent1"
                                                                             class="tab-content padding-10">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="u1">

                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="fname"
                                                                                                       id="fname">

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
                                                                                                       name="lname"
                                                                                                       id="lname">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="fname"
                                                                                                       id="fname">

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
                                                                                                       name="lname"
                                                                                                       id="lname">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="fname"
                                                                                                       id="fname">

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
                                                                                                       name="lname"
                                                                                                       id="lname">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="fname"
                                                                                                       id="fname">

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
                                                                                                       name="lname"
                                                                                                       id="lname">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i
                                                                                                            class="fa fa-user fa-lg fa-fw"></i></span>
                                                                                                <input class="form-control input-md"
                                                                                                       placeholder="Publisher Name"
                                                                                                       type="text"
                                                                                                       name="fname"
                                                                                                       id="fname">

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
                                                                                                       name="lname"
                                                                                                       id="lname">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="tab-pane fade" id="u2">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <table class="table table-striped table-bordered ">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th>id</th>
                                                                                                <th>Publisher name</th>
                                                                                                <th>Bid :</th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td>134</td>
                                                                                                <td>b2</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="23">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>135</td>
                                                                                                <td>b7</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="3">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>136</td>
                                                                                                <td>b12</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="14">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>137</td>
                                                                                                <td>b1</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="26">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>138</td>
                                                                                                <td>b15</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="20">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>139</td>
                                                                                                <td>b1</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="23">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>140</td>
                                                                                                <td>b15</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="20">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>141</td>
                                                                                                <td>b1</td>
                                                                                                <td><input type="text"
                                                                                                           class="form-control"
                                                                                                           value="23">
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
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

                                                        <h3><strong>Step 2</strong> - BID BY HOUR</h3>

                                                        <!-- NEW WIDGET START -->
                                                        <article class="col-sm-12 col-md-12 col-lg-12">

                                                            <!-- Widget ID (each widget will need unique ID)-->
                                                            <div class="jarviswidget well" id="wid-id-3"
                                                                 data-widget-colorbutton="false"
                                                                 data-widget-editbutton="false"
                                                                 data-widget-togglebutton="false"
                                                                 data-widget-deletebutton="false"
                                                                 data-widget-fullscreenbutton="false"
                                                                 data-widget-custombutton="false"
                                                                 data-widget-sortable="false">
                                                                <!-- widget options:
                                                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                                                data-widget-colorbutton="false"
                                                                data-widget-editbutton="false"
                                                                data-widget-togglebutton="false"
                                                                data-widget-deletebutton="false"
                                                                data-widget-fullscreenbutton="false"
                                                                data-widget-custombutton="false"
                                                                data-widget-collapsed="true"
                                                                data-widget-sortable="false"

                                                                -->
                                                                <header>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-comments"></i> </span>

                                                                    <h2>Default Tabs with border </h2>

                                                                </header>

                                                                <!-- widget div-->
                                                                <div>

                                                                    <!-- widget edit box -->
                                                                    <div class="jarviswidget-editbox">
                                                                        <!-- This area used as dropdown edit box -->

                                                                    </div>
                                                                    <!-- end widget edit box -->

                                                                    <!-- widget content -->
                                                                    <div class="widget-body">

                                                                        <p>
                                                                            Tabs inside
                                                                            <code>
                                                                                .jarviswidget .well
                                                                            </code>
                                                                            (Bordered Tabs)
                                                                        </p>
                                                                        <hr class="simple">
                                                                        <ul id="myTab1" class="nav nav-tabs bordered">
                                                                            <li class="active">
                                                                                <a href="#t1" data-toggle="tab">AM</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#t2" data-toggle="tab"><i
                                                                                            class="fa fa-fw fa-lg fa-gear"></i>
                                                                                    PM</a>
                                                                            </li>


                                                                        </ul>

                                                                        <div id="myTabContent1"
                                                                             class="tab-content padding-10">
                                                                            <div class="tab-pane fade in active"
                                                                                 id="t1">

                                                                                <div class="row">
                                                                                    <table class="table table-hover">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>Hours</th>
                                                                                            <th>1:00 AM</th>
                                                                                            <th>2:00 AM</th>
                                                                                            <th>3:00 AM</th>
                                                                                            <th>4:00 AM</th>
                                                                                            <th>5:00 AM</th>
                                                                                            <th>6:00 AM</th>
                                                                                            <th>7:00 AM</th>
                                                                                            <th>8:00 AM</th>
                                                                                            <th>9:00 AM</th>
                                                                                            <th>10:00 AM</th>
                                                                                            <th>11:00 AM</th>
                                                                                            <th>12:00 AM</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Sun</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Mon</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Tue</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Wed</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Thu</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Fri</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Sat</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>


                                                                            </div>
                                                                            <div class="tab-pane fade" id="t2">
                                                                                <div class="row">
                                                                                    <table class="table table-hover">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>Hours</th>
                                                                                            <th>1:00 PM</th>
                                                                                            <th>2:00 PM</th>
                                                                                            <th>3:00 PM</th>
                                                                                            <th>4:00 PM</th>
                                                                                            <th>5:00 PM</th>
                                                                                            <th>6:00 PM</th>
                                                                                            <th>7:00 PM</th>
                                                                                            <th>8:00 PM</th>
                                                                                            <th>9:00 PM</th>
                                                                                            <th>10:00 PM</th>
                                                                                            <th>11:00 PM</th>
                                                                                            <th>12:00 PM</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Sun</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Mon</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Tue</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Wed</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Thu</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Fri</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Sat</td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                            <td><input type="text"
                                                                                                       class="form-control">
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
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
                                                    <div class="tab-pane" id="tab5">
                                                        <br>

                                                        <h3><strong>Step 5</strong> - Save Form</h3>
                                                        <br>

                                                        <div class="row" id="step1_review">

                                                        </div>
                                                        <h1 class="text-center text-success"><strong><i
                                                                        class="fa fa-check fa-lg"></i> Complete</strong>
                                                        </h1>
                                                        <input type="submit" value="SUBMIT"/>
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
    <script src="{{cdn('js/plugin/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function ShowSubCategory(id) {
            $.ajax({
                url: "{{url('/get_iab_sub_category')}}" +'/'+ id
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
            console.log($('#initializeDuallistbox'));
            $('#step1_review').html('name of target group:' + $('#name').val());
        }
        function taggleBWList(type){
            if(type == 'blacklist'){
                var conf = confirm('are u sure?');
                if(conf){
                    jQuery('#whitelist_select .removeall').click();
                }
            }
            if(type == 'whitelist'){
                var conf = confirm('are u sure?');
                if(conf){
                    jQuery('#blacklist_select .removeall').click();
                }
            }
        }
    </script>
    <script>
        $(document).ready(function () {


            pageSetUp();


            var $registerForm = $("#smart-form-register").validate({

                // Rules for form validation
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    terms: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    login: {
                        required: 'Please enter your login'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    },
                    passwordConfirm: {
                        required: 'Please enter your password one more time',
                        equalTo: 'Please enter the same password as above'
                    },
                    firstname: {
                        required: 'Please select your first name'
                    },
                    lastname: {
                        required: 'Please select your last name'
                    },
                    gender: {
                        required: 'Please select your gender'
                    },
                    terms: {
                        required: 'You must agree with Terms and Conditions'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
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

            var initializeDuallistbox = $('#initializeDuallistbox').bootstrapDualListbox({
                nonSelectedListLabel: 'Non-selected',
                selectedListLabel: 'Selected',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                nonSelectedFilter: ''
            });
            var initializeDuallistbox_blacklist = $('#initializeDuallistbox_blacklist').bootstrapDualListbox({
                nonSelectedListLabel: 'Non-selected',
                selectedListLabel: 'Selected',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                nonSelectedFilter: ''
            });
            var initializeDuallistbox_whitelist = $('#initializeDuallistbox_whitelist').bootstrapDualListbox({
                nonSelectedListLabel: 'Non-selected',
                selectedListLabel: 'Selected',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                nonSelectedFilter: ''
            });
            var initializeDuallistbox_creative = $('#initializeDuallistbox_creative').bootstrapDualListbox({
                nonSelectedListLabel: 'Non-selected',
                selectedListLabel: 'Selected',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                nonSelectedFilter: ''
            });

            var $validator = $("#wizard-1").validate({

                rules: {
                    email: {
                        required: true,
                        email: "Your email address must be in the format of name@domain.com"
                    },
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    postal: {
                        required: true,
                        minlength: 4
                    },
                    wphone: {
                        required: true,
                        minlength: 10
                    },
                    hphone: {
                        required: true,
                        minlength: 10
                    }
                },

                messages: {
                    fname: "Please specify your First name",
                    lname: "Please specify your Last name",
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


            // fuelux wizard
            var wizard = $('.wizard').wizard();

            wizard.on('finished', function (e, data) {
                //$("#fuelux-wizard").submit();
                //console.log("submitted!");
                $.smallBox({
                    title: "Congratulations! Your form was submitted",
                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                    color: "#5F895F",
                    iconSmall: "fa fa-check bounce animated",
                    timeout: 4000
                });

            });


        })

    </script>
@endsection