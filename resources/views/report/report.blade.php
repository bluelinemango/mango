@extends('Layout')
@section('siteTitle') System Reporting @endsection
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
            text-align: center;
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
        .well{
            padding: 10px 19px;
        }
        .entity .well{
            padding: 0px 0px;
        }
        .entity hr{
            margin: 0px;
        }
        .entity .row{
            padding: 10px 10px 2px;
        }
        .entity .fa-plus{
            cursor: pointer;
        }
        .btn{
            padding: 2px 9px;
        }
        .active-btn{
            background-color: #480034 !important;
        }
        .dygraph-label{
            height: 22px;
            width: 100px;
            float: right;
            margin-right: 35px;
        }
        .dygraph-legend{
            left:0 !important;
            width:100% !important;
        }
        #impression, #click , #conversion{
            height: 160px !important;
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
                        <article class="col-sm-8 col-md-8 col-lg-8">
                                <!-- widget div-->
                                <div class="well">

                                    <!-- widget content -->
                                    <div class="row" style="min-height: 0 !important;">
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
                                            <div class="col-md-7">
                                                <div class="col-md-12">
                                                    <div class="col-md-1 no-padding">
                                                        <span style="line-height: 22px; font-weight: bold">From</span>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <input type="text" name="startdate" id="startdate" placeholder="start date">
                                                    </div>
                                                    <div class="col-md-1 no-padding">
                                                        <span style="line-height: 22px; font-weight: bold">To</span>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                            <input type="text" name="finishdate" id="finishdate" placeholder="finish date">
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <a href="javascript:changeReport('rang','report_type');" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div id="btn-report-type" class="col-md-12">
                                                    <a id="10m" href="javascript: changeReport('10m','report_type');" class="btn btn-primary">10m</a>
                                                    <a id="1h" href="javascript:changeReport('1h','report_type');" class="btn btn-primary">1h</a>
                                                    <a id="3h" href="javascript:changeReport('3h','report_type');" class="btn btn-primary">3h</a>
                                                    <a id="6h" href="javascript:changeReport('6h','report_type');" class="btn btn-primary">6h</a>
                                                    <a id="1D" href="javascript:changeReport('1D','report_type');" class="btn btn-primary">1D</a>
                                                    <a id="1M" href="javascript:changeReport('1M','report_type');" class="btn btn-primary">1M</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                        </article>
                        <article class="col-sm-8 col-md-8 col-lg-8">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body">

                                        <!-- this is what the user will see -->
                                        <div id="impression" style="width:100%; height:300px;"></div>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <!-- this is what the user will see -->
                                        <div id="click" style="width:100%; height:300px;"></div>
                                    </div>
                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                            </div>
                            <!-- end widget -->
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body">

                                        <!-- this is what the user will see -->
                                        <div id="conversion" style="width:100%; height:300px;"></div>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->


                        </article>
                        <article class="col-sm-4 col-md-4 col-lg-4 entity">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <section id="widget-grid" class="">
                                <!-- widget div-->
                                <div class="row">
                                    <!-- widget content -->
                                    <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable no-padding">
                                        <div class="col-md-12 no-padding" id="client_box">
                                            <!-- Widget ID (each widget will need unique ID)-->
                                            <div class="well">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="pull-left">Client</p>
                                                        <a href="javascript: changeReport('client','close_entity') "><span class="pull-right"><i class="fa fa-plus"></i></span>                                              </a>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <!-- widget content -->
                                                <div class="no-padding">
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
                                                                    <a id="cln{{$index_cln->client_id}}" href="javascript: changeReport('{{$index_cln->client_id}}','client')">{{$index_cln->name}}</a>

                                                                </td>
                                                                <td>{{$index_cln->imps}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- end widget content -->
                                            </div>
                                            <!-- end widget -->
                                        </div>

                                        <div class="col-md-12 no-padding" id="targetgroup_box">
                                            <div class="well">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="pull-left">Target Group</p>
                                                        <a href="javascript: changeReport('targetgroup','close_entity') "><span class="pull-right"><i class="fa fa-plus"></i></span>                                              </a>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="no-padding">

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
                                                                    <a id="tgp{{$index_tgp->targetgroup_id}}" href="javascript: changeReport('{{$index_tgp->targetgroup_id}}','targetgroup')">{{$index_tgp->name}}</a>
                                                                </td>
                                                                <td>{{$index_tgp->imps}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>


                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-12 no-padding" id="geosegment_box">
                                            <div class="well">
                                                <!-- widget content -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="pull-left">Geo Segment</p>
                                                        <a href="javascript: changeReport('geosegment','close_entity') "><span class="pull-right"><i class="fa fa-plus"></i></span>                                              </a>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="no-padding">

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
                                                                    <a id="gsm{{$index_gsm->geosegment_id}}" href="javascript: changeReport('{{$index_gsm->geosegment_id}}','geosegment')">{{$index_gsm->name}}</a>
                                                                </td>
                                                                <td>{{$index_gsm->imps}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- end widget content -->

                                            </div>

                                        </div>

                                    </article>
                                    <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable no-padding">
                                        <div class="col-md-12 no-padding" id="advertiser_box">
                                            <div class="well">
                                                <!-- widget content -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="pull-left">Advertiser</p>
                                                        <a href="javascript: changeReport('advertiser','close_entity') "><span class="pull-right"><i class="fa fa-plus"></i></span>                                              </a>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="no-padding">

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
                                                                    <a id="adv{{$index_adv->advertiser_id}}" href="javascript: changeReport('{{$index_adv->advertiser_id}}','advertiser')">{{$index_adv->name}}</a>
                                                                </td>
                                                                <td>{{$index_adv->imps}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- end widget content -->

                                            </div>

                                        </div>
                                        <div class="col-md-12 no-padding" id="campaign_box">
                                            <!-- Widget ID (each widget will need unique ID)-->
                                            <div class="well">
                                                <!-- widget content -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="pull-left">Campaign</p>
                                                        <a href="javascript: changeReport('campaign','close_entity') "><span class="pull-right"><i class="fa fa-plus"></i></span>                                              </a>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="no-padding">

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
                                                                    <a id="cmp{{$index_cmp->campaign_id}}" href="javascript: changeReport('{{$index_cmp->campaign_id}}','campaign')">{{$index_cmp->name}}</a>

                                                                </td>
                                                                <td>{{$index_cmp->imps}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- end widget content -->

                                            </div>
                                            <!-- end widget div -->
                                        </div>
                                        <div class="col-md-12 no-padding" id="creative_box">
                                            <!-- Widget ID (each widget will need unique ID)-->
                                            <div class="well">
                                                <!-- widget content -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="pull-left">Creative</p>
                                                        <a href="javascript: changeReport('creative','close_entity') "><span class="pull-right"><i class="fa fa-plus"></i></span>                                              </a>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="no-padding">

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
                                                                    <a id="crt{{$index_crt->creative_id}}" href="javascript: changeReport('{{$index_crt->creative_id}}','creative')">{{$index_crt->name}}</a>

                                                                </td>
                                                                <td>{{$index_crt->imps}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- end widget content -->

                                            </div>
                                            <!-- end widget div -->
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

                <div class="row">
                    <div class="col-md-12 well" id="entity_box">

                    </div>
                </div>
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
            var lntstr=10;
            var client=$('input[name="client"]');
            var advertiser=$('input[name="advertiser"]');
            var campaign=$('input[name="campaign"]');
            var targetgroup=$('input[name="targetgroup"]');
            var geosegment=$('input[name="geosegment"]');
            var creative=$('input[name="creative"]');
            var report_type=$('input[name="report_type"]');
            var start_date=$('input[name="startdate"]');
            var end_date=$('input[name="enddate"]');
            if(type=='client'){
                if(client.val()==id){
                    client.val('');
                    advertiser.val('');
                    campaign.val('');
                    targetgroup.val('');
                    geosegment.val('');
                    creative.val('');
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
//                    $('#client_list').find('a').removeClass();
//                    $('#cln' + id).addClass('report-selected');
//                    $('#cln' + id).parents('tr').addClass('report-selected');
//                    $('#client_list').find('tr:not(.report-selected)').hide();
//                    $.each(response[1], function () {
                }
            }
            if(type=='close_entity'){
                if(id=='client'){
                    client.val('');
                    $('#client_box').animate({height: "toggle" , opacity:0},300);
                    $('#entity_box').append("<a id='client_expand' class='col-md-2' href='javascript: changeReport(`client`,`open_entity`)'><h5>Client <i class='fa fa-plus'></i></h5></a>");
                    type='unfilter';
                }else if(id=='advertiser'){
                    advertiser.val('');
                    $('#advertiser_box').animate({height: "toggle" , opacity:0},300);
                    $('#entity_box').append("<a id='advertiser_expand' class='col-md-2' href='javascript: changeReport(`advertiser`,`open_entity`)'><h5>Advertiser <i class='fa fa-plus'></i></h5></a>");
                    type='unfilter';
                }else if(id=='creative'){
                    creative.val('');
                    $('#creative_box').animate({height: "toggle" , opacity:0},300);
                    $('#entity_box').append("<a id='creative_expand' class='col-md-2' href='javascript: changeReport(`creative`,`open_entity`)'><h5>Creative <i class='fa fa-plus'></i></h5></a>");
                    type='unfilter';
                }else if(id=='geosegment'){
                    geosegment.val('');
                    $('#geosegment_box').animate({height: "toggle" , opacity:0},300);
                    $('#entity_box').append("<a id='geosegment_expand' class='col-md-2' href='javascript: changeReport(`geosegment`,`open_entity`)'><h5>Geo Segment <i class='fa fa-plus'></i></h5></a>");
                    type='unfilter';
                }else if(id=='campaign'){
                    campaign.val('');
                    $('#campaign_box').animate({height: "toggle" , opacity:0},300);
                    $('#entity_box').append("<a id='campaign_expand' class='col-md-2' href='javascript: changeReport(`campaign`,`open_entity`)'><h5>Campaign<i class='fa fa-plus'></i></h5></a>");
                    type='unfilter';
                }else if(id=='targetgroup'){
                    targetgroup.val('');
                    $('#targetgroup_box').animate({height: "toggle" , opacity:0},300);
                    $('#entity_box').append("<a id='targetgroup_expand' class='col-md-2' href='javascript: changeReport(`targetgroup`,`open_entity`)'><h5>Target Group<i class='fa fa-plus'></i></h5></a>");
                    type='unfilter';
                }

            }
            if(type=='open_entity'){
                if(id=='client'){
                    client.val('');
                    $('#client_box').animate({height: "toggle" , opacity:1},300);
                    $('#client_expand').remove();
                    type='do_nothing';
                }else if(id=='advertiser'){
                    advertiser.val('');
                    $('#advertiser_box').animate({height: "toggle" , opacity:1},300);
                    $('#advertiser_expand').remove();
                    type='do_nothing';
                }else if(id=='creative'){
                    creative.val('');
                    $('#creative_box').animate({height: "toggle" , opacity:1},300);
                    $('#creative_expand').remove();
                    type='do_nothing';
                }else if(id=='geosegment'){
                    geosegment.val('');
                    $('#geosegment_box').animate({height: "toggle" , opacity:1},300);
                    $('#geosegment_expand').remove();
                    type='do_nothing';
                }else if(id=='campaign'){
                    campaign.val('');
                    $('#campaign_box').animate({height: "toggle" , opacity:1},300);
                    $('#campaign_expand').remove();
                    type='do_nothing';
                }else if(id=='targetgroup'){
                    targetgroup.val('');
                    $('#targetgroup_box').animate({height: "toggle" , opacity:1},300);
                    $('#targetgroup_expand').remove();
                    type='do_nothing';
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
                    type='unfilter'
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
                }
            }
            if(type=='campaign'){
                if(campaign.val()==id && (advertiser.val()!='' || client.val()!='' || creative.val()!='' || geosegment.val()!='')){
                    targetgroup.val('');
                    campaign.val('');
                    $('#campaign_list').find('a').removeClass();
                    $('#cmp'+id).removeClass();
                    type='unfilter'
                }else if(campaign.val()==id && advertiser.val()=='' && client.val()=='' && creative.val()=='' && geosegment.val()==''){
                    targetgroup.val('');
                    campaign.val('');
                    type='client_unfilter';
                }else if(campaign.val()=='' && (targetgroup.val()!='')){
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
                    type='unfilter'
                }else{
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
                    type='unfilter'
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
                    type='unfilter'
                }else if(geosegment.val()==id && (campaign.val()=='' || targetgroup.val()=='' || creative.val()=='' || advertiser.val()=='' || client.val()=='')){
                    geosegment.val('');
                    $('#geosegment_list').find('a').removeClass();
                    $('#gsm'+id).removeClass();
                    type='client_unfilter'
                }else {
                    geosegment.val(id);
                }
            }
            if(type=='report_type'){
                report_type.val(id);
                if(id=='rang'){
                    $('#btn-report-type').find('a').removeClass('active-btn');
                    start_date.val($('#startdate').val());
                    end_date.val($('#finishdate').val());
                }else{
                    $('#startdate').val('');
                    $('#finishdate').val('');
                    $('#btn-report-type').find('a').removeClass('active-btn');
                    $('#'+id).addClass('active-btn');

                }
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
                        targetgroup: targetgroup.val(),
                        type: type ,
                        report_type: report_type.val(),
                        start_date: start_date.val(),
                        end_date: end_date.val()
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
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a class='report-selected' id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "<i class='fa fa-check'></i></a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if (response[5].length > 0) {
                            var data = '';
                            $.each(response[5], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[6].length > 0) {
                            var data = '';
                            $.each(response[6], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
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
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if (response[5].length > 0) {
                            var data = '';
                            $.each(response[5], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[6].length > 0) {
                            var data = '';
                            $.each(response[6], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';

                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }

                    }
                    if (response[0] == 'unfilter') {
                        if (response[1].length > 0) {
                            $('#client_list').dataTable().fnClearTable();
                            var data = '';
                            $.each(response[1], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#client_list').dataTable().fnAddData(data);
                        }
                        if (response[2].length > 0) {
                            $('#advertiser_list').dataTable().fnClearTable();
                            var data = '';
                            $.each(response[2], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            $('#creative_list').dataTable().fnClearTable();
                            var data = '';
                            $.each(response[3], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            $('#geosegment_list').dataTable().fnClearTable();
                            var data = '';
                            $.each(response[4], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if (response[5].length > 0) {
                            $('#campaign_list').dataTable().fnClearTable();
                            var data = '';
                            $.each(response[5], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[6].length > 0) {
                            $('#targetgroup_list').dataTable().fnClearTable();
                            var data = '';
                            $.each(response[6], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
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
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        if(client.val()=='') {
                            $('#client_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.name.length>lntstr){
                                        this.name=this.name.substr(0,lntstr)+'...';
                                    }
                                    var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", '+this.imps+'],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#client_list').dataTable().fnAddData(data);
                            }
                        }
                        if(advertiser.val()=='') {
                            $('#advertiser_list').dataTable().fnClearTable();
                            if (response[2].length > 0) {
                                var data = '';
                                $.each(response[2], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#advertiser_list').dataTable().fnAddData(data);
                            }
                        }
                        if(creative.val()=='') {
                            $('#creative_list').dataTable().fnClearTable();
                            if (response[3].length > 0) {
                                var data = '';
                                $.each(response[3], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#creative_list').dataTable().fnAddData(data);
                            }
                        }
                        if(geosegment.val()=='') {
                            $('#geosegment_list').dataTable().fnClearTable();
                            if (response[4].length > 0) {
                                var data = '';
                                $.each(response[4], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#geosegment_list').dataTable().fnAddData(data);
                            }
                        }
                        if (response[5].length > 0) {
                            var data = '';
                            $.each(response[5], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a class='report-selected' id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "<i class='fa check-fa'></i></a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[6].length > 0) {
                            var data = '';
                            $.each(response[6], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }

                    }
                    if (response[0] == 'report_type') {
                        if (response[1].length == 0) {
                            client.val('');
                        }
                        if (response[2].length == 0) {
                            advertiser.val('');
                        }
                        if (response[3].length == 0) {
                            creative.val('');
                        }
                        if (response[4].length == 0) {
                            geosegment.val('');
                        }
                        if (response[5].length == 0) {
                            campaign.val('');
                        }
                        if (response[6].length == 0) {
                            targetgroup.val('');
                        }
                        if(client.val()=='') {
                            $('#client_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.name.length>lntstr){
                                        this.name=this.name.substr(0,lntstr)+'...';
                                    }
                                    var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", '+this.imps+'],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#client_list').dataTable().fnAddData(data);
                            }
                        }
                        if(advertiser.val()=='') {
                            $('#advertiser_list').dataTable().fnClearTable();
                            if (response[2].length > 0) {
                                var data = '';
                                $.each(response[2], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#advertiser_list').dataTable().fnAddData(data);
                            }
                        }
                        if(creative.val()=='') {
                            $('#creative_list').dataTable().fnClearTable();
                            if (response[3].length > 0) {
                                var data = '';
                                $.each(response[3], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#creative_list').dataTable().fnAddData(data);
                            }
                        }
                        if(geosegment.val()=='') {
                            $('#geosegment_list').dataTable().fnClearTable();
                            if (response[4].length > 0) {
                                var data = '';
                                $.each(response[4], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#geosegment_list').dataTable().fnAddData(data);
                            }
                        }
                        if(campaign.val()=='') {
                            $('#campaign_list').dataTable().fnClearTable();
                            if (response[5].length > 0) {
                                var data = '';
                                $.each(response[5], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#campaign_list').dataTable().fnAddData(data);
                            }
                        }
                        if(targetgroup.val()=='') {
                            $('#targetgroup_list').dataTable().fnClearTable();

                            if (response[6].length > 0) {
                                var data = '';
                                $.each(response[6], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#targetgroup_list').dataTable().fnAddData(data);
                            }
                        }

                    }
                    if (response[0] == 'targetgroup') {
                        $('#targetgroup_list').dataTable().fnClearTable();
                        if(client.val()=='') {
                            $('#client_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.name.length>lntstr){
                                        this.name=this.name.substr(0,lntstr)+'...';
                                    }
                                    var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", '+this.imps+'],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#client_list').dataTable().fnAddData(data);
                            }
                        }
                        if(advertiser.val()=='') {
                            $('#advertiser_list').dataTable().fnClearTable();
                            if (response[2].length > 0) {
                                var data = '';
                                $.each(response[2], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#advertiser_list').dataTable().fnAddData(data);
                            }
                        }
                        if(creative.val()=='') {
                            $('#creative_list').dataTable().fnClearTable();
                            if (response[3].length > 0) {
                                var data = '';
                                $.each(response[3], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#creative_list').dataTable().fnAddData(data);
                            }
                        }
                        if(geosegment.val()=='') {
                            $('#geosegment_list').dataTable().fnClearTable();
                            if (response[4].length > 0) {
                                var data = '';
                                $.each(response[4], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#geosegment_list').dataTable().fnAddData(data);
                            }
                        }
                        if(campaign.val()=='') {
                            $('#campaign_list').dataTable().fnClearTable();
                            if (response[5].length > 0) {
                                var data = '';
                                $.each(response[5], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#campaign_list').dataTable().fnAddData(data);
                            }
                        }
                        if (response[6].length > 0) {
                            var data = '';
                            $.each(response[6], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a class='report-selected' id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "<i class='fa check-fa'></i></a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }

                    }
                    if (response[0] == 'creative') {
                        $('#creative_list').dataTable().fnClearTable();
                        if(client.val()=='') {
                            $('#client_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.name.length>lntstr){
                                        this.name=this.name.substr(0,lntstr)+'...';
                                    }
                                    var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", '+this.imps+'],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#client_list').dataTable().fnAddData(data);
                            }
                        }
                        if(advertiser.val()=='') {
                            $('#advertiser_list').dataTable().fnClearTable();
                            if (response[2].length > 0) {
                                var data = '';
                                $.each(response[2], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#advertiser_list').dataTable().fnAddData(data);
                            }
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                if (this.name.length > lntstr) {
                                    this.name = this.name.substr(0, lntstr) + '...';
                                }
                                var link1 = "<a class='report-selected' id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "<i class='fa check-fa'></i></a>";
                                data += '["' + link1 + '", ' + this.imps + '],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if(geosegment.val()=='') {
                            $('#geosegment_list').dataTable().fnClearTable();
                            if (response[4].length > 0) {
                                var data = '';
                                $.each(response[4], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#geosegment_list').dataTable().fnAddData(data);
                            }
                        }
                        if(campaign.val()=='') {
                            $('#campaign_list').dataTable().fnClearTable();
                            if (response[5].length > 0) {
                                var data = '';
                                $.each(response[5], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#campaign_list').dataTable().fnAddData(data);
                            }
                        }
                        if(targetgroup.val()=='') {
                            $('#targetgroup_list').dataTable().fnClearTable();
                            if (response[6].length > 0) {
                                var data = '';
                                $.each(response[6], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#targetgroup_list').dataTable().fnAddData(data);
                            }
                        }
                    }
                    if (response[0] == 'geosegment') {
                        $('#geosegment_list').dataTable().fnClearTable();
                        if(client.val()=='') {
                            $('#client_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.name.length>lntstr){
                                        this.name=this.name.substr(0,lntstr)+'...';
                                    }
                                    var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", '+this.imps+'],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#client_list').dataTable().fnAddData(data);
                            }
                        }
                        if(advertiser.val()=='') {
                            $('#advertiser_list').dataTable().fnClearTable();
                            if (response[2].length > 0) {
                                var data = '';
                                $.each(response[2], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#advertiser_list').dataTable().fnAddData(data);
                            }
                        }
                        if(creative.val()=='') {
                            $('#creative_list').dataTable().fnClearTable();
                            if (response[3].length > 0) {
                                var data = '';
                                $.each(response[3], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#creative_list').dataTable().fnAddData(data);
                            }
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                if (this.name.length > lntstr) {
                                    this.name = this.name.substr(0, lntstr) + '...';
                                }
                                var link1 = "<a class='report-selected' id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "<i class='fa check-fa'></i></a>";
                                data += '["' + link1 + '", ' + this.imps + '],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if(campaign.val()=='') {
                            $('#campaign_list').dataTable().fnClearTable();
                            if (response[5].length > 0) {
                                var data = '';
                                $.each(response[5], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#campaign_list').dataTable().fnAddData(data);
                            }
                        }
                        if(targetgroup.val()=='') {
                            $('#targetgroup_list').dataTable().fnClearTable();
                            if (response[6].length > 0) {
                                var data = '';
                                $.each(response[6], function () {
                                    if (this.name.length > lntstr) {
                                        this.name = this.name.substr(0, lntstr) + '...';
                                    }
                                    var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", ' + this.imps + '],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#targetgroup_list').dataTable().fnAddData(data);
                            }
                        }

                    }
                    if (response[0] == 'advertiser') {
                        $('#advertiser_list').dataTable().fnClearTable();
                        $('#campaign_list').dataTable().fnClearTable();
                        $('#targetgroup_list').dataTable().fnClearTable();
                        $('#geosegment_list').dataTable().fnClearTable();
                        $('#creative_list').dataTable().fnClearTable();
                        if(client.val()=='') {
                            $('#client_list').dataTable().fnClearTable();
                            if (response[1].length > 0) {
                                var data = '';
                                $.each(response[1], function () {
                                    if(this.name.length>lntstr){
                                        this.name=this.name.substr(0,lntstr)+'...';
                                    }
                                    var link1 = "<a id='cln" + this.id + "' href='javascript: changeReport(" + this.id + ",`client`)'>" + this.name + "</a>";
                                    data += '["' + link1 + '", '+this.imps+'],';
                                });
                                data = data.substr(0, data.length - 1);
                                data = '[' + data + ']';
                                data = JSON.parse(data);
                                $('#client_list').dataTable().fnAddData(data);
                            }
                        }
                        if (response[2].length > 0) {
                            var data = '';
                            $.each(response[2], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a class='report-selected' id='adv" + this.id + "' href='javascript: changeReport(" + this.id + ",`advertiser`)'>" + this.name + "<i class='fa check-fa'></i></a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#advertiser_list').dataTable().fnAddData(data);
                        }
                        if (response[3].length > 0) {
                            var data = '';
                            $.each(response[3], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='crt" + this.id + "' href='javascript: changeReport(" + this.id + ",`creative`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#creative_list').dataTable().fnAddData(data);
                        }
                        if (response[4].length > 0) {
                            var data = '';
                            $.each(response[4], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='gsm" + this.id + "' href='javascript: changeReport(" + this.id + ",`geosegment`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#geosegment_list').dataTable().fnAddData(data);
                        }
                        if (response[5].length > 0) {
                            var data = '';
                            $.each(response[5], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='cmp" + this.id + "' href='javascript: changeReport(" + this.id + ",`campaign`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#campaign_list').dataTable().fnAddData(data);
                        }
                        if (response[6].length > 0) {
                            var data = '';
                            $.each(response[6], function () {
                                if(this.name.length>lntstr){
                                    this.name=this.name.substr(0,lntstr)+'...';
                                }
                                var link1 = "<a id='tgp" + this.id + "' href='javascript: changeReport(" + this.id + ",`targetgroup`)'>" + this.name + "</a>";
                                data += '["' + link1 + '", '+this.imps+'],';
                            });
                            data = data.substr(0, data.length - 1);
                            data = '[' + data + ']';
                            data = JSON.parse(data);
                            $('#targetgroup_list').dataTable().fnAddData(data);
                        }
                    }
                    if(response[0] == 'report_type'){
                        if (response[1].length > 15) {
                            function data_temp1() {
                                return response[1];
                            }
                            g1 = new Dygraph(document.getElementById("impression"), data_temp1, {
                                customBars : true,
                                ylabel : 'Impression',
                                legend : 'always',
                                labelsDivStyles : {
                                    'textAlign' : 'right'
                                },
                                showRangeSelector : true
                            });
                        }else{

                        }
                        if (response[2].length > 15) {
                            function data_temp2() {
                                return response[2];
                            }
                            g2 = new Dygraph(document.getElementById("click"), data_temp2, {
                                customBars : true,
                                title : '',
                                ylabel : 'Click',
                                legend : 'always',
                                labelsDivStyles : {
                                    'textAlign' : 'right'
                                },
                                showRangeSelector : true
                            });
                        }
                        if (response[3].length > 15) {
                            function data_temp3() {
                                return response[3];
                            }
                            g3 = new Dygraph(document.getElementById("conversion"), data_temp3, {
                                customBars : true,
                                title : '',
                                ylabel : 'conversion',
                                legend : 'always',
                                labelsDivStyles : {
                                    'textAlign' : 'right'
                                },
                                showRangeSelector : true
                            });
                        }

                    }

                    if (response[7].length > 15) {
                        function data_temp7() {
                            return response[7];
                        }
                        g1 = new Dygraph(document.getElementById("impression"), data_temp7, {
                            customBars : true,
                            ylabel : 'Impression',
                            legend : 'always',
                            labelsDivStyles : {
                                'textAlign' : 'right'
                            },
                            showRangeSelector : true
                        });
                    }
                    if (response[8].length > 15) {
                        function data_temp8() {
                            return response[8];
                        }
                        g1 = new Dygraph(document.getElementById("impression"), data_temp8, {
                            customBars : true,
                            ylabel : 'Impression',
                            legend : 'always',
                            labelsDivStyles : {
                                'textAlign' : 'right'
                            },
                            showRangeSelector : true
                        });
                    }
                    if (response[9].length > 15) {
                        function data_temp9() {
                            return response[9];
                        }
                        g1 = new Dygraph(document.getElementById("impression"), data_temp9, {
                            customBars : true,
                            ylabel : 'Impression',
                            legend : 'always',
                            labelsDivStyles : {
                                'textAlign' : 'right'
                            },
                            showRangeSelector : true
                        });
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
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
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
            g3 = new Dygraph(document.getElementById("conversion"), data_temp, {
                customBars : true,
                ylabel : 'conversion',
                legend : 'always',
                labelsDivStyles : {
                    'textAlign' : 'right'
                },
                showRangeSelector : true
            });
            g2 = new Dygraph(document.getElementById("click"), data_temp, {
                customBars : true,
                ylabel : 'click',
                legend : 'always',
                labelsDivStyles : {
                    'textAlign' : 'right'
                },
                showRangeSelector : true
            });
            g1 = new Dygraph(document.getElementById("impression"), data_temp, {
                customBars : true,
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