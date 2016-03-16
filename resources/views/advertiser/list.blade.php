@extends('Layout1')
@section('siteTitle')List Of Advertiser for {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Advertiser List</h4></div>
                <div id="advertiser_grid"></div>
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

        $(function () {

            var db = {

                loadData: function (filter) {
                    return $.grep(this.advertiser, function (advertiser) {
                        return (!filter.name || advertiser.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                &&(!filter.id || advertiser.id.toLowerCase().indexOf(filter.id.toLowerCase()) > -1) ;
                    });
                },

                updateItem: function (updatingAdvertiser) {
                    updatingAdvertiser['oper'] = 'edit';
                    console.log(updatingAdvertiser);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/advertiser')}}",
                        data: updatingAdvertiser,
                        dataType: "json"
                    }).done(function (response) {
                        $("#advertiser_grid").jsGrid("refresh");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/advertiser')}}"
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

            db.advertiser = [

                @foreach($adver_obj as $index)
                {
                    "id": 'adv{{$index->id}}',
                    "name": '{{$index->name}}',
                    @if(count($index->Campaign)>0)
                    "campaign": '{{$index->Campaign[0]->advertiser_count}} ',
                    @else
                    "campaign": '0',
                    @endif
                    @if($index->status == 'Active')
                    "status": '<div class="switcher"><input id="advertiser{{$index->id}}" onchange="ChangeStatus(`advertiser`,`{{$index->id}}`)" type="checkbox" checked hidden><label for="advertiser{{$index->id}}"></label></div>',
                    @elseif($index->status == 'Inactive')
                    "status": '<div class="switcher"><input id="advertiser{{$index->id}}" onchange="ChangeStatus(`advertiser`,`{{$index->id}}`)" type="checkbox" hidden><label for="advertiser{{$index->id}}"></label></div>',
                    @endif
                    "date_modify": '{{$index->updated_at}}',
                    "action": '<a class="btn " href="{{url('/client/cl'.$index->GetClientID->id.'/advertiser/adv'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /> </a>'

                },
                @endforeach
            ];

            $("#advertiser_grid").jsGrid({
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
                    {name: "name", title: "Name", autosearch: true, type: "text", width: 70},
                    {name: "campaign", title: "# of CMP.", width: 50, align: "center"},
                    {name: "status", title: "Status", width: 50, align: "center",editing: false},
                    {name: "date_modify", title: "Last Modified", align: "center"},
                    {name: "action", title: "Edit", sorting: false, width: 50, align: "center"},
                    {type: "control",
                        deleteButton: false,
                        editButtonTooltip: "Edit",
                        editButton: true
                    }
                ]

            });

        });

        $(document).ready(function () {
            $.ajax({
                url: "{{url('ajax/getAudit/advertiser')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

        });
        $('#audit_status').change(function () {
            if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/advertiser')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }
        });

    </script>
@endsection
