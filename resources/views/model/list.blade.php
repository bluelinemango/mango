@extends('Layout1')
@section('siteTitle')List Of Model for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <!--.panel-heading-->
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Model List</h4></div>
                <div id="model_grid"></div>
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
            if($(this).val()=='all'){
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }else if($(this).val()=='entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/modelTable')}}"
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
                url: "{{url('ajax/getAudit/model')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });
        });

        $(function () {

            var db = {

                loadData: function (filter) {
                    return $.grep(this.model, function (model) {
                        return (!filter.name || model.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                && (!filter.id || model.id.indexOf(filter.id) > -1)
                                && (!filter.algo || model.algo.toLowerCase().indexOf(filter.algo.toLowerCase()) > -1)
                                && (!filter.advertiser || model.advertiser.toLowerCase().indexOf(filter.advertiser.toLowerCase()) > -1);
                    });
                },

                updateItem: function (updatingModel) {
                    updatingModel['oper'] = 'edit';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/model')}}",
                        data: updatingModel,
                        dataType: "json"
                    }).done(function (response) {
                        $("#model_grid").jsGrid("refresh");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/model')}}"
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

            db.model = [
                @foreach($model_obj as $index)
                {
                    "id": 'mdl{{$index->id}}',
                    "name": '{{$index->name}}',
                    "algo":'{{$index->algo}}',
                    "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                    "date_modify":'{{$index->updated_at}}',
                    "action": '<a class="btn" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/model/mdl'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_MODEL',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/model/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                @endforeach
            ];

            $("#model_grid").jsGrid({
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
                    {name: "id", title: "ID", width: 40,editing:false,type: "text", align: "center"},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "algo", title: "Algoritm",editing:false,type: "text", width: 50, align: "center"},
                    {name: "advertiser", title: "Advertiser",editing:false,type: "text", width: 70, align: "center"},
                    {name: "date_modify", title: "Last Modified", align: "center"},
                    {name: "action", title: "Edit | +Model", sorting: false, width: 80, align: "center"},
                    {type: "control",
                        deleteButton: false,
                        editButtonTooltip: "Edit",
                        editButton: true
                    }
                ]

            });

        });

    </script>

@endsection
