@extends('Layout1')
@section('siteTitle')List Of Creative for {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection

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
                        <li><a href="#">Creative</a></li>
                        <li><a href="#" class="active">List</a></li>
                    </ol>
                </div><!--.col-->
            </div><!--.row-->
        </div><!--.page-header-->

        <!-- content -->
        <div class="col-md-9">
            <div class="panel light-blue">
                <div class="panel-heading">
                    <div class="panel-title"><h4>Creative List</h4></div>
                </div><!--.panel-heading-->
                <div class="panel-body">
                    <div id="creative_grid"></div>
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
                    url: "{{url('ajax/getAudit/creative')}}"
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
                url: "{{url('ajax/getAudit/creative')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $(function () {

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
                        @foreach($creative_obj as $index)
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
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_CREATIVE',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a> | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/clone/1')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

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
                        {name: "action", title: "Edit | +Creative | Clone", sorting: false, width: 100, align: "center"},
                        {type: "control"}
                    ]

                });

            });
        })

    </script>

@endsection
