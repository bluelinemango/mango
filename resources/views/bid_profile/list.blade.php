@extends('Layout1')
@section('siteTitle')List Of Bid Profile for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Bid Profile List</h4></div>
                <div id="bid_profile_grid"></div>
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
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('ajax/getAudit/bid_profile')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.bid_profile, function (bid_profile) {
                            return (!filter.name || bid_profile.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    &&(!filter.advertiser_name || bid_profile.advertiser_name.toLowerCase().indexOf(filter.advertiser_name.toLowerCase()) > -1)
                                    && (!filter.entry || bid_profile.entry.indexOf(filter.entry) > -1)
                                    && (!filter.id || bid_profile.id.toLowerCase().indexOf(filter.id.toLowerCase()) > -1);
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
                            $("#bid_profile_grid").jsGrid("refresh");
                            if (response.success == true) {
                                Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                                $.ajax({
                                    url: "{{url('ajax/getAudit/bid_profile')}}"
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

                db.bid_profile = [

                    @foreach($bid_profile_obj as $index)
                    {
                        "id": 'bpf{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser_name": '<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                        @if(count($index->getEntries)>0)
                        "entry": '{{$index->getEntries[0]->bid_profile_count}}',
                        @else
                        "entry": '0',
                        @endif
                        @if($index->status == 'Active')
                        "status": '<div class="switcher"><input id="bid_profile{{$index->id}}" onchange="ChangeStatus(`bid_profile`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="bid_profile{{$index->id}}"></label></div>',
                        @elseif($index->status == 'Inactive')
                        "status": '<div class="switcher"><input id="bid_profile{{$index->id}}" onchange="ChangeStatus(`bid_profile`,`{{$index->id}}`)" type="checkbox" hidden><label for="bid_profile{{$index->id}}"></label></div>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bid-profile/bpf'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) + '| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/bid-profile/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif


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
                        {name: "entry", title: "#Entery", type: "text", width: 40, align: "center", editing: false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +BidProfile", sorting: false, width: 60, align: "center"},
                        {type: "control",
                            deleteButton: false,
                            editButtonTooltip: "Edit",
                            editButton: true
                        }
                    ]

                });

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
                        url: "{{url('ajax/getAudit/bid_profile')}}"
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

        })

    </script>

@endsection
