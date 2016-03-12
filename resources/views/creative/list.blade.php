@extends('Layout1')
@section('siteTitle')List Of Creative for {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Creative List</h4></div>
                <div id="creative_grid"></div>
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
                    url: "{{url('ajax/getAudit/creative')}}"
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
                url: "{{url('ajax/getAudit/creative')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.creative, function (creative) {
                            return (!filter.name || creative.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.size || creative.size.indexOf(filter.size) > -1)
                                    && (!filter.advertiser || creative.advertiser.toLowerCase().indexOf(filter.advertiser.toLowerCase()) > -1)
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
                            $("#creative_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                                $.ajax({
                                    url: "{{url('ajax/getAudit/creative')}}"
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

                db.creative = [
                    @foreach($creative_obj as $index)
                    {
                        "id": 'crt{{$index->id}}',
                        "name": '{{$index->name}}',
                        "size": '{{$index->size}}',
                        "advertiser": '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="creative{{$index->id}}" onchange="ChangeStatus(`creative`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="creative{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="creative{{$index->id}}" onchange="ChangeStatus(`creative`,`{{$index->id}}`)" type="checkbox" hidden><label for="creative{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_CREATIVE',$permission)) + '| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a> | <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/creative/crt'.$index->id.'/clone/1')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif


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

                    pageSize: 10,
                    pageButtonCount: 5,

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", width: 40, type: "text", align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {name: "size", title: "Size", type: "text", width: 50, align: "center", editing: false},
                        {
                            name: "advertiser",
                            title: "Advertiser",
                            type: "text",
                            width: 70,
                            align: "center",
                            editing: false
                        },
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {
                            name: "action",
                            title: "Edit | +Creative | Clone",
                            sorting: false,
                            width: 100,
                            align: "center"
                        },
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
