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
        $(document).ready(function () {

            $(function () {

                $.ajax({
                    url: "{{url('ajax/getAudit/advertiser')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
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
                            url: "{{url('ajax/getAudit/advertiser')}}"
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

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.advertiser, function (advertiser) {
                            return (!filter.name || advertiser.name.indexOf(filter.name) > -1);
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
                            console.log(response);
                            if (response.success == true) {
                                var title = "Success";
                                var color = "#739E73";
                                var icon = "fa fa-check";
                            } else if (response.success == false) {
                                var title = "Warning";
                                var color = "#C46A69";
                                var icon = "fa fa-bell";
                            }
                            ;

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
                        "status": '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="advertiser{{$index->id}}" href="javascript: ChangeStatus(`advertiser`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
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

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", autosearch: true, type: "text", width: 70},
                        {name: "campaign", title: "# of CMP.", width: 50, align: "center"},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit", sorting: false, width: 50, align: "center"},
                        {type: "control"}
                    ]

                });

            });
        });
    </script>
@endsection
