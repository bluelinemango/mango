@extends('Layout1')
@section('siteTitle')List Of Users @endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>List Of Users</h4></div>
                <div id="user_grid"></div>
            </div><!--.panel-body-->
        </div><!--.panel-->
    </div><!--.col-->
    <div class="col-md-3">
        <div class="panel gray">
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


@endsection
@section('FooterScripts')
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('ajax/getAudit/user')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
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
                        url: "{{url('ajax/getAudit/user')}}"
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

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.user, function (user) {
                            return (!filter.name || user.name.indexOf(filter.name) > -1)
                                    && (!filter.role || user.role.indexOf(filter.role) > -1)
                                    && (!filter.id || user.id.indexOf(filter.id) > -1);
                        });
                    },

                    updateItem: function (updatingUser) {
                        updatingUser['oper'] = 'edit';
                        console.log(updatingUser);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/user')}}",
                            data: updatingUser,
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

                db.user = [
                    @foreach($user_obj as $index)
                    {
                        "id": 'usr{{$index->id}}',
                        "name": '{{$index->name}}',
                        "role": '{{$index->getRole->name}}',
                        @if($index->status == 'Active')
                        "status": '<a id="user{{$index->id}}" href="javascript: ChangeStatus(`user`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="user{{$index->id}}" href="javascript: ChangeStatus(`user`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a href="{{url('user/usr'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>'

                    },
                    @endforeach
                ];

                $("#user_grid").jsGrid({
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
                        {name: "role", title: "Role", type: "text", width: 70,editing:false},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +User", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });

        })
    </script>
@endsection