@extends('Layout')
@section('siteTitle')Add Client @endsection
@section('header_extra')
    <style>
        table, tr, td, th
        {
            border: 1px solid black;
            border-collapse:collapse;
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="order-form" class="smart-form no-padding" action="{{URL::route('client_create')}}" method="post" novalidate="novalidate" >
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <div class="row">
                                                            <section class="col col-6">
                                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                                    <input type="text" name="startdate" id="startdate" placeholder="Expected start date">
                                                                </label>

                                                            </section>
                                                            <section class="col col-6">
                                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                                    <input type="text" name="finishdate" id="finishdate" placeholder="Expected finish date">
                                                                </label>
                                                            </section>
                                                        </div>


                                                </form>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0);" class="btn bg-color-magenta txt-color-white">whole today</a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0);" class="btn bg-color-red txt-color-white">yesterday</a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0);" class="btn bg-color-green txt-color-white">last hour</a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0);" class="btn bg-color-greenLight txt-color-white">last 5 min</a>
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
                        <article class="col-sm-8 col-md-8 col-lg-8">
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
                        <article class="col-sm-4 col-md-4 col-lg-4">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-1">
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table " >
                                                    <tr class="header expand">
                                                        <th >campaign <span class="sign"></span></th>
                                                    </tr>
                                                    @foreach($clients as $index_cln)
                                                    <tr>
                                                        <td>
                                                            {{$index_cln->name}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table " >
                                                    <tr class="header expand">
                                                        <th >campaign <span class="sign"></span></th>
                                                    </tr>
                                                    @foreach($advertiser as $index_adv)
                                                    <tr>
                                                        <td>
                                                            {{$index_adv->name}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
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

    <script>
        $('.header').click(function(){
            $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
        });
        $(document).ready(function() {

            pageSetUp();
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