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
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form"
                                              action="{{URL::route('advertiser_update')}}" method="post"
                                              novalidate="novalidate">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="adver_id" value="{{$adver_obj->id}}"/>
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
                                                            <label for="" class="label">status</label>
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="active" @if($adver_obj->status=='Active') checked @endif>
                                                                <i></i>Active Status
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

                                            </div>
                                            <div class="well col-md-12">
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

                                            </div>

                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <div style="margin: 20px 0;">
                                                        <h5>Assign Models</h5>

                                                        <div class="col-xs-5">
                                                            <select name="from_model[]" id="assign_model"
                                                                    class="form-control" size="8" multiple="multiple">
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
                                                                    class="form-control" size="8" multiple="multiple">
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
                                                                class=" button button--antiman button--round-l button--text-medium">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </form>
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
                            <div class="well">
                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">
                                        @if(in_array('ADD_EDIT_OFFER',$permission))
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/offer/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add Offer
                                            </a>
                                            <div class="clearfix"></div>
                                        @endif
                                        @if(in_array('ADD_EDIT_PIXEL',$permission))
                                            <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/pixel/add')}}"
                                               class=" btn btn-primary pull-left">
                                                Add Pixel
                                            </a>
                                            <div class="clearfix"></div>
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
                    <div class="row" id="campaign_list" style="display: block">
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

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <div id="campaign_grid"></div>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

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
                                    @endif

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <table id="dt_basic1" class="table table-striped table-bordered table-hover"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>
                                                    <i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>
                                                    Name
                                                </th>
                                                <th>
                                                    <i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>
                                                    Date Of Modify
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->Creative as $index_crt)
                                                <tr>
                                                    <td>crt{{$index_crt->id}}</td>
                                                    <td>
                                                        <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/creative/crt'.$index_crt->id.'/edit')}}">{{$index_crt->name}}</a>
                                                    </td>
                                                    <td>{{$index_crt->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

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

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <table id="dt_basic2" class="table table-striped table-bordered table-hover"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i
                                                            class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>
                                                    Name
                                                </th>
                                                <th data-hide="phone,tablet"><i
                                                            class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>
                                                    Date Of modifay
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->Model as $index_mdl)
                                                <tr>
                                                    <td>mdl{{$index_mdl->id}}</td>
                                                    <td>
                                                        <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/model/mdl'.$index_mdl->id.'/edit')}}">{{$index_mdl->name}}</a>
                                                    </td>
                                                    <td>{{$index_mdl->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

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
                                            <button type="reset" class="btn btn-primary btn-lg" data-toggle="modal"
                                                    data-target="#myModal">
                                                Upload BW list
                                            </button>

                                        </h2>
                                    @endif

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <table id="dt_basic3" class="table table-striped table-bordered table-hover"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i
                                                            class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>
                                                    Name
                                                </th>
                                                <th data-hide="phone,tablet"><i
                                                            class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>
                                                    Date Of modifay
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->BWList as $index_bwl)
                                                <tr>
                                                    <td>mdl{{$index_bwl->id}}</td>
                                                    <td>
                                                        <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bwlist/bwl'.$index_bwl->id.'/edit')}}">{{$index_bwl->name}}</a>
                                                    </td>
                                                    <td>{{$index_bwl->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->
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
                                            <button type="reset" class="btn btn-primary btn-lg" data-toggle="modal"
                                                    data-target="#myModal_geo">
                                                Upload Geo list
                                            </button>
                                        </h2>
                                    @endif

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <table id="dt_basic4" class="table table-striped table-bordered table-hover"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i
                                                            class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>
                                                    Name
                                                </th>
                                                <th data-hide="phone,tablet"><i
                                                            class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>
                                                    Date Of modifay
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->GeoSegment as $index_gsm)
                                                <tr>
                                                    <td>mdl{{$index_gsm->id}}</td>
                                                    <td><a href="{{url()}}">{{$index_gsm->name}}</a></td>
                                                    <td>{{$index_gsm->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
    </div><!-- /.modal -->

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
    </div><!-- /.modal -->


@endsection
@section('FooterScripts')

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{cdn('js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>
{{--////////////////////////////DONT NEED UP ///////////////////--}}

    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            pageSetUp();

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
                        "action": '<a class="btn btn-info" href={{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/cmp'.$index->id.'/edit')}}"><i class="fa fa-edit "></i></a>'

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















            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_dt_basic1 = undefined;
            var responsiveHelper_dt_basic2 = undefined;
            var responsiveHelper_dt_basic3 = undefined;
            var responsiveHelper_dt_basic4 = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic.respond();
                }
            });
            $('#dt_basic1').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic1) {
                        responsiveHelper_dt_basic1 = new ResponsiveDatatablesHelper($('#dt_basic1'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic1.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic1.respond();
                }
            });
            $('#dt_basic2').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic2) {
                        responsiveHelper_dt_basic2 = new ResponsiveDatatablesHelper($('#dt_basic2'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic2.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic2.respond();
                }
            });
            $('#dt_basic3').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic3) {
                        responsiveHelper_dt_basic3 = new ResponsiveDatatablesHelper($('#dt_basic3'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic3.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic3.respond();
                }
            });
            $('#dt_basic4').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic4) {
                        responsiveHelper_dt_basic4 = new ResponsiveDatatablesHelper($('#dt_basic4'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic4.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic4.respond();
                }
            });
        });
        /* END BASIC */


    </script>
@endsection