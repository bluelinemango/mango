@extends('Layout1')
@section('siteTitle')List Of Segment for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Segment List</h4></div>
                <div id="segment_grid"></div>
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
        $(document).ready(function() {
            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.segment, function (segment) {
                            return (!filter.name || segment.name.indexOf(filter.name) > -1)
                                    && (!filter.daily_max_imp || segment.daily_max_imp.indexOf(filter.daily_max_imp) > -1)
                                    && (!filter.cpm || segment.cpm.indexOf(filter.cpm) > -1)
                                    && (!filter.id || segment.id.indexOf(filter.id) > -1)
                                    && (!filter.daily_max_budget || segment.daily_max_budget.indexOf(filter.daily_max_budget) > -1);
                        });
                    }
                };

                window.db = db;

                db.segment = [
                    @foreach($segment_obj as $index)
                    {
                        "id": 'sgt{{$index->id}}',
                        "name": '{{$index->name}}',
                        "advertiser": '{{$index->getAdvertiser->name}}',
                        "model": '{{$index->getModel->name}}',
                        "date_modify": '{{$index->updated_at}}'
                    },
                    @endforeach
                ];

                $("#segment_grid").jsGrid({
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
                        {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center"},
                        {name: "model", title: "Model", type: "text", width: 60, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
                    ]

                });

            });
        });

    </script>

@endsection
