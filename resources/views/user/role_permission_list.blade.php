@extends('Layout1')
@section('siteTitle')List Of Role Permission @endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>List Of Role Permission</h4></div>
                <div id="role_grid"></div>
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
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.user, function (user) {
                            return (!filter.name || user.name.indexOf(filter.name) > -1)
                                    && (!filter.id || user.id.indexOf(filter.id) > -1);
                        });
                    }

                };

                window.db = db;

                db.user = [
                    @foreach($role_obj as $index)
                    {
                        "id": 'usr{{$index->id}}',
                        "name": '{{$index->name}}',
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a href="{{url('/user/assign-permission/edit/'.$index->id)}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>'

                    },
                    @endforeach
                ];

                $("#role_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: false,
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
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit | +User", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });
        })
    </script>
@endsection