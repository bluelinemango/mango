@extends('Layout1')
@section('siteTitle')List Of Company @endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-body hexagon-bg">
                <div class="panel-title"><h4>Company List</h4></div>
                <div id="company_grid"></div>
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


    <div class="modal scale fade" id="defaultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailsForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Company</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row example-row">
                            <div class="col-md-3">Name</div>
                            <!--.col-md-3-->
                            <div class="col-md-9">
                                <div class="inputer">
                                    <div class="input-wrapper">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Company Name">
                                    </div>
                                </div>
                            </div>
                            <!--.col-md-9-->
                        </div>
                        <!--.row-->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="width:20%">Submit
                        </button>

                    </div>
                </form>
            </div>
            <!--.modal-content-->
        </div>
        <!--.modal-dialog-->
    </div><!--.modal-->
@endsection
@section('FooterScripts')
<script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            var db = {
                loadData: function(filter) {
                    var d = $.Deferred();
                    $.ajax({
                        type: "POST",
                        url: "{{url('/company/load-json-list')}}",
                        data: filter,
                        dataType: "json"
                    }).success(function(result) {
                        result = $.grep(result, function(item) {
                            return (!filter.name || item.name.toLowerCase().indexOf(filter.name.toLowerCase()) > -1)
                                    && (!filter.id || item.id == filter.id );
                        });
                        d.resolve(result);
                    });
                    return d.promise();
                },

                insertItem: function(insertingCompany) {
                    insertingCompany['oper']='add';
                    console.log(insertingCompany);
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/company')}}",
                        data: insertingCompany,
                        dataType: "json"
                    }).done(function (response) {
                        $("#company_grid").jsGrid("render");
                        console.log(response);
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/company')}}"
                            }).success(function (response) {
                                $('#show_audit').html(response);
                            });

                        } else if (response.success == false) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'error', '', '', response.msg);
                        }
                    });

                },

                updateItem: function (updatingCompany) {
                    updatingCompany['oper'] = 'edit';
                    $.ajax({
                        type: "PUT",
                        url: "{{url('/ajax/jqgrid/company')}}",
                        data: updatingCompany,
                        dataType: "json"
                    }).done(function(response){
                        $("#company_grid").jsGrid("render");
                        console.log(response);
                        if (response.success == true) {
                            Pleasure.handleToastrSettings('true', "toast-top-full-width", '', 'success', '', '', response.msg);
                            $.ajax({
                                url: "{{url('ajax/getAudit/company')}}"
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

            db.company = [
                @foreach($company as $index)
                {
                    "id" : '{{$index->id}}',
                    "name" : '{{$index->name}}',
                    "date_modify" : '{{$index->updated_at}}',
                    "action": '<a class="btn btn-info" href="{{url('/company/'.$index->id.'/edit')}}"><i class="fa fa-edit "></i></a>'

                },
                @endforeach
            ];

            $("#company_grid").jsGrid({
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
                    { name: "id",title: "ID", width: 20,align :"center" },
                    { name: "name",title: "Name", type: "text", width: 150 },
                    { name: "updated_at" ,title:"Date of Modify",align :"center"},
                    { name: "action", title: "Full Action", sorting: false,width: 50,align :"center" },
                    {
                        type: "control",
                        deleteButton: false,
                        editButtonTooltip: "Edit",
                        editButton: true,
                        modeSwitchButton: false,
                        headerTemplate: function() {
                            return $("<button>").attr("type", "button").text("Add")
                                    .on("click", function () {
                                        showDetailsDialog("Add", {});
                                    });
                        }
                    }
                ]

            });



            $("#detailsForm").validate({
                rules: {
                    name: "required"
                },
                messages: {
                    name: "Please enter name"
                },
                submitHandler: function (e) {
                    formSubmitHandler();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function (dialogType, company) {

                formSubmitHandler = function () {
                    saveCompany(company, dialogType === "Add");
                };
                $('#defaultModal').modal('show');
            };

            var saveCompany = function (company, isNew) {
                $.extend(company, {
                    name: $("#name").val()
                });
                $("#name").val('');
                $("#company_grid").jsGrid(isNew ? "insertItem" : "updateItem", company);
                $('#defaultModal').modal('hide');
            };
        });

    </script>

    <script type="text/javascript">
        $('#audit_status').change(function () {
            if ($(this).val() == 'entity') {
                $.ajax({
                    url: "{{url('ajax/getAudit/geosegment')}}"
                }).success(function (response) {
                    $('#show_audit').html(response);
                });
            }
        });

        $(document).ready(function() {
            $.ajax({
                url: "{{url('ajax/getAudit/company')}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

        });
    </script>

@endsection
