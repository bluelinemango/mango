@extends('Layout1')
@section('siteTitle')Edit Advertiser: {{$adver_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/edit')}}">client:
                cl{{$adver_obj->GetClientID->id}}</a>
        </li>
        <li><a href="#" class="active">Advertiser: adv{{$adver_obj->id}} </a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Edit Advertiser: {{$adver_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('advertiser_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token"
                           value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$adver_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$adver_obj->GetClientID->name}}</h5>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Domain Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="domain_name"
                                                   class="form-control" placeholder="Domain Name"
                                                   id="domain_name"
                                                   value="{{$adver_obj->domain_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="switcher">
                                        <input type="checkbox" name="active"
                                        @if($adver_obj->status=='Active')
                                               checked @endif hidden id="active">
                                        <label for="active"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="">Last Modified</label>
                                <h5>{{$adver_obj->updated_at}}</h5>

                            </div>

                            <div class="clearfix"></div>
                            <!--.form-group-->
                        </div>
                        <hr/>
                        <div class="note note-info note-bottom-striped">
                            <h4>Assign Models</h4>

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
                        <hr/>

                        <div style="padding: 15px">

                            <div class="form-group">
                                <label class="control-label">Description</label>

                                <div class="inputer">
                                    <div class="input-wrapper">
                                                    <textarea name="description" class="form-control" rows="3"
                                                              placeholder="type minimum 5 characters"
                                                              required>{{$adver_obj->description}}</textarea>
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
        <div class="">
            <div class="panel gray" id="campaign_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class=" pull-left">List Of Campaign</h4>
                        @if(in_array('ADD_EDIT_CAMPAIGN',$permission))
                            <h4 class=" pull-right"><a
                                        href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/add')}}"
                                        class=" btn btn-primary">
                                    ADD Campaign
                                </a>
                            </h4>
                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="campaign_grid"></div>

                </div>
            </div>

            <div class="panel gray" id="segment_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List Of Segment</h4>
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="segment_grid"></div>
                </div>
            </div>

            <div class="panel gray" id="creative_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class=" pull-left">List Of Creative</h4>
                        @if(in_array('ADD_EDIT_CREATIVE',$permission))
                            <h4 class="pull-right">
                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/creative/add')}}"
                                   class=" btn btn-primary pull-left">
                                    Add Creative
                                </a>

                            </h4>
                            <h4 class="pull-right">
                                <button type="reset" class="btn btn-primary " data-toggle="modal"
                                        data-target="#myModal_creative">
                                    Upload Creatives
                                </button>

                            </h4>
                            <h4 class="pull-right">
                                <a href="{{cdn('/excel_template/creative.xls')}}" type="reset" class="btn btn-primary ">
                                    Download Creative Excel Template
                                </a>

                            </h4>

                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="creative_grid"></div>
                </div>
            </div>

            <div class="panel gray" id="model_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class=" pull-left">List Of Models</h4>
                        @if(in_array('ADD_EDIT_MODEL',$permission))
                            <h4 class="pull-right">
                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/model/add')}}"
                                   class=" btn btn-primary pull-left">
                                    Add Model
                                </a>

                            </h4>
                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="model_grid"></div>
                </div>
            </div>

            <div class="panel gray" id="bwlist_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class=" pull-left">List Of Black White List </h4>
                        @if(in_array('ADD_EDIT_BWLIST',$permission))
                            <h4 class="pull-right">
                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bwlist/add')}}"
                                   class=" btn btn-primary pull-left">
                                    Add B/W List
                                </a>
                            </h4>
                            <h4 class="pull-right">
                                <button type="reset" class="btn btn-primary" data-toggle="modal"
                                        data-target="#myModal">
                                    Upload BW list
                                </button>

                            </h4>
                            <h4 class="pull-right">
                                <a href="{{cdn('/excel_template/bwlist.xls')}}" type="reset" class="btn btn-primary ">
                                    Download BW List Excel Template
                                </a>

                            </h4>
                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="bwlist_grid"></div>
                </div>
            </div>

            <div class="panel gray" id="geosegment_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class=" pull-left">List Of Geo Segment List </h4>
                        @if(in_array('ADD_EDIT_GEOSEGMENTLIST',$permission))
                            <h4 class="pull-right">
                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/geosegment/add')}}"
                                   class=" btn btn-primary pull-left">
                                    Add Geo Segment List
                                </a>
                            </h4>
                            <h4 class="pull-right">
                                <button type="reset" class="btn btn-primary" data-toggle="modal"
                                        data-target="#myModal_geo">
                                    Upload Geo list
                                </button>
                            </h4>
                            <h4 class="pull-right">
                                <a href="{{cdn('/excel_template/geosegment.xls')}}" type="reset" class="btn btn-primary ">
                                    Download Geo Segment Excel Template
                                </a>

                            </h4>

                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="geosegment_grid"></div>
                </div>
            </div>

            <div class="panel gray" id="bid_profile_list" style="display: none">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class=" pull-left">List Of Bid Profile </h4>
                        @if(in_array('ADD_EDIT_BIDPROFILE',$permission))
                            <h4 class="pull-right">
                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bid-profile/add')}}"
                                   class=" btn btn-primary pull-left">
                                    Add Bid Profile
                                </a>
                            </h4>
                            <h4 class="pull-right">
                                <button type="reset" class="btn btn-primary " data-toggle="modal"
                                        data-target="#myModal_bid_profile">
                                    Upload Bid Profile
                                </button>
                            </h4>
                            <h4 class="pull-right">
                                <a href="{{cdn('/excel_template/bid_profile.xls')}}" type="reset" class="btn btn-primary ">
                                    Download Bid Profile Excel Template
                                </a>

                            </h4>

                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">
                    <div id="bid_profile_grid"></div>
                </div>
            </div>

        </div>

    </div>
    <!--.col-->

    <div class="col-md-3">
        <div class="panel">
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
        <div class="well">
            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="">
                    <button id="show_creative" class="btn btn-primary btn-block">Crearive</button>
                    <button id="show_campaign" class="btn btn-primary btn-block">Campaign</button>
                    <button id="show_bwlist" class="btn btn-primary btn-block">B W List</button>
                    <button id="show_geosegment" class="btn btn-primary btn-block">Geo Segment</button>
                    <button id="show_model" class="btn btn-primary btn-block">Model</button>
                    <button id="show_bid_profile" class="btn btn-primary btn-block">Bid Profile</button>
                    @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                        <button id="show_segment" class="btn btn-primary btn-block">Segment</button>
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

    </div>
    <!--.col-->
    <input type="text" id="active_show" hidden/>

    <div class="clearfix"></div>


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
    <div class="modal fade" id="myModal_creative" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
    <div class="modal fade" id="myModal_campaign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
                                      action="{{URL::route('bid_profile_upload')}}" method="post"
                                      novalidate="novalidate"
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#show_creative').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('creative_list');
            $('#' + active_Show).hide();
            $('#creative_list').fadeIn("slow");
            $("#creative_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );

        });
        $('#show_campaign').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('campaign_list');
            $('#' + active_Show).hide();
            $('#campaign_list').fadeIn("slow");
            $("#campaign_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );

        });
        $('#show_segment').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('segment_list');
            $('#' + active_Show).hide();
            $('#segment_list').fadeIn("slow");
            $("#segment_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );

        });
        $('#show_model').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('model_list');
            $('#' + active_Show).hide();
            $('#model_list').fadeIn("slow");
            $("#model_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_bwlist').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('bwlist_list');
            $('#' + active_Show).hide();
            $('#bwlist_list').fadeIn("slow");
            $("#bwlist_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_geosegment').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('geosegment_list');
            $('#' + active_Show).hide();
            $('#geosegment_list').fadeIn("slow");
            $("#geosegment_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );
        });
        $('#show_bid_profile').click(function () {
            var active_Show = $('#active_show').val();
            $('#active_show').val('bid_profile_list');
            $('#' + active_Show).hide();
            $('#bid_profile_list').fadeIn("slow");
            $("#bid_profile_grid").jsGrid("refresh");
            $('html, body').animate({
                        scrollTop: $(document).height() - $(window).height()
                    },
                    1400,
                    "easeOutQuint"
            );
        });
    </script>
    <script>
        $('#audit_status').change(function () {
            if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/advertiser/'.$adver_obj->id)}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }
        });

        $(document).ready(function () {


            $.ajax({
                url: "{{url('ajax/getAudit/advertiser/'.$adver_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });


            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    domain_name: {
                        required: true,
                        domain: true
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
                    client_id: {
                        required: 'Please select Client Name'
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


            $('#assign_model').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
                }
            });


            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.campaign, function (campaign) {
                            return (!filter.name || campaign.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.daily_max_imp || campaign.daily_max_imp.indexOf(filter.daily_max_imp) > -1)
                                    && (!filter.cpm || campaign.cpm.indexOf(filter.cpm) > -1)
                                    && (!filter.id || campaign.id.indexOf(filter.id) > -1)
                                    && (!filter.daily_max_budget || campaign.daily_max_budget.indexOf(filter.daily_max_budget) > -1);
                        });
                    },

                    updateItem: function (updatingCampaign) {
                        updatingCampaign['oper'] = 'edit';
                        console.log(updatingCampaign);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/campaign')}}",
                            data: updatingCampaign,
                            dataType: "json"
                        }).done(function (response) {
                            $("#campaign_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
                        });
                    }

                };

                window.db = db;

                db.campaign = [
                    @foreach($adver_obj->Campaign as $index)
                    {
                        "id": 'cmp{{$index->id}}',
                        "name": '{{$index->name}}',
                        "daily_max_imp":'{{$index->daily_max_impression}}',
                        "cpm":'{{$index->cpm}}',
                        "daily_max_budget":'{{$index->daily_max_budget}}',
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="campaign{{$index->id}}" onchange="ChangeStatus(`campaign`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="campaign{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="campaign{{$index->id}}" onchange="ChangeStatus(`campaign`,`{{$index->id}}`)" type="checkbox" hidden><label for="campaign{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/cmp'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /> </a>' @if(in_array('ADD_EDIT_TARGETGROUP',$permission)) +' | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/cmp'.$index->id.'/targetgroup/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif @if(in_array('ADD_EDIT_CAMPAIGN',$permission)) +' | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a> | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/campaign/cmp'.$index->id.'/clone/1')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

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
                    pageSize: 10,
                    pageButtonCount: 5,
                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "daily_max_imp", title: "Daily Imps", type: "text", width: 70, align: "center"},
                        {name: "cpm", title: "CPM", type: "text", width: 60, align: "center"},
                        {name: "daily_max_budget", title: "Daily Budget", type: "text", width: 80, align: "center"},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +TG | +Camp | Clone", sorting: false, width: 160, align: "center"},
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
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

                    pageSize: 10,
                    pageButtonCount: 5,

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center"},
                        {name: "model", title: "Model", type: "text", width: 60, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
                    ]

                });

            });
            @endif

            //Creative //
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.creative, function (creative) {
                            return (!filter.name || creative.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.size || creative.size.indexOf(filter.size) > -1)
                                    && (!filter.advertiser || creative.advertiser.toLowerCase().indexOf(filter.advertiser.toLowerCase()) > -1)
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
                            $("#creative_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
                        });
                    }

                };

                window.db = db;

                db.creative = [
                    @foreach($adver_obj->Creative as $index)
                    {
                        "id": 'crt{{$index->id}}',
                        "name": '{{$index->name}}',
                        "size": '{{$index->size}}',
                        "advertiser": '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="creative{{$index->id}}" onchange="ChangeStatus(`creative`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="creative{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="creative{{$index->id}}" onchange="ChangeStatus(`creative`,`{{$index->id}}`)" type="checkbox" hidden><label for="creative{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_CREATIVE',$permission)) + '| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a> | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/clone/1')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif



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
                    pageSize: 10,
                    pageButtonCount: 5,
                    controller: db,
                    fields: [
                        {name: "id", title: "ID", width: 40, type: "text", align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "size", title: "Size", type: "text", width: 50, align: "center", editing: false},
                        {
                            name: "advertiser",
                            title: "Advertiser",
                            type: "text",
                            width: 70,
                            align: "center",
                            editing: false
                        },
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {
                            name: "action",
                            title: "Edit | +Creative | Clone",
                            sorting: false,
                            width: 100,
                            align: "center"
                        },
                        {
                            type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]

                });

            });
            //End Creative //

            //BWLIST //
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.bwlist, function (bwlist) {
                            return (!filter.name || bwlist.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
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
                            $("#bwlist_grid").jsGrid("refresh");
                            console.log(response);
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            };
                        });
                    }

                };

                window.db = db;

                db.bwlist = [

                    @foreach($adver_obj->BWList as $index)
                    {
                        "id": 'bwl{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name": '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getEntries)>0)
                        "website": '{{$index->getEntries[0]->bwlist_count}}',
                        @else
                        "website": '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="bwlist{{$index->id}}" onchange="ChangeStatus(`bwlist`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="bwlist{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="bwlist{{$index->id}}" onchange="ChangeStatus(`bwlist`,`{{$index->id}}`)" type="checkbox" hidden><label for="bwlist{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/bwl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) + '| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bwlist/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif
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

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {
                            name: "advertiser_name",
                            title: "Advertiser",
                            type: "text",
                            width: 60,
                            align: "center",
                            editing: false
                        },
                        {name: "website", title: "#Entery", type: "text", width: 40, align: "center", editing: false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | + B/W", sorting: false, width: 60, align: "center"},
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]
                });
            });
            //END BWLIST //

            //Geo Segment //
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.geosegment, function (geosegment) {
                            return (!filter.name || geosegment.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.id || geosegment.id.indexOf(filter.id) > -1)
                                    && (!filter.advertiser_name || geosegment.advertiser_name.toLowerCase().indexOf(filter.advertiser_name.toLowerCase()) > -1)
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
                            $("#geosegment_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
                        });
                    }

                };

                window.db = db;

                db.geosegment = [

                    @foreach($adver_obj->GeoSegment as $index)
                    {
                        "id": 'gsm{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name": '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getGeoEntries)>0)
                        "entreies": '{{$index->getGeoEntries[0]->geosegment_count}} ',
                        @else
                        "entreies": '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="geosegment{{$index->id}}" onchange="ChangeStatus(`geosegment`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="geosegment{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="geosegment{{$index->id}}" onchange="ChangeStatus(`geosegment`,`{{$index->id}}`)" type="checkbox" hidden><label for="geosegment{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/geosegment/gsm'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) + '| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/geosegment/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif


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

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {
                            name: "advertiser_name",
                            title: "Advertiser",
                            type: "text",
                            width: 60,
                            align: "center",
                            editing: false
                        },
                        {name: "entreies", title: "#Entery", type: "text", width: 40, align: "center", editing: false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +Geo", sorting: false, width: 60, align: "center"},
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]

                });

            });
            //END Geo Segment //

            //Model//
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.model, function (model) {
                            return (!filter.name || model.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.id || model.id.indexOf(filter.id) > -1)
                                    && (!filter.algo || model.algo.toLowerCase().indexOf(filter.algo.toLowerCase()) > -1)
                                    && (!filter.advertiser || model.advertiser.toLowerCase().indexOf(filter.advertiser.toLowerCase()) > -1);
                        });
                    },

                    updateItem: function (updatingModel) {
                        updatingModel['oper'] = 'edit';
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/model')}}",
                            data: updatingModel,
                            dataType: "json"
                        }).done(function (response) {
                            $("#model_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
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

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", width: 40,editing:false,type: "text", align: "center"},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "algo", title: "Algoritm",editing:false,type: "text", width: 50, align: "center"},
                        {name: "advertiser", title: "Advertiser",editing:false,type: "text", width: 70, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit | +Model", sorting: false, width: 80, align: "center"},
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]

                });

            });

            //END Model //

            // Bid Profile//
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.bid_profile, function (bid_profile) {
                            return (!filter.name || bid_profile.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    &&(!filter.advertiser_name || bid_profile.advertiser_name.toLowerCase().indexOf(filter.advertiser_name.toLowerCase()) > -1)
                                    && (!filter.entry || bid_profile.entry.indexOf(filter.entry) > -1)
                                    && (!filter.id || bid_profile.id.toLowerCase().indexOf(filter.id.toLowerCase()) > -1);
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
                            $("#bid_profile_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
                        });
                    }

                };

                window.db = db;

                db.bid_profile = [

                    @foreach($adver_obj->BidProfile as $index)
                    {
                        "id": 'bpf{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name": '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getEntries)>0)
                        "entry": '{{$index->getEntries[0]->bid_profile_count}}',
                        @else
                        "entry": '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="bid_profile{{$index->id}}" onchange="ChangeStatus(`bid_profile`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="bid_profile{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="bid_profile{{$index->id}}" onchange="ChangeStatus(`bid_profile`,`{{$index->id}}`)" type="checkbox" hidden><label for="bid_profile{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bid-profile/bpf'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) + '| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bid-profile/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif


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
                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {
                            name: "advertiser_name",
                            title: "Advertiser",
                            type: "text",
                            width: 60,
                            align: "center",
                            editing: false
                        },
                        {name: "entry", title: "#Entery", type: "text", width: 40, align: "center", editing: false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +BidProfile", sorting: false, width: 60, align: "center"},
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]

                });

            });

            //End Bid Profile//

        });
        /* END BASIC */
    </script>
@endsection