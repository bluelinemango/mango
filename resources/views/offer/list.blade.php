@extends('Layout1')
@section('siteTitle')List Of Offer for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')

    <div class="content">

        <div class="page-header full-content">
            <div class="row">
                <div class="col-sm-6">
                    <h1>NOMADINI <small>Diffrent Ads</small></h1>
                </div><!--.col-->
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ion-home"></i></a></li>
                        <li><a href="#">Offer</a></li>
                        <li><a href="#" class="active">List</a></li>
                    </ol>
                </div><!--.col-->
            </div><!--.row-->
        </div><!--.page-header-->

        <!-- content -->
        <div class="col-md-9">
            <div class="panel light-blue">
                <div class="panel-heading">
                    <div class="panel-title"><h4>Offer List</h4></div>
                </div><!--.panel-heading-->
                <div class="panel-body">
                    <div id="offer_grid"></div>
                </div><!--.panel-body-->
            </div><!--.panel-->
        </div><!--.col-->
        <div class="col-md-3">
            <div class="panel indigo">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class="pull-left">Activities</h4>
                        <div class="pull-right audit-select">
                            <select id="audit_status" class="selecter col-md-12" >
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
        </div>
        <!--.col-->
        <!-- content -->

        <div class="footer-links margin-top-40">
            <div class="row no-gutters">
                <div class="col-xs-6 bg-indigo">
                    <a href="#">
                        <span class="state">Pages</span>
                        <span>Timeline</span>
                        <span class="icon"><i class="ion-android-arrow-back"></i></span>
                    </a>
                </div><!--.col-->
                <div class="col-xs-6 bg-cyan">
                    <a href="#">
                        <span class="state">Components</span>
                        <span>Offline Detector</span>
                        <span class="icon"><i class="ion-android-arrow-forward"></i></span>
                    </a>
                </div><!--.col-->
            </div><!--.row-->
        </div><!--.footer-links-->

    </div><!--.content-->

@endsection

@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    {{--<script src="{{cdn('js/plugin/jqgrid/jquery.jqGrid.min.js')}}"></script>--}}
    {{--<script src="{{cdn('js/plugin/jqgrid/grid.locale-en.min.js')}}"></script>--}}

    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                    url: "{{url('ajax/getAudit/offer')}}"
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

        $(document).ready(function() {
            $.ajax({
                url: "{{url('ajax/getAudit/offer')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.offer, function (offer) {
                            return (!filter.name || offer.name.indexOf(filter.name) > -1);
                        });
                    },

                    updateItem: function (updatingOffer) {
                        updatingOffer['oper'] = 'edit';
                        console.log(updatingOffer);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/offer')}}",
                            data: updatingOffer,
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

                db.offer = [

                    @foreach($offer_obj as $index)
                    {
                        "id": 'ofr{{$index->id}}',
                        "name": '{{$index->name}}',
                        @if($index->status == 'Active')
                        "status": '<a id="offer{{$index->id}}" href="javascript: ChangeStatus(`offer`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="offer{{$index->id}}" href="javascript: ChangeStatus(`offer`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/offer/ofr'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/offer/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                    @endforeach
                ];

                $("#offer_grid").jsGrid({
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
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +Offer", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });
        })

    </script>

@endsection
