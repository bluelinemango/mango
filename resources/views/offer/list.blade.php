@extends('Layout1')
@section('siteTitle')List Of Offer for {{\Illuminate\Support\Facades\Auth::user()->name}} @endsection

@section('content')
<div class="col-md-9">
    <div class="panel gray">
        <div class="panel-body hexagon-bg">
            <div class="panel-title"><h4>Offer List</h4></div>
            <div id="offer_grid"></div>
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

        $('#audit_status').change(function () {
            if($(this).val()=='all'){
                $.ajax({
                    url: "{{url('ajax/getAllAudits')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }else if($(this).val()=='entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/offer')}}"
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
                url: "{{url('ajax/getAudit/offer')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

        });
        $(function () {

            var db = {

                loadData: function (filter) {
                    return $.grep(this.offer, function (offer) {
                        return (!filter.name || offer.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                        &&(!filter.id || offer.id.toLowerCase().indexOf(filter.id.toLowerCase()) > -1);
                    });
                },

                updateItem: function (updatingOffer) {
                    updatingOffer['oper'] = 'edit';
                    console.log(updatingOffer);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/offer')}}",
                        data: updatingOffer,
                        dataType: "json"
                    }).done(function (response) {
                        $("#offer_grid").jsGrid("refresh");
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/offer')}}"
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

            db.offer = [

                @foreach($offer_obj as $index)
                {
                    "id": 'ofr{{$index->id}}',
                    "name": '{{$index->name}}',
                    @if($index->status == 'Active')
                    "status": '<input id="offer{{$index->id}}" onchange="ChangeStatus(`offer`,`{{$index->id}}`)" type="checkbox" class="switchery-teal" checked>',
                    @elseif($index->status == 'Inactive')
                    "status": '<input id="offer{{$index->id}}" onchange="ChangeStatus(`offer`,`{{$index->id}}`)" type="checkbox" class="switchery-teal">',
                    @endif
                    "date_modify": '{{$index->updated_at}}',
                    "action": '<a class="btn " href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/offer/ofr'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_OFFER',$permission)) +'| <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/offer/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif

                    },
                @endforeach
            ];

            $("#offer_grid").jsGrid({
                width: "100%",
                filtering: true,
                editing: true,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 10,
                pageButtonCount: 5,
                rowClick:function(item){console.log(item)},
                onRefreshed: function(args) {FormsSwitchery.init();},
                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "status", title: "Status", width: 50, align: "center"},
                    {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                    {name: "action", title: "Edit | +Offer", sorting: false, width: 70, align: "center"},
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
