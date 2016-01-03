@extends('Layout')
@section('siteTitle')Add Client @endsection
@section('header_extra')
    <style>
        .report-selected{
            font-weight: bolder;
            color: #ff0000 !important;
        }
        .form-control{
            height: 21px !important;
            padding: 0;;
        }
        input{
            width: 90% !important;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
            padding: 3px 10px;
            font-size: 12px;
        }
        tr.header
        {
            cursor:pointer;
        }
        .header .sign:after{
            content:"+";
            display:inline-block;
        }
        .header.expand .sign:after{
            content:"-";
        }
        .no-padding{
            padding: 0 3px !important;
        }
        .jarviswidget{
            margin: 0 0 4px !important;
        }
        .jarviswidget>header{
            height: 21px;
        }
        .jarviswidget>header h2 {
            font-size: 12px !important;
            line-height: 22px !important;
        }
        .jarviswidget-ctrls a, .jarviswidget>header>.widget-icon{
            line-height: 19px !important;
        }
        .jarviswidget-ctrls .button-icon{
            height: 19px !important;
        }
        .jarviswidget>div{
            margin-top: -12px !important;
        }
        .pagination-sm>li>a, .pagination-sm>li>span{
            padding: 3px 6px;
            font-size: 9px;
        }
    </style>
@endsection
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
                <li>system Reporting</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:
                        <span class="ribbon-button-alignment pull-right">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
            </span>

 -->

        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            @if(isset($errors))
                @foreach($errors->get('msg') as $error)
                    <div class="alert alert-block alert-{{($errors->get('success')[0] == true)?'success':'danger'}}">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
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
                        <article class="col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
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
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>System Report </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body" style="min-height: 0 !important;">
                                        <input type="hidden" value="" name="client"/>
                                        <input type="hidden" value="" name="advertiser"/>
                                        <input type="hidden" value="" name="geosegment"/>
                                        <input type="hidden" value="" name="campaign"/>
                                        <input type="hidden" value="" name="targetgroup"/>
                                        <input type="hidden" value="" name="creative"/>
                                        <input type="hidden" value="" name="startdate"/>
                                        <input type="hidden" value="" name="enddate"/>
                                        <input type="hidden" value="today" name="report_type"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <form id="order-form" class="smart-form no-padding" action="{{URL::route('client_create')}}" method="post" novalidate="novalidate" >
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <div class="row">
                                                            <section class="col col-1">
                                                                from
                                                            </section>
                                                            <section class="col col-4">

                                                                <label class="input">
                                                                    <input type="text" name="startdate" id="startdate" placeholder="start date">
                                                                </label>

                                                            </section>
                                                            <section class="col col-1">
                                                                to
                                                            </section>
                                                            <section class="col col-4">
                                                                <label class="input">
                                                                    <input type="text" name="finishdate" id="finishdate" placeholder="finish date">
                                                                </label>
                                                            </section>
                                                            <section class="col col-1">
                                                                <a href="javascript:changeReport('five_mins','report_type');" class="btn bg-color-greenLight txt-color-white"><i class="fa-search"></i></a>
                                                            </section>
                                                        </div>
                                                </form>

                                            </div>
                                            <div class="col-md-5">
                                                <div class="col-md-12">
                                                    <a href="javascript: changeReport('today','report_type');" class="btn bg-color-magenta txt-color-white">10m</a>
                                                    <a href="javascript:changeReport('yesterday','report_type');" class="btn bg-color-red txt-color-white">1h</a>
                                                    <a href="javascript:changeReport('last_hour','report_type');" class="btn bg-color-green txt-color-white">3h</a>
                                                    <a href="javascript:changeReport('five_mins','report_type');" class="btn bg-color-greenLight txt-color-white">6h</a>
                                                    <a href="javascript:changeReport('five_mins','report_type');" class="btn bg-color-greenLight txt-color-white">1D</a>
                                                    <a href="javascript:changeReport('five_mins','report_type');" class="btn bg-color-greenLight txt-color-white">1M</a>
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
                        <article class="col-sm-9 col-md-9 col-lg-9">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-0">
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
                                    <span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
                                    <h2>impression </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->
                                        <input class="form-control" type="text">
                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body">

                                        <!-- this is what the user will see -->
                                        <div id="noroll" style="width:100%; height:300px;"></div>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->


                        </article>
                        <article class="col-sm-3 col-md-3 col-lg-3">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <section id="widget-grid" class="">
                                <!-- widget div-->
                                <div class="row">
                                    <!-- widget content -->
                                    <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable no-padding">
                                        <div class="col-md-12 no-padding">
                                            <!-- Widget ID (each widget will need unique ID)-->
                                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-20" data-widget-editbutton="true" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
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
                                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                    <h2>clients </h2>

                                                </header>

                                                <!-- widget div-->
                                                <div>

                                                    <!-- widget edit box -->
                                                    <div class="jarviswidget-editbox">
                                                        <!-- This area used as dropdown edit box -->

                                                    </div>
                                                    <!-- end widget edit box -->

                                                    <!-- widget content -->
                                                    <div class="widget-body no-padding">

                                                        <table id="client_list" class="table table-striped table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th data-class="expand"> Name</th>
                                                                <th> imps</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($clients as $index_cln)
                                                                <tr>
                                                                    <td>
                                                                        <a id="cln{{$index_cln->id}}" href="javascript: changeReport('{{$index_cln->id}}','client')">{{$index_cln->name}}</a>

                                                                    </td>
                                                                    <td>a</td>
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
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-23" data-widget-editbutton="true" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                                                <header>
                                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                    <h2>Target</h2>

                                                </header>

                                                <!-- widget div-->
                                                <div>

                                                    <!-- widget edit box -->
                                                    <div class="jarviswidget-editbox">
                                                        <!-- This area used as dropdown edit box -->

                                                    </div>
                                                    <!-- end widget edit box -->

                                                    <!-- widget content -->
                                                    <div class="widget-body no-padding">

                                                        <table id="targetgroup_list" class="table table-striped table-bordered table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th data-class="expand"> Name</th>
                                                                <th> imps</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($targetgroup as $index_tgp)
                                                                <tr>
                                                                    <td>
                                                                        <a id="tgp{{$index_tgp->id}}" href="javascript: changeReport('{{$index_tgp->id}}','targetgroup')">{{$index_tgp->name}}</a>
                                                                    </td>
                                                                    <td>s</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <!-- end widget content -->

                                                </div>
                                                <!-- end widget div -->

                                            </div>

                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-25" data-widget-editbutton="true" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                                                <header>
                                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                    <h2>Geo </h2>

                                                </header>

                                                <!-- widget div-->
                                                <div>

                                                    <!-- widget edit box -->
                                                    <div class="jarviswidget-editbox">
                                                        <!-- This area used as dropdown edit box -->

                                                    </div>
                                                    <!-- end widget edit box -->

                                                    <!-- widget content -->
                                                    <div class="widget-body no-padding">

                                                        <table id="geosegment_list" class="table table-striped table-bordered table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th data-class="expand"> Name</th>
                                                                <th> imps</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($geosegment as $index_gsm)
                                                                <tr>
                                                                    <td>
                                                                        <a id="gsm{{$index_gsm->id}}" href="javascript: changeReport('{{$index_gsm->id}}','geosegment')">{{$index_gsm->name}}</a>
                                                                    </td>
                                                                    <td>s</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <!-- end widget content -->

                                                </div>
                                                <!-- end widget div -->

                                            </div>

                                        </div>

                                    </article>
                                    <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable no-padding">
                                        <div class="col-md-12 no-padding">
                                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-21" data-widget-editbutton="true" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                                                <header>
                                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                    <h2>advertiser </h2>

                                                </header>

                                                <!-- widget div-->
                                                <div>

                                                    <!-- widget edit box -->
                                                    <div class="jarviswidget-editbox">
                                                        <!-- This area used as dropdown edit box -->

                                                    </div>
                                                    <!-- end widget edit box -->

                                                    <!-- widget content -->
                                                    <div class="widget-body no-padding">

                                                        <table id="advertiser_list" class="table table-striped table-bordered table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th data-class="expand"> Name</th>
                                                                <th> imps</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($advertiser as $index_adv)
                                                                <tr>
                                                                    <td>
                                                                        <a id="adv{{$index_adv->id}}" href="javascript: changeReport('{{$index_adv->id}}','advertiser')">{{$index_adv->name}}</a>
                                                                    </td>
                                                                    <td>s</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <!-- end widget content -->

                                                </div>
                                                <!-- end widget div -->

                                            </div>

                                        </div>
                                        <div class="col-md-12 no-padding">
                                            <!-- Widget ID (each widget will need unique ID)-->
                                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-22" data-widget-editbutton="true" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                                                <header>
                                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                    <h2>Campaign </h2>

                                                </header>

                                                <!-- widget div-->
                                                <div>

                                                    <!-- widget edit box -->
                                                    <div class="jarviswidget-editbox">
                                                        <!-- This area used as dropdown edit box -->

                                                    </div>
                                                    <!-- end widget edit box -->

                                                    <!-- widget content -->
                                                    <div class="widget-body no-padding">

                                                        <table id="campaign_list" class="table table-striped table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th data-class="expand"> Name</th>
                                                                <th> Imps</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($campaign as $index_cmp)
                                                                <tr>
                                                                    <td>
                                                                        <a id="cmp{{$index_cmp->id}}" href="javascript: changeReport('{{$index_cmp->id}}','campaign')">{{$index_cmp->name}}</a>

                                                                    </td>
                                                                    <td>a</td>
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
                                        </div>
                                        <div class="col-md-12 no-padding">
                                            <!-- Widget ID (each widget will need unique ID)-->
                                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-24" data-widget-editbutton="true" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                                                <header>
                                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                    <h2>Creative </h2>

                                                </header>

                                                <!-- widget div-->
                                                <div>

                                                    <!-- widget edit box -->
                                                    <div class="jarviswidget-editbox">
                                                        <!-- This area used as dropdown edit box -->

                                                    </div>
                                                    <!-- end widget edit box -->

                                                    <!-- widget content -->
                                                    <div class="widget-body no-padding">

                                                        <table id="creative_list" class="table table-striped table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th data-class="expand"> Name</th>
                                                                <th> Imps</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($creative as $index_crt)
                                                                <tr>
                                                                    <td>
                                                                        <a id="crt{{$index_crt->id}}" href="javascript: changeReport('{{$index_crt->id}}','creative')">{{$index_crt->name}}</a>

                                                                    </td>
                                                                    <td>a</td>
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
                                        </div>

                                    </article>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </section>
                            <!-- end widget -->

                        </article>
                        <!-- END COL -->
                    </div>
                    <!-- END ROW -->
                </section>
                <!-- end widget grid -->
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->
@endsection
@section('FooterScripts')
    <script src="{{cdn('js/plugin/jquery-form/jquery-form.min.js')}}"></script>
    <script src="{{cdn('js/plugin/dygraphs/demo-data.min.js')}}"></script>
    <!-- DYGRAPH -->
    <script src="{{cdn('js/plugin/dygraphs/dygraph-combined.min.js')}}"></script>
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{cdn('js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.col1Vis.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.tabl1eTools.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{cdn('js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.header').click(function(){
            $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
        });
        function changeReport(id,type){
            var lntstr=3;
            var client=$('input[name="client"]');
            var advertiser=$('input[name="advertiser"]');
            var campaign=$('input[name="campaign"]');
            var targetgroup=$('input[name="targetgroup"]');
            var geosegment=$('input[name="geosegment"]');
            var creative=$('input[name="creative"]');
            var report_type=$('input[name="report_type"]');
            var start_date=$('input[name="start_date"]');
            var end_date=$('input[name="end_date"]');
            if(type=='client'){
                if(client.val()==id){
                    client.val('');
                    advertiser.val('');
                    campaign.val('');
                    targetgroup.val('');
                    geosegment.val('');
                    creative.val('');
                    $('#client_list').find('a').removeClass();
                    $('#cln'+id).removeClass();
                    type='client_unfilter'
                }else if(client.val()=='' && (advertiser.val()!='' || campaign.val()!='' || targetgroup.val()!='' || geosegment.val()!='' || creative.val()!='')){
                    client.val(id);
                    $('#client_list').find('a').removeClass();
                    $('#cln' + id).addClass('report-selected');
                    type='do_nothing';
                }else{
                    advertiser.val('');
                    campaign.val('');
                    targetgroup.val('');
                    geosegment.val('');
                    creative.val('');
                    client.val(id);
                    $('#client_list').find('a').removeClass();
                    $('#cln' + id).addClass('report-selected');
                }
            }
            if(type=='advertiser'){
                if(advertiser.val()==id && client.val()!=''){
                    advertiser.val('');
                    campaign.val('');
                    targetgroup.val('');
                    geosegment.val('');
                    creative.val('');
                    $('#advertiser_list').find('a').removeClass();
                    $('#adv'+id).removeClass();
                    type='advertiser_unfilter'
                }else if(advertiser.val()==id && client.val()=='') {
                    advertiser.val('');
                    campaign.val('');
                    targetgroup.val('');
                    geosegment.val('');
                    creative.val('');
                    type='client_unfilter';
                }else if(advertiser.val()=='' && (campaign.val()!='' || targetgroup.val()!='' || geosegment.val()!='' || creative.val()!='')){
                    advertiser.val(id);
                    $('#advertiser_list').find('a').removeClass();
                    $('#adv' + id).addClass('report-selected');
                    type='do_nothing';
                }else if(client.val()=='') {
                    advertiser.val(id);
                    campaign.val('');
                    targetgroup.val('');
                    geosegment.val('');
                    creative.val('');
                    $('#advertiser_list').find('a').removeClass();
                    $('#adv' + id).addClass('report-selected');
                }else{
                    advertiser.val(id);
                    $('#advertiser_list').find('a').removeClass();
                    $('#adv' + id).addClass('report-selected');
                }
            }
            if(type=='campaign'){
                if(campaign.val()==id && (advertiser.val()!='' || client.val()!='')){
                    targetgroup.val('');
                    campaign.val('');
                    $('#campaign_list').find('a').removeClass();
                    $('#cmp'+id).removeClass();
                    type='campaign_unfilter'
                }else if(campaign.val()==id && advertiser.val()=='' && client.val()==''){
                    targetgroup.val('');
                    campaign.val('');
                    type='client_unfilter';
                }else if(campaign.val()=='' && (client.val()!='' || advertiser.val()!='')){
                    campaign.val(id);
                    $('#campaign_list').find('a').removeClass();
                    $('#cmp' + id).addClass('report-selected');
                    type='do_nothing';
                }else {
                    targetgroup.val('');
                    campaign.val(id);
                    $('#campaign_list').find('a').removeClass();
                    $('#cmp' + id).addClass('report-selected');
                }
            }
            if(type=='targetgroup'){
                if(targetgroup.val()==id){
                    targetgroup.val('');
                    $('#targetgroup_list').find('a').removeClass();
                    $('#tgp'+id).removeClass();
                    type='targetgroup_unfilter'
                }else {
                    targetgroup.val(id);
                    $('#targetgroup_list').find('a').removeClass();
                    $('#tgp' + id).addClass('report-selected');
                }
            }
            if(type=='creative'){
                if(creative.val()==id && (campaign.val()!='' || targetgroup.val()!='' || geosegment.val()!='' || advertiser.val()!='' || client.val()!='')){
                    creative.val('');
                    $('#creative_list').find('a').removeClass();
                    $('#crt'+id).removeClass();
                    type='creative_unfilter'
                }else if(creative.val()==id && (campaign.val()=='' || targetgroup.val()=='' || geosegment.val()=='' || advertiser.val()=='' || client.val()=='')){
                    creative.val('');
                    $('#creative_list').find('a').removeClass();
                    $('#crt'+id).removeClass();
                    type='client_unfilter'
                }else {
                    creative.val(id);
                    $('#creative_list').find('a').removeClass();
                    $('#crt' + id).addClass('report-selected');
                }
            }
            if(type=='geosegment'){
                if(geosegment.val()==id && (campaign.val()!='' || targetgroup.val()!='' || creative.val()!='' || advertiser.val()!='' || client.val()!='')){
                    geosegment.val('');
                    $('#geosegment_list').find('a').removeClass();
                    $('#gsm'+id).removeClass();
                    type='geosegment_unfilter'
                }else if(geosegment.val()==id && (campaign.val()=='' || targetgroup.val()=='' || creative.val()=='' || advertiser.val()=='' || client.val()=='')){
                    geosegment.val('');
                    $('#geosegment_list').find('a').removeClass();
                    $('#gsm'+id).removeClass();
                    type='client_unfilter'
                }else {
                    geosegment.val(id);
                    $('#geosegment_list').find('a').removeClass();
                    $('#gsm' + id).addClass('report-selected');
                }
            }
            if(type=='report_type'){
                report_type.val(id);
//                $('#advertiser_list').find('a').removeClass();
//                $('#adv'+id).addClass('report-selected');
            }
            if(type!='do_nothing') {
                $.ajax({
                    type: "POST",
                    url: "{{url('/report/changestate')}}",
                    beforeSend: function () {
                    },
                    data: {
                        id: id,
                        client: client.val(),
                        advertiser: advertiser.val(),
                        campaign: campaign.val(),
                        creative: creative.val(),
                        geosegment: geosegment.val(),
                        type: type
                    }
                }).success(function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    if (response[0] == 'client') {
                        $('#client_list').dataTable().fnClearTable();
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a class='report-selected' id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + " <i class='fa fa-check'></i></a>";

                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "adv"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                    }
                    if (response[0] == 'client_unfilter') {
                        $('#client_list').dataTable().fnClearTable();
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }
                        if (response[5].length > 0) {
                            var data = '';
                            $.each(response[5], function () {
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if (response[6].length > 0) {
                            var data = '';
                            $.each(response[6], function () {
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }

                    }
                    if (response[0] == 'advertiser_unfilter') {
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "Internet"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                    }
                    if (response[0] == 'campaign_unfilter') {
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        if(advertiser.val()==''){
                            $('#advertiser_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.get_advertiser!=null){
                                        var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.get_advertiser.id + ",`advertiser`)'>" + this.get_advertiser.name + "</a>";
                                        data += '["' + link1 + '", "advc"],';
                                    }
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#advertiser_list').dataTable().fnAddData(data);
                            }
                        }
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "cmpn"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                if(this.get_campaign.get_advertiser!=null ) {
                                    var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", "tgpn"],';
                                }
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }
                    }

                    if (response[0] == 'creative_unfilter') {
                        $('#creative_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a  id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "crt"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                    }
                    if (response[0] == 'geosegment_unfilter') {
                        $('#geosegment_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a  id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "crt"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                    }

                    if (response[0] == 'campaign') {
                        console.log(response);
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a class='report-selected' id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "<i class='fa fa-check'></i></a>";
                                data += '["' + link1 + '", "camp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "targetgroup"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }
                        if (response[3] != null) { //set Client Parent
                            var adv = response[3].get_advertiser;
                            $('#client_list').dataTable().fnClearTable();
                            $('#advertiser_list').dataTable().fnClearTable();
                            var data = '';
                            var link1 = "<a id='cln" + adv.get_client_i_d.id + "' href='javascript: changeReport(" + adv.get_client_i_d.id + ",`client`)'>" + adv.get_client_i_d.name + " </a>";
                            data += '["' + link1 + '", "client"]';
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                            var data = '';
                            var link1 = "<a id='adv" + adv.id + "' href='javascript: changeReport(" + adv.id + ",`advertiser`)'>" + adv.name + " </a>";
                            data += '["' + link1 + '", "adv"]';
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);

                        }

                    }
                    if (response[0] == 'creative') {
                        $('#client_list').dataTable().fnClearTable();
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a class='report-selected' id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "<i class='fa fa-check'></i> </a>";
                                data += '["' + link1 + '", "crt"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='adv" + this.get_advertiser.id + "' href='javascript: changeReport(" + this.get_advertiser.id + ",`advertiser`)'>" + this.get_advertiser.name + "</a>";
                                data += '["' + link1 + '", "adv"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='cln" + this.get_advertiser.get_client_id.id + "' href='javascript: changeReport(" + this.get_advertiser.get_client_id.id + ",`client`)'>" + this.get_advertiser.get_client_id.name + "</a>";
                                data += '["' + link1 + '", "cln"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "cmp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "gsm"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                if(this.get_campaign!=null) {
                                    var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", "tgp"],';
                                }
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }

                    }
                    if (response[0] == 'geosegment') {
                        $('#client_list').dataTable().fnClearTable();
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a class='report-selected' id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "<i class='fa fa-check'></i> </a>";
                                data += '["' + link1 + '", "crt"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='adv" + this.get_advertiser.id + "' href='javascript: changeReport(" + this.get_advertiser.id + ",`advertiser`)'>" + this.get_advertiser.name + "</a>";
                                data += '["' + link1 + '", "adv"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a id='cln" + this.get_advertiser.get_client_id.id + "' href='javascript: changeReport(" + this.get_advertiser.get_client_id.id + ",`client`)'>" + this.get_advertiser.get_client_id.name + "</a>";
                                data += '["' + link1 + '", "cln"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "cmp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "crt"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }

                    }
                    if (response[0] == 'advertiser') {
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        if (response[1].length > 0) {
                            var data = '';
                            $.each(response[1], function () {
                                var link1 = "<a class='report-selected' id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + " <i class='fa fa-check'></i></a>";
                                data += '["' + link1 + '", "cmp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "cmp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "cmp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", "cmp"],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if (response[5] != null) { //set Client Parent
                            $('#client_list').dataTable().fnClearTable();
                            var data = '';
                            var link1 = "<a id='cln" + response[5].get_client_i_d.id + "' href='javascript: changeReport(" + response[5].get_client_i_d.id + ",`client`)'>" + response[5].get_client_i_d.name + " </a>";
                            data += '["' + link1 + '", "client"]';
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                    }
//                var cb = '';
//                var data = jQuery.parseJSON(response);
//                var len = data.length;
//                cb = '<option value="0" disabled>select one</option>';
//                for (var i = 0; i < len; i++) {
//                    cb += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
//                }
//                $('#iab_sub_category').html(cb);
                });
            }
        }
        $(document).ready(function() {

            pageSetUp();
            /* BASIC ;*/
            var client_list = undefined;
            var advertiser_list = undefined;
            var campaign_list = undefined;
            var targetgroup_list = undefined;
            var creative_list = undefined;
            var geosegment_list = undefined;

            $('#client_list').dataTable({
                "lengthMenu": [[3, 5, 10], [3, 5, 10]],
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-9'f><'col-sm-3 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-xs-12 col-sm-12'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!client_list) {
                        client_list = new ResponsiveDatatablesHelper($('#client_list'));
                    }
                },
                "rowCallback" : function(nRow) {
                    client_list.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    client_list.respond();
                }
            });
            $('#advertiser_list').dataTable({
                "lengthMenu": [[3, 5, 10], [3, 5, 10]],
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-9'f><'col-sm-3 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-xs-12 col-sm-12'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!advertiser_list) {
                        advertiser_list = new ResponsiveDatatablesHelper($('#advertiser_list'));
                    }
                },
                "rowCallback" : function(nRow) {
                    advertiser_list.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    advertiser_list.respond();
                }
            });
            $('#campaign_list').dataTable({
                "lengthMenu": [[3, 5, 10], [3, 5, 10]],
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-9'f><'col-sm-3 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-xs-12 col-sm-12'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!campaign_list) {
                        campaign_list = new ResponsiveDatatablesHelper($('#campaign_list'));
                    }
                },
                "rowCallback" : function(nRow) {
                    campaign_list.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    campaign_list.respond();
                }
            });
            $('#targetgroup_list').dataTable({
                "lengthMenu": [[3, 5, 10], [3, 5, 10]],
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-9'f><'col-sm-3 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-xs-12 col-sm-12'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!targetgroup_list) {
                        targetgroup_list = new ResponsiveDatatablesHelper($('#targetgroup_list'));
                    }
                },
                "rowCallback" : function(nRow) {
                    targetgroup_list.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    targetgroup_list.respond();
                }
            });
            $('#creative_list').dataTable({
                "lengthMenu": [[3, 5, 10], [3, 5, 10]],
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-9'f><'col-sm-3 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-xs-12 col-sm-12'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!creative_list) {
                        creative_list = new ResponsiveDatatablesHelper($('#creative_list'));
                    }
                },
                "rowCallback" : function(nRow) {
                    creative_list.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    creative_list.respond();
                }
            });
            $('#geosegment_list').dataTable({
                "lengthMenu": [[3, 5, 10], [3, 5, 10]],
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-9'f><'col-sm-3 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-xs-12 col-sm-12'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!geosegment_list) {
                        geosegment_list = new ResponsiveDatatablesHelper($('#geosegment_list'));
                    }
                },
                "rowCallback" : function(nRow) {
                    geosegment_list.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    geosegment_list.respond();
                }
            });








            $( ".glyphicon-search" ).parent().css( "display", "none" );
            /* END BASIC */
            // START AND FINISH DATE
            g1 = new Dygraph(document.getElementById("noroll"), data_temp, {
                customBars : true,
                title : 'test',
                ylabel : 'Impression',
                legend : 'always',
                labelsDivStyles : {
                    'textAlign' : 'right'
                },
                showRangeSelector : true
            });

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
        });
    </script>



@endsection