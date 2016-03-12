@extends('Layout1')
@section('siteTitle')List Of Geo Segment for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Geo Segment List</h4></div>
                <div id="geosegment_grid"></div>
            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div><!--.col-->
    <div class="col-md-3">
        <div class="panel gray">
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
            <div class="panel-body" style="padding: 0 0 0 10px;">
                <div class="timeline single" id="show_audit">
                </div>
                <!--.timeline-->
            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
    <!--.col-->

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
            if ($(this).val() == 'all') {
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            } else if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/geosegment')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            } else if ($(this).val() == 'user') {
                $.ajax({
                    url: "{{url('ajax/getAudit/user')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }
        });

        $(document).ready(function () {
            $.ajax({
                url: "{{url('ajax/getAudit/geosegment')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });
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
                                $.ajax({
                                    url: "{{url('ajax/getAudit/geosegment')}}"
                                }).success(function (response) {
                                    $('#show_audit').html(response);
                                });
                            } else if (response.success == false) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                            }
                        });
                    }

                };

                window.db = db;

                db.geosegment = [

                    @foreach($geosegment_obj as $index)
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
        })
    </script>

@endsection
