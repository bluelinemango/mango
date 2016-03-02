@extends('Layout1')
@section('siteTitle')List Of Company @endsection
@section('content')
    <div class="col-md-9">
        <div class="panel light-blue">
            <div class="panel-heading">
                <div class="panel-title"><h4>Company List</h4></div>
            </div><!--.panel-heading-->
            <div class="panel-body">
                <div id="jsGrid"></div>
            </div><!--.panel-body-->
        </div><!--.panel-->
    </div><!--.col-->
    <div class="col-md-3">
        <div class="panel indigo">
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



    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="name">Name:</label>
                <input id="name" name="name" type="text" />
            </div>
            <div class="details-form-field">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('FooterScripts')
<script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var db = {
                    loadData: function(filter) {
                        return $.grep(this.company, function(company) {
                            return (!filter.Name || company.Name.indexOf(filter.Name) > -1);
                        });
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
                            console.log(response);
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

                    },

                    updateItem: function(updatingCompany) {
                        updatingCompany['oper']='edit';
                        console.log(updatingCompany) ;
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/company')}}",
                            data: updatingCompany,
                            dataType: "json"
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

                $("#jsGrid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the company?",

                    controller: db,
                    fields: [
                        { name: "id",title: "ID", width: 20,align :"center" },
                        { name: "name",title: "Name", type: "text", width: 150 },
                        { name: "date_modify" ,title:"Date of Modify",align :"center"},
                        { name: "action", title: "Full Action", sorting: false,width: 50,align :"center" },
                        {
                            type: "control",
                            modeSwitchButton: false,
                            editButton: false,
                            headerTemplate: function() {
                                return $("<button>").attr("type", "button").text("Add")
                                        .on("click", function () {
                                            showDetailsDialog("Add Company", {});
                                        });
                            }
                        }
                    ]

                });


                $("#detailsDialog").dialog({
                    autoOpen: false,
                    width: 400,
                    close: function() {
                        $("#detailsForm").validate().resetForm();
                        $("#detailsForm").find(".error").removeClass("error");
                    }
                });

                $("#detailsForm").validate({
                    rules: {
                        name: "required"
                    },
                    messages: {
                        name: "Please enter name"
                    },
                    submitHandler: function() {
                        formSubmitHandler();
                    }
                });

                var formSubmitHandler = $.noop;

                var showDetailsDialog = function(dialogType, company) {

                    formSubmitHandler = function() {
                        saveCompany(company, dialogType === "Add");
                    };

                    $("#detailsDialog").dialog("option", "title", dialogType + " Company")
                            .dialog("open");
                };

                var saveCompany = function(company, isNew) {
                    $.extend(company, {
                        name: $("#name").val(),
                        age: parseInt($("#age").val(), 10),
                        Address: $("#address").val(),
                        Country: parseInt($("#country").val(), 10),
                        Married: $("#married").is(":checked")
                    });

                    $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", company);

                    $("#detailsDialog").dialog("close");
                };
            });
        });
    </script>

@endsection
