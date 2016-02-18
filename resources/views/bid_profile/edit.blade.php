@extends('Layout')
@section('siteTitle')Edit Bid Profile: {{$bid_profile_obj->name}} @endsection
@section('header_extra')
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/your_style.css')}}">
@endsection

@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{{url('/client/cl'.$bid_profile_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client : cl{{$bid_profile_obj->getAdvertiser->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$bid_profile_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$bid_profile_obj->advertiser_id.'/edit/')}}">Advertiser : adv{{$bid_profile_obj->getAdvertiser->id}}</a></li>
                <li>Bid Profile Editing : bpf{{$bid_profile_obj->id}}</li>
            </ol>
            <!-- end breadcrumb -->


        </div>
        <!-- END RIBBON -->
        <!-- MAIN CONTENT -->
        <div id="content">
            @if(Session::has('CaptchaError'))
                <ul>
                    <li>{{Session::get('CaptchaError')}}</li>
                </ul>
                @endif
                        <!-- widget grid -->
                <section id="widget-grid" class="">
                    <!-- START ROW -->
                    <div class="row">
                        <!-- NEW COL START -->
                        <article class="col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well" >
                                <header>
                                    <h2>Bid Profile edit: {{$bid_profile_obj->name}} </h2>

                                </header>

                                <!-- widget div-->
                                <div class="row">
                                    <!-- widget content -->
                                    <div class="col-md-9">

                                        <form id="order-form" class="smart-form" action="{{URL::route('bidProfile_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="bidProfile_id" value="{{$bid_profile_obj->id}}"/>
                                            <header>
                                                General Information
                                            </header>

                                            <div class="well col-md-12">
                                            <fieldset>
                                                <section class="col col-3">
                                                    <label class="label" for=""> Name</label>
                                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                                        <input type="text" name="name" placeholder="Name" value="{{$bid_profile_obj->name}}">
                                                    </label>
                                                </section>
                                                <section class="col col-3">
                                                    <label for="" class="label">status</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="active" @if($bid_profile_obj->status=='Active') checked @endif>
                                                        <i></i>
                                                    </label>
                                                </section>
                                                <section class="col col-3">
                                                    <label class="label" for=""> Advertiser Name</label>
                                                    <label class="input">
                                                        <h6>{{$bid_profile_obj->getAdvertiser->name}}</h6>
                                                    </label>
                                                </section>
                                                <section class="col col-3">
                                                    <label class="label" for=""> Client Name</label>
                                                    <label class="input">
                                                        <h6>{{$bid_profile_obj->getAdvertiser->GetClientID->name}}</h6>
                                                    </label>
                                                </section>

                                            </fieldset>
                                            </div>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--ujarak button--border-thick button--text-upper button--size-s button--inverted button--text-thick">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-heading">
                                                <h2 class="pull-left">Activities</h2>
                                                <select id="audit_status" class="pull-right">
                                                    <option value="entity">This Entity</option>
                                                    <option value="all">All</option>
                                                    <option value="user">User</option>
                                                </select>
                                                <div class="clearfix"></div>
                                                <small>All Activities for this Entity </small>
                                            </div>
                                            <div class="card-body" >
                                                <div class="streamline b-l b-accent m-b" id="show_audit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- WIDGET END -->

                                    </div>

                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                            </div>
                            <!-- end widget -->

                        </article>
                        <!-- END COL -->
                    </div>
                    <!-- END ROW -->
                </section>
                <!-- end widget grid -->
                <!-- widget grid -->
                <section id="widget-grid" class="">

                    <!-- row -->
                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                            <div id="bid_profile_entry_grid"></div>
                        </article>
                        <!-- WIDGET END -->

                    </div>

                    <!-- end row -->

                </section>
                <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->

    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="domain">Domain:</label>
                <input id="domain" name="domain" type="text" />
            </div>
            <div class="details-form-field">
                <label for="bid_value">Bid Strategy:</label>
                <select name="bid_strategy" id="bid_strategy">
                    <option value="Absolute">Absolute</option>
                    <option value="Percentage">Percentage</option>
                </select>
            </div>
            <div class="details-form-field">
                <label for="bid_value">Bid Value:</label>
                <input id="bid_value" name="bid_value" type="text" />

            </div>
            <div class="details-form-field">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>

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
            pageSetUp();


//            $.ajax({
                {{--url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"--}}
//            }).success(function (response) {
//                $('#show_audit').html(response);
//            });

            $('#audit_status').change(function () {
                if($(this).val()=='all'){
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }else if($(this).val()=='entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/bid_profile/'.$bid_profile_obj->id)}}"
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
                        return $.grep(this.bid_profile, function (bid_profile) {
                            return (!filter.domain || bid_profile.domain.indexOf(filter.domain) > -1)
                                    && (!filter.bid_strategy || bid_profile.bid_strategy === filter.bid_strategy)
                                    && (!filter.id || bid_profile.id.indexOf(filter.id) > -1);
                        });
                    },

                    insertItem: function(insertingBidProfile) {
                        console.log(insertingBidProfile);
                        insertingBidProfile['oper']='add';
                        insertingBidProfile['parent_id']='{{$bid_profile_obj->id}}';
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/bid-profile-entry')}}",
                            data: insertingBidProfile,
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
                            }
                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });

                    },

                    updateItem: function (updatingBidProfile) {
                        updatingBidProfile['oper'] = 'edit';
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/bid-profile-entry')}}",
                            data: updatingBidProfile,
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
                db.strategy = [
                    { Name: "", Id: 0 },
                    { Name: "Absolute", Id: 1 },
                    { Name: "Percentage", Id: 2 }
                ];
                db.bid_profile = [

                    @foreach($bid_profile_obj->getEntries as $index)
                    {
                        "id": 'bpe{{$index->id}}',
                        "parent_id": '{{$bid_profile_obj->id}}',
                        "domain": '{{$index->domain}}',
                        "bid_strategy": {{($index->bid_strategy=='Absolute')? 1 : 2}},
                        "bid_value": '{{$index->bid_value}}',
                        "domain": '{{$index->domain}}',
                        "date_modify": '{{$index->updated_at}}'
                    },
                    @endforeach
                ];

                $("#bid_profile_entry_grid").jsGrid({
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
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "parent_id", title: "Bid ID", type: "text", width: 40, align: "center",editing:false,visible: false},
                        {name: "domain", title: "Domain", type: "text", width: 70},
                        {name: "bid_strategy", title: "Bid Strategy", type: "select", items: db.strategy , valueField: "Id", textField: "Name",width: 60, align: "center"},
                        {name: "bid_value", title: "Bid Value", type: "text", width: 40, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {
                            type: "control",
                            modeSwitchButton: false,
                            editButton: false,
                            headerTemplate: function() {
                                return $("<button>").attr("type", "button").text("Add")
                                        .on("click", function () {
                                            showDetailsDialog("Add", {});
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
                        domain: "required"
                    },
                    messages: {
                        domain: "Please enter name"
                    },
                    submitHandler: function() {
                        formSubmitHandler();
                    }
                });

                var formSubmitHandler = $.noop;

                var showDetailsDialog = function(dialogType, bid_profile_entry) {

                    formSubmitHandler = function() {
                        saveClient(bid_profile_entry, dialogType === "Add");
                    };

                    $("#detailsDialog").dialog("option", "title", dialogType + " Bid Profile Entry")
                            .dialog("open");
                };

                var saveClient = function(bid_profile_entry, isNew) {
                    $.extend(bid_profile_entry, {
                        domain: $("#domain").val(),
                        bid_strategy: $("#bid_strategy").val(),
                        bid_value: $("#bid_value").val()
                    });

                    $("#bid_profile_entry_grid").jsGrid(isNew ? "insertItem" : "updateItem", bid_profile_entry);

                    $("#detailsDialog").dialog("close");
                };

            });



            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    }
                },

                // Messages for form validation
                messages : {
                    name : {
                        required : 'Please enter your name'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });



        })

    </script>

@endsection