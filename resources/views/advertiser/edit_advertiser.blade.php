@extends('Layout')
@section('siteTitle')Edit Advertiser: {{$adver_obj->name}} @endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <span class="ribbon-button-alignment">
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                    <i class="fa fa-refresh"></i>
                </span>
            </span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Home</li>
                <li><a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/edit')}}">client: cl{{$adver_obj->GetClientID->id}}</a></li>
                <li>Advertiser: adv{{$adver_obj->id}} </li>
            </ol>

        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            @if(isset($errors))
                @foreach($errors->get('msg') as $error)
                    <div class="alert alert-block alert-{{($errors->get('success')[0] == true)?'success':'danger'}}">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i>System MSG!</h4>
                        <p>
                            {{$error}}
                        </p>
                    </div>
                @endforeach
            @endif
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

                                        <form id="order-form" class="smart-form" action="{{URL::route('advertiser_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="adver_id" value="{{$adver_obj->id}}"/>
                                            <header>
                                                General Information
                                            </header>
                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for=""> Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$adver_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Domain Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="domain_name" placeholder="Domain Name" value="{{$adver_obj->domain_name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" value="{{$adver_obj->GetClientID->name}}" disabled>
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>

                                            <fieldset>

                                                <section>
                                                    <label class="label" for="">Description</label>
                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                        <textarea rows="5" name="description" placeholder="Tell us about your advertiser">{{$adver_obj->description}}</textarea>
                                                    </label>
                                                </section>
                                            </fieldset>
                                            <fieldset>
                                                <div style="margin: 20px 0;">
                                                    <div class="col-xs-5">
                                                        <select name="from_model[]" id="assign_model" class="form-control" size="8" multiple="multiple">
                                                            @foreach($model_obj as $index)
                                                                <option value="{{$index->id}}">{{$index->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-xs-2">
                                                        <button type="button" id="assign_model_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                                        <button type="button" id="assign_model_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                                        <button type="button" id="assign_model_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                                        <button type="button" id="assign_model_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                                    </div>

                                                    <div class="col-xs-5">
                                                        <select name="to_model[]" id="assign_model_to" class="form-control" size="8" multiple="multiple">
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

                                            <footer>
                                                <button type="submit" class="btn btn-success">
                                                    Submit
                                                </button>
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
                            <div class="well" >
                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">
                                                @if(in_array('ADD_EDIT_CAMPAIGN',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/add')}}" class=" btn btn-primary pull-left">
                                                    ADD Campaign
                                                </a><div class="clearfix"></div>

                                                @endif
                                                @if(in_array('ADD_EDIT_CREATIVE',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/creative/add')}}" class=" btn btn-primary pull-left">
                                                    Add Creative
                                                </a> <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_BWLIST',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bwlist/add')}}" class=" btn btn-primary pull-left">
                                                    Add B/W List
                                                </a>   <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_MODEL',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/model/add')}}" class=" btn btn-primary pull-left">
                                                    Add Model
                                                </a>  <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_OFFER',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/offer/add')}}" class=" btn btn-primary pull-left">
                                                    Add Offer
                                                </a>   <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_PIXEL',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/pixel/add')}}" class=" btn btn-primary pull-left">
                                                    Add Pixel
                                                </a>   <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_GEOSEGMENTLIST',$permission))
                                                <a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/geosegment/add')}}" class=" btn btn-primary pull-left">
                                                    Add Geo Segment List
                                                </a>  <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_BWLIST',$permission))
                                                <button type="reset" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                                    Upload BW list
                                                </button>  <div class="clearfix"></div>
                                                @endif
                                                @if(in_array('ADD_EDIT_GEOSEGMENTLIST',$permission))
                                                <button type="reset" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal_geo">
                                                    Upload Geo list
                                                </button> <div class="clearfix"></div>
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
                    <div class="row">
                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">
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
                                    <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                                    <h2 class="font-md"><strong>List Of Campaign</strong> </h2>

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

                                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Start Date</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> End Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->Campaign as $index_cmp)
                                                <tr>
                                                    <td>cmp{{$index_cmp->id}}</td>
                                                    <td><a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/campaign/cmp'.$index_cmp->id.'/edit')}}">{{$index_cmp->name}}</a></td>
                                                    <td>{{$index_cmp->start_date}}</td>
                                                    <td>{{$index_cmp->end_date}}</td>
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

                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                                    <h2 class="font-md"><strong>List Of Creative</strong> </h2>

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

                                        <table id="dt_basic1" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th >ID</th>
                                                <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Of Modify</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->Creative as $index_crt)
                                                <tr>
                                                    <td>crt{{$index_crt->id}}</td>
                                                    <td><a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/creative/crt'.$index_crt->id.'/edit')}}">{{$index_crt->name}}</a></td>
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
                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                                    <h2 class="font-md"><strong>List Of Models</strong> </h2>

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

                                        <table id="dt_basic2" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Of modifay</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->Model as $index_mdl)
                                                <tr>
                                                    <td>mdl{{$index_mdl->id}}</td>
                                                    <td><a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/model/mdl'.$index_mdl->id.'/edit')}}">{{$index_mdl->name}}</a></td>
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
                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-3" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                                    <h2 class="font-md"><strong>List Of Black White List </strong> </h2>

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

                                        <table id="dt_basic3" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Of modifay</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adver_obj->BWList as $index_bwl)
                                                <tr>
                                                    <td>mdl{{$index_bwl->id}}</td>
                                                    <td><a href="{{url('/client/cl'.$adver_obj->GetClientID->id.'/advertiser/adv'.$adver_obj->id.'/bwlist/bwl'.$index_bwl->id.'/edit')}}">{{$index_bwl->name}}</a></td>
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

                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                                    <h2 class="font-md"><strong>List Of Geo Segment List </strong> </h2>

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

                                        <table id="dt_basic4" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Of modifay</th>
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
                                <form id="order-form" class="smart-form" role="form" action="{{URL::route('bwlist_upload')}}" method="post" novalidate="novalidate" enctype="multipart/form-data" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="advertiser_id" value="{{$adver_obj->id}}"/>
                                {{--<form class="form form-inline " role="form" method="post" action="">--}}
                                    <section>
                                        <label class="label">File input</label>
                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal_geo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <form id="order-form" class="smart-form" role="form" action="{{URL::route('geosegment_upload')}}" method="post" novalidate="novalidate" enctype="multipart/form-data" >
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
                                            <span class="button"><input type="file" id="file" name="upload_geo" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection
@section('FooterScripts')

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{cdn('js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>
    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            pageSetUp();

            $('#assign_model').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
                }
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
                tablet : 1024,
                phone : 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic.respond();
                }
            });
            $('#dt_basic1').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic1) {
                        responsiveHelper_dt_basic1 = new ResponsiveDatatablesHelper($('#dt_basic1'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic1.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic1.respond();
                }
            });
            $('#dt_basic2').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic2) {
                        responsiveHelper_dt_basic2 = new ResponsiveDatatablesHelper($('#dt_basic2'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic2.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic2.respond();
                }
            });
            $('#dt_basic3').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic3) {
                        responsiveHelper_dt_basic3 = new ResponsiveDatatablesHelper($('#dt_basic3'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic3.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic3.respond();
                }
            });
            $('#dt_basic4').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic4) {
                        responsiveHelper_dt_basic4 = new ResponsiveDatatablesHelper($('#dt_basic4'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic4.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic4.respond();
                }
            });
        });
        /* END BASIC */


    </script>
@endsection