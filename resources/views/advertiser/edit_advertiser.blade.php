@extends('Layout')
@section('siteTitle')Edit Advertiser: {{$adver_obj->name}} @endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <span class="ribbon-button-alignment">
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip"
                      data-placement="bottom"
                      data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings."
                      data-html="true">
                    <i class="fa fa-refresh"></i>
                </span>
            </span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/edit')}}">client:
                        cl{{$adver_obj->GetClientID->id}}</a></li>
                <li>Advertiser: adv{{$adver_obj->id}} </li>
            </ol>

        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
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
                        <article class="col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <header>
                                    <h2>Edit Advertiser: {{$adver_obj->name}} </h2>
                                </header>

                                <!-- widget div-->
                                <div class="row">
                                    <!-- widget content -->
                                    <div class="col-md-9">

                                        <form id="order-form" class="smart-form"
                                              action="{{URL::route('advertiser_update')}}" method="post"
                                              novalidate="novalidate">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="adver_id" value="{{$adver_obj->id}}"/>
                                            <input type="hidden" id="active_show"/>
                                            <header>
                                                General Information
                                            </header>

                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-3">
                                                            <label class="label" for=""> Name</label>
                                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                                <input type="text" name="name" placeholder="Name"
                                                                       value="{{$adver_obj->name}}">
                                                            </label>
                                                        </section>
                                                        <section class="col col-3">
                                                            <label class="label" for="">Domain Name</label>
                                                            <label class="input"> <i
                                                                        class="icon-append fa fa-briefcase"></i>
                                                                <input type="text" name="domain_name"
                                                                       placeholder="Domain Name"
                                                                       value="{{$adver_obj->domain_name}}">
                                                            </label>
                                                        </section>
                                                        <section class="col col-3">
                                                            <label for="" class="label">Status</label>
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="active" @if($adver_obj->status=='Active') checked @endif>
                                                                <i></i>
                                                            </label>
                                                        </section>

                                                        <section class="col col-3">
                                                            <label class="label" for="">Client Name</label>
                                                            <label class="input">
                                                                <h6>{{$adver_obj->GetClientID->name}}</h6>
                                                            </label>
                                                        </section>
                                                    </div>
                                                </fieldset>

                                                <fieldset>

                                                    <section class="col -col4">
                                                        <label class="label" for="">Description</label>
                                                        <label class="textarea"> <i
                                                                    class="icon-append fa fa-comment"></i>
                                                            <textarea rows="5" name="description"
                                                                      placeholder="Tell us about your advertiser">{{$adver_obj->description}}</textarea>
                                                        </label>
                                                    </section>
                                                </fieldset>

                                                <fieldset>
                                                    <div style="margin: 20px 0;">
                                                        <h5>Assign Models</h5>

                                                        <div class="col-xs-5">
                                                            <select name="from_model[]" id="assign_model"
                                                                    class="form-control" size="4" multiple="multiple">
                                                                @foreach($model_obj as $index)
                                                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-xs-2">
                                                            <button type="button" id="assign_model_rightAll"
                                                                    class="btn btn-block"><i
                                                                        class="glyphicon glyphicon-forward"></i>
                                                            </button>
                                                            <button type="button" id="assign_model_rightSelected"
                                                                    class="btn btn-block"><i
                                                                        class="glyphicon glyphicon-chevron-right"></i>
                                                            </button>
                                                            <button type="button" id="assign_model_leftSelected"
                                                                    class="btn btn-block"><i
                                                                        class="glyphicon glyphicon-chevron-left"></i>
                                                            </button>
                                                            <button type="button" id="assign_model_leftAll"
                                                                    class="btn btn-block"><i
                                                                        class="glyphicon glyphicon-backward"></i>
                                                            </button>
                                                        </div>

                                                        <div class="col-xs-5">
                                                            <select name="to_model[]" id="assign_model_to"
                                                                    class="form-control" size="4" multiple="multiple">
                                                                @foreach($model_obj as $index)
                                                                    @if(in_array($index->id,$adv_mdl_map))
                                                                        <option value="{{$index->id}}">{{$index->name}}</option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </fieldset>

                                            </div>
                                            <div class="clearfix"></div>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--ujarak button--border-thick button--text-upper button--size-s button--inverted button--text-thick">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card" >
                                            <div class="card-heading">
                                                <h2 class="pull-left">Activities</h2>
                                                <select id="audit_status" class="pull-right">
                                                    <option value="entity">This Entity</option>
                                                    <option value="all">All</option>
                                                    <option value="user">User</option>
                                                </select>
                                                <div class="clearfix"></div>
                                                <small>All Activities for this Entity </small>
                                            </div>
                                            <div class="card-body" >
                                                <div class="streamline b-l b-accent m-b" id="show_audit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- WIDGET END -->

                                    </div>

                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                            </div>
                            <!-- end widget -->

                        </article>
                        <!-- END COL -->
                        <!-- NEW COL START -->
                        <article class="col-sm-3 col-md-3 col-lg-3">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well"  style="position: fixed; width: 18%">
                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">
                                        <button id="show_creative" class="btn btn-primary btn-block">Crearive </button>
                                        <button id="show_campaign" class="btn btn-primary btn-block">Campaign </button>
                                        <button id="show_bwlist" class="btn btn-primary btn-block">B W List </button>
                                        <button id="show_geosegment" class="btn btn-primary btn-block">Geo Segment </button>
                                        <button id="show_model" class="btn btn-primary btn-block">Model </button>
                                        <button id="show_bid_profile" class="btn btn-primary btn-block">Bid Profile </button>
                                        @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                            <button id="show_segment" class="btn btn-primary btn-block">Segment </button>
                                        @endif
                                        @if(in_array('ADD_EDIT_OFFER',$permission))
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/offer/add')}}"
                                               class=" btn btn-primary btn-block">
                                                Add Offer
                                            </a>
                                        @endif
                                        @if(in_array('ADD_EDIT_PIXEL',$permission))
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/pixel/add')}}"
                                               class=" btn btn-primary btn-block">
                                                Add Pixel
                                            </a>
                                        @endif
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

                    <!-- row -->
                    <div class="row" id="campaign_list" style="display: none">
                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Campaign</strong></h2>
                                    @if(in_array('ADD_EDIT_CAMPAIGN',$permission))
                                        <h2 class=" pull-right">                                        <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/add')}}"
                                                                                       class=" btn btn-primary">
                                                ADD Campaign
                                            </a>
                                        </h2>
                                    @endif
                                </header>
                                <div id="campaign_grid"></div>
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- WIDGET END -->

                    </div>

                    <div class="row" id="segment_list" style="display: none">
                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Segment</strong></h2>
                                </header>
                                <div id="segment_grid"></div>
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- WIDGET END -->

                    </div>

                    <div class="row" id="creative_list" style="display: none">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Creative</strong></h2>

                                    @if(in_array('ADD_EDIT_CREATIVE',$permission))
                                        <h2 class="pull-right">
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/creative/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add Creative
                                            </a>

                                        </h2>
                                        <h2 class="pull-right">
                                            <button type="reset" class="btn btn-primary " data-toggle="modal"
                                                    data-target="#myModal_creative">
                                                Upload Creatives
                                            </button>

                                        </h2>
                                        <h2 class="pull-right">
                                            <a href="{{cdn('/excel_template/creative.xls')}}" type="reset" class="btn btn-primary " >
                                                Download Creative Excel Template
                                            </a>

                                        </h2>

                                    @endif

                                </header>
                                <div id="creative_grid"></div>
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- WIDGET END -->
                    </div>

                    <div class="row" id="model_list" style="display: none">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Models</strong></h2>
                                    @if(in_array('ADD_EDIT_MODEL',$permission))
                                        <h2 class="pull-right">
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/model/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add Model
                                            </a>

                                        </h2>
                                    @endif

                                </header>
                                <div id="model_grid"></div>
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- WIDGET END -->
                    </div>

                    <div class="row" id="bwlist_list" style="display: none">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Black White List </strong></h2>
                                    @if(in_array('ADD_EDIT_BWLIST',$permission))
                                        <h2 class="pull-right">
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bwlist/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add B/W List
                                            </a>
                                        </h2>
                                        <h2 class="pull-right">
                                            <button type="reset" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal">
                                                Upload BW list
                                            </button>

                                        </h2>
                                        <h2 class="pull-right">
                                            <a href="{{cdn('/excel_template/bwlist.xls')}}" type="reset" class="btn btn-primary " >
                                                Download BW List Excel Template
                                            </a>

                                        </h2>

                                    @endif

                                </header>
                                <div id="bwlist_grid"></div>
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- WIDGET END -->

                    </div>

                    <div class="row" id="geosegment_list" style="display: none">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Geo Segment List </strong></h2>
                                    @if(in_array('ADD_EDIT_GEOSEGMENTLIST',$permission))
                                        <h2 class="pull-right">
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/geosegment/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add Geo Segment List
                                            </a>
                                        </h2>
                                        <h2 class="pull-right">
                                            <button type="reset" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal_geo">
                                                Upload Geo list
                                            </button>
                                        </h2>
                                        <h2 class="pull-right">
                                            <a href="{{cdn('/excel_template/geosegment.xls')}}" type="reset" class="btn btn-primary " >
                                                Download Geo Segment Excel Template
                                            </a>

                                        </h2>

                                    @endif

                                </header>
                                <div id="geosegment_grid"></div>
                            </div>
                            <!-- end widget -->
                        </article>
                        <!-- WIDGET END -->
                    </div>

                    <div class="row" id="bid_profile_list" style="display: none">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <header>
                                    <h2 class="font-md pull-left"><strong>List Of Bid Profile </strong></h2>
                                    @if(in_array('ADD_EDIT_BIDPROFILE',$permission))
                                        <h2 class="pull-right">
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bid-profile/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add Bid Profile
                                            </a>
                                        </h2>
                                        <h2 class="pull-right">
                                            <button type="reset" class="btn btn-primary btn-lg" data-toggle="modal"
                                                    data-target="#myModal_bid_profile">
                                                Upload Bid Profile
                                            </button>
                                        </h2>
                                        <h2 class="pull-right">
                                            <a href="{{cdn('/excel_template/bid_profile.xls')}}" type="reset" class="btn btn-primary " >
                                                Download Bid Profile Excel Template
                                            </a>

                                        </h2>

                                    @endif

                                </header>
                                <div id="bid_profile_grid"></div>
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




    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Black/White List Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('bwlist_upload')}}" method="post" novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="myModal_creative" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Creative Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('creative_upload')}}" method="post" novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="myModal_campaign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Campaign Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('campaign_upload')}}" method="post" novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="myModal_geo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Geo Segment List Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('geosegment_upload')}}" method="post" novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="name" placeholder="Name">
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload_geo"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="myModal_bid_profile" tabindex="-6" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Bid Profile Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('bid_profile_upload')}}" method="post" novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="name" placeholder="Name">
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload_bid_profile"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@endsection
@section('FooterScripts')

    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script>
        $('#show_campaign').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('campaign_list');
            $('#'+active_Show).hide();
            $('#campaign_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );

        });
        $('#show_segment').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('segment_list');
            $('#'+active_Show).hide();
            $('#segment_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );

        });
        $('#show_creative').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('creative_list');
            $('#'+active_Show).hide();
            $('#creative_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_model').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('model_list');
            $('#'+active_Show).hide();
            $('#model_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_bwlist').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('bwlist_list');
            $('#'+active_Show).hide();
            $('#bwlist_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_geosegment').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('geosegment_list');
            $('#'+active_Show).hide();
            $('#geosegment_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_bid_profile').click(function () {
            var active_Show= $('#active_show').val();
            $('#active_show').val('bid_profile_list');
            $('#'+active_Show).hide();
            $('#bid_profile_list').fadeIn("slow");
            $('html, body').animate({
                        scrollTop: $(document).height()-$(window).height()},
                    1400,
                    "easeOutQuint"
            );
        });
    </script>
    <script>
        $(document).ready(function () {
            pageSetUp();


            $.ajax({
                url: "{{url('ajax/getAudit/advertiser/'.$adver_obj->id)}}"
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
                        url: "{{url('ajax/getAudit/advertiser/'.$adver_obj->id)}}"
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

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    },
                    domain_name: {
                        required: true,
                        domain: true
                    },
                    client_id : {
                        required : true
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
                    client_id : {
                        required : 'Please select Client Name'
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


            $('#assign_model').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
                }
            });


            $(function() {

                var db = {

                    loadData: function(filter) {
                        return $.grep(this.clients, function(client) {
                            return (!filter.Name || client.Name.indexOf(filter.Name) > -1);
                        });
                    },

                    insertItem: function(insertingClient) {
                        insertingClient['oper']='add';
                        console.log(insertingClient);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/client')}}",
                            data: insertingClient,
                            dataType: "json"
                        }).done();

                    },

                    updateItem: function(updatingClient) {
                        updatingClient['oper']='edit';
                        console.log(updatingClient) ;
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/client')}}",
                            data: updatingClient,
                            dataType: "json"
                        });
                    },

                    deleteItem: function(deletingClient) {
                        var clientIndex = $.inArray(deletingClient, this.clients);
                        this.clients.splice(clientIndex, 1);
                    }

                };

                window.db = db;

                db.clients = [

                @foreach($adver_obj->Campaign as $index)
                    {
                        "id" : '<a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/cmp'.$index->id.'/edit')}}">cmp{{$index->id}}</a>',
                        "name" : '{{$index->name}}',
                        "start_date": '{{$index->start_date}}',
                        "end_date": '{{$index->end_date}}',
                        "date_modify" : '{{$index->updated_at}}',
                        "action": '<a class="btn " href={{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/cmp'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>'

                    },
                    @endforeach
                ];

                $("#campaign_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        { name: "id",title: "ID", width: 40,align :"center" },
                        { name: "name",title: "Name", type: "text", width: 70 },
                        { name: "start_date", title:"Start Date", type: "text",  width: 100,align :"center" },
                        { name: "end_date", title:"End Date", type: "text",  width: 100,align :"center" },
                        { name: "date_modify" ,title:"Date of Modify",align :"center"},
                        { name: "action", title: "Full Action", sorting: false,width: 50,align :"center" },
                        { type: "control" }
                    ]

                });

            });

            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.segment, function (segment) {
                            return (!filter.name || segment.name.indexOf(filter.name) > -1)
                                    && (!filter.daily_max_imp || segment.daily_max_imp.indexOf(filter.daily_max_imp) > -1)
                                    && (!filter.cpm || segment.cpm.indexOf(filter.cpm) > -1)
                                    && (!filter.id || segment.id.indexOf(filter.id) > -1)
                                    && (!filter.daily_max_budget || segment.daily_max_budget.indexOf(filter.daily_max_budget) > -1);
                        });
                    },

                    updateItem: function (updatingSegment) {
                        updatingSegment['oper'] = 'edit';
                        console.log(updatingSegment);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/segment')}}",
                            data: updatingSegment,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if(response.success==true){
                                var title= "Success";
                                var color="#739E73";
                                var icon="fa fa-check";
                            }else if(response.success==false) {
                                var title= "Warning";
                                var color="#C46A69";
                                var icon="fa fa-bell";
                            };

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.segment = [
                    @foreach($adver_obj->Segment as $index)
                    {
                        "id": 'sgt{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser": '{{$index->getAdvertiser->name}}',
                        "model": '{{$index->getModel->name}}',
                        "date_modify": '{{$index->updated_at}}'
                    },
                    @endforeach
                ];

                $("#segment_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: false,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center"},
                        {name: "model", title: "Model", type: "text", width: 60, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
                    ]

                });

            });
            @endif

            //Creative //
            $(function () {//LIST OF CREATIVE

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.creative, function (creative) {
                            return (!filter.name || creative.name.indexOf(filter.name) > -1)
                                    && (!filter.size || creative.size.indexOf(filter.size) > -1)
                                    && (!filter.advertiser || creative.advertiser.indexOf(filter.advertiser) > -1)
                                    && (!filter.id || creative.id.indexOf(filter.id) > -1);
                        });
                    },

                    updateItem: function (updatingCreative) {
                        updatingCreative['oper'] = 'edit';
                        console.log(updatingCreative);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/creative')}}",
                            data: updatingCreative,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if(response.success==true){
                                var title= "Success";
                                var color="#739E73";
                                var icon="fa fa-check";
                            }else if(response.success==false) {
                                var title= "Warning";
                                var color="#C46A69";
                                var icon="fa fa-bell";
                            };

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.creative = [
                    @foreach($adver_obj->Creative as $index)
                    {
                        "id": 'crt{{$index->id}}',
                        "name": '{{$index->name}}',
                        "size":'{{$index->size}}',
                        "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_CREATIVE',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

            },
                    @endforeach
                ];

                $("#creative_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", width: 40, type: "text", align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "size", title: "Size", type: "text", width: 50, align: "center",editing:false},
                        {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit | +Creative", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });
            //End Creative //

            //BWLIST //
            $(function () { //BW LIST

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.bwlist, function (bwlist) {
                            return (!filter.name || bwlist.name.indexOf(filter.name) > -1)
                                    && (!filter.advertiser_name || bwlist.advertiser_name.indexOf(filter.advertiser_name) > -1)
                                    && (!filter.id || bwlist.id.indexOf(filter.id) > -1)
                                    && (!filter.website || bwlist.website.indexOf(filter.website) > -1);
                        });
                    },

                    updateItem: function (updatingBWlist) {
                        updatingBWlist['oper'] = 'edit';
                        console.log(updatingBWlist);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/bwlist')}}",
                            data: updatingBWlist,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if(response.success==true){
                                var title= "Success";
                                var color="#739E73";
                                var icon="fa fa-check";
                            }else if(response.success==false) {
                                var title= "Warning";
                                var color="#C46A69";
                                var icon="fa fa-bell";
                            };

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.bwlist = [

                    @foreach($adver_obj->BWList as $index)
                    {
                        "id": 'bwl{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name" : '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getEntries)>0)
                        "website": '{{$index->getEntries[0]->bwlist_count}}',
                        @else
                        "website" : '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<a id="bwlist{{$index->id}}" href="javascript: ChangeStatus(`bwlist`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="bwlist{{$index->id}}" href="javascript: ChangeStatus(`bwlist`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/bwl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#bwlist_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 10,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "advertiser_name", title: "Advertiser", type: "text", width: 60, align: "center",editing:false},
                        {name: "website", title: "#Entery", type: "text", width: 40, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | + B/W", sorting: false, width: 60, align: "center"},
                        {type: "control"}
                    ]

                });

            });
            //END BWLIST //

            //Geo Segment //
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.geosegment, function (geosegment) {
                            return (!filter.name || geosegment.name.indexOf(filter.name) > -1)
                                    && (!filter.id || geosegment.id.indexOf(filter.id) > -1)
                                    && (!filter.advertiser_name || geosegment.advertiser_name.indexOf(filter.advertiser_name) > -1)
                                    && (!filter.entreies || geosegment.entreies.indexOf(filter.entreies) > -1)
                                    ;
                        });
                    },

                    updateItem: function (updatingGeo) {
                        updatingGeo['oper'] = 'edit';
                        console.log(updatingGeo);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/geolist')}}",
                            data: updatingGeo,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if(response.success==true){
                                var title= "Success";
                                var color="#739E73";
                                var icon="fa fa-check";
                            }else if(response.success==false) {
                                var title= "Warning";
                                var color="#C46A69";
                                var icon="fa fa-bell";
                            };

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.geosegment = [

                    @foreach($adver_obj->GeoSegment as $index)
                    {
                        "id": 'gsm{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name" : '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getGeoEntries)>0)
                        "entreies": '{{$index->getGeoEntries[0]->geosegment_count}} ',
                        @else
                        "entreies" : '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<a id="geosegment{{$index->id}}" href="javascript: ChangeStatus(`geosegment`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="geosegment{{$index->id}}" href="javascript: ChangeStatus(`geosegment`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/geosegment/gsm'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/geosegment/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#geosegment_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 10,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "advertiser_name", title: "Advertiser", type: "text", width: 60, align: "center",editing:false},
                        {name: "entreies", title: "#Entery", type: "text", width: 40, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +Geo", sorting: false, width: 60, align: "center"},
                        {type: "control"}
                    ]

                });

            });
            //END Geo Segment //

            //Model//
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.model, function (model) {
                            return (!filter.name || model.name.indexOf(filter.name) > -1)
                                    && (!filter.id || model.id.indexOf(filter.id) > -1)
                                    && (!filter.algo || model.algo.indexOf(filter.algo) > -1)
                                    && (!filter.advertiser || model.advertiser.indexOf(filter.advertiser) > -1);
                        });
                    },

                    updateItem: function (updatingModel) {
                        updatingModel['oper'] = 'edit';
                        console.log(updatingModel);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/model')}}",
                            data: updatingModel,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if(response.success==true){
                                var title= "Success";
                                var color="#739E73";
                                var icon="fa fa-check";
                            }else if(response.success==false) {
                                var title= "Warning";
                                var color="#C46A69";
                                var icon="fa fa-bell";
                            };

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.model = [


                    @foreach($adver_obj->Model as $index)
                    {
                        "id": 'mdl{{$index->id}}',
                        "name": '{{$index->name}}',
                        "algo":'{{$index->algo}}',
                        "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        "date_modify":'{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/model/mdl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_MODEL',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/model/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#model_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 10,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", width: 40,editing:false,type: "text", align: "center"},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "algo", title: "Algoritm",editing:false,type: "text", width: 50, align: "center"},
                        {name: "advertiser", title: "Advertiser",editing:false,type: "text", width: 70, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit | +Model", sorting: false, width: 80, align: "center"},
                        {type: "control"}
                    ]

                });

            });

            //END Model //

            // Bid Profile//
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.bid_profile, function (bid_profile) {
                            return (!filter.name || bid_profile.name.indexOf(filter.name) > -1)
                                    && (!filter.id || bid_profile.id.indexOf(filter.id) > -1);
                        });
                    },

                    updateItem: function (updatingBidProfile) {
                        updatingBidProfile['oper'] = 'edit';
                        console.log(updatingBidProfile);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/bid_profile')}}",
                            data: updatingBidProfile,
                            dataType: "json"
                        }).done(function (response) {
                            if(response.success==true){
                                var title= "Success";
                                var color="#739E73";
                                var icon="fa fa-check";
                            }else if(response.success==false) {
                                var title= "Warning";
                                var color="#C46A69";
                                var icon="fa fa-bell";
                            };

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.bid_profile = [

                    @foreach($adver_obj->BidProfile as $index)
                    {
                        "id": 'bpf{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name" : '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getEntries)>0)
                        "entry": '{{$index->getEntries[0]->bid_profile_count}}',
                        @else
                        "entry" : '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<a id="bid_profile{{$index->id}}" href="javascript: ChangeStatus(`bid_profile`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="bid_profile{{$index->id}}" href="javascript: ChangeStatus(`bid_profile`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bid-profile/bpf'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bid-profile/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#bid_profile_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 10,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "advertiser_name", title: "Advertiser", type: "text", width: 60, align: "center",editing:false},
                        {name: "entry", title: "#Entery", type: "text", width: 40, align: "center",editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | + B/W", sorting: false, width: 60, align: "center"},
                        {type: "control"}
                    ]

                });

            });

            //End Bid Profile//
        });
        /* END BASIC */


    </script>
@endsection