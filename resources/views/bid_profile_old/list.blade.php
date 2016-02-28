@extends('Layout')
@section('siteTitle')List Of Bid Profile for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Bid Profile List</li>
            </ol>
            <!-- end breadcrumb -->

        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">
            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    <!-- NEW WIDGET START -->
                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                <!-- Widget ID (each widget will need unique ID)-->
                                <div class="well">
                                    <header>
                                        <h2>Bid Profile List</h2>
                                    </header>
                                    <!-- widget div-->
                                    <div>
                                        <!-- widget content -->
                                        <div class=" ">


                                            <!-- widget grid -->
                                            <section id="widget-grid" class="">

                                                <!-- row -->
                                                <div class="row">

                                                    <!-- NEW WIDGET START -->
                                                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                                                        <div id="bid_profile_grid"></div>
                                                        {{--<table id="jqgrid"></table>--}}
                                                        {{--<div id="pjqgrid"></div>--}}

                                                    </div>
                                                    <!-- WIDGET END -->
                                                    <div class="col-md-3">
                                                        <div class="card">
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

                                                </div>
                                                <!-- end row -->
                                            </section>
                                            <!-- end widget grid -->


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
        $(document).ready(function() {
            pageSetUp();

            $.ajax({
                url: "{{url('ajax/getAudit/bid_profile')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });
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

                    @foreach($bid_profile_obj as $index)
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



            $('#audit_status').change(function () {
                if($(this).val()=='all'){
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }else if($(this).val()=='entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/bid_profile')}}"
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

        })

    </script>

@endsection
