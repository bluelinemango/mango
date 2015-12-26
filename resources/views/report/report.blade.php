@extends('Layout')
@section('siteTitle')Add Client @endsection
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
        $(document).ready(function() {

            pageSetUp();
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
        });
    </script>


    <script type="text/javascript">

        $(document).ready(function() {
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            pageSetUp();

            /*
             * PAGE RELATED SCRIPTS
             */

            g1 = new Dygraph(document.getElementById("noroll"), data_temp, {
                customBars : true,
                title : 'Daily Temperatures in New York vs. San Francisco',
                ylabel : 'Temperature (F)',
                legend : 'always',
                labelsDivStyles : {
                    'textAlign' : 'right'
                },
                showRangeSelector : true
            });

            g2 = new Dygraph(document.getElementById("roll14"), data_temp, {
                rollPeriod : 14,
                showRoller : true,
                customBars : true,
                ylabel : 'Temperature (F)',
                legend : 'always',
                labelsDivStyles : {
                    'textAlign' : 'right'
                },
                showRangeSelector : true,
                rangeSelectorHeight : 30,
                rangeSelectorPlotStrokeColor : 'yellow',
                rangeSelectorPlotFillColor : 'lightyellow'
            });

        })
    </script>

@endsection