@extends('Layout')
@section('siteTitle')Edit Client: {{$client_obj->name}} @endsection
@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <span class="ribbon-button-alignment">
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                    <i class="fa fa-refresh"></i>
                </span>
            </span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
               <li>Client : {{$client_obj->name}}</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:
                        <span class="ribbon-button-alignment pull-right">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
            </span>

 -->

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

                            <!-- Widget ID ()-->
                            <div class="well" >
                                <header>
                                    <h2>Edit Client #: cl{{$client_obj->id}} </h2>
                                </header>

                                <!-- widget div-->
                                <div class="row">

                                    <!-- widget content -->
                                    <div class="col-md-9">

                                        <form id="order-form" class="smart-form" action="{{URL::route('client_update')}}" method="post" novalidate="novalidate" >

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="client_id" value="{{$client_obj->id}}"/>
                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-6">
                                                        <label class="label" for="">Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$client_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-6">
                                                        <label class="label" for="">Company</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="company" placeholder="Company" value="{{$client_obj->company}}">
                                                        </label>
                                                    </section>
                                                </div>

                                                <div class="row">
                                                    <section class="col col-6">
                                                        <label class="label" for="">Email</label>
                                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                                            <input type="email" name="email" placeholder="E-mail">
                                                        </label>
                                                    </section>
                                                    <section class="col col-6">
                                                        <label class="label" for="">phone</label>
                                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                                            <input type="tel" name="phone" placeholder="Phone" data-mask="(999) 999-9999">
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>

                                            <footer>
                                                <button type="submit"
                                                        class=" button button--ujarak button--border-thick button--text-upper button--size-s button--inverted button--text-thick">
                                                    Save
                                                </button>
                                                @if(in_array('ADD_EDIT_ADVERTISER',$permission))
                                                <a href="{{url('client/cl'.$client_obj->id.'/advertiser/add')}}" class="btn btn-primary pull-left">
                                                    ADD Advertiser
                                                </a>
                                                @endif
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

                    <!-- row -->
                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well col-md-9" >

                                <header>
                                    <h2>List Of Advertiser </h2>
                                </header>

                                <!-- widget div-->
                                <div>


                                    <!-- widget content -->
                                    <div class="">

                                        <div id="advertiser_grid"></div>


                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->


                        </article>
                        <!-- WIDGET END -->


                    </div>

                    <!-- end row -->

                    <!-- end row -->

                </section>
                <!-- end widget grid -->


        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->



@endsection
@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            pageSetUp();

            $.ajax({
                url: "{{url('ajax/getAudit/client/'.$client_obj->id)}}"
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
                        url: "{{url('ajax/getAudit/client/'.$client_obj->id)}}"
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

                db.advertiser = [

                    @foreach($client_obj->getAdvertiser as $index)
                    {
                        "id": 'adv{{$index->id}}',
                        "name": '{{$index->name}}',
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

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                        {name: "name", title: "Name",autosearch: true, type: "text", width: 70},
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", align: "center"},
                        {name: "action", title: "Edit", sorting: false, width: 50, align: "center"},
                        {type: "control"}
                    ]

                });

            });






            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    }
//                    email : {
//                        required : true,
//                        email : true
//                    },
//                    phone : {
//                        required : true
//                    },
//                    interested : {
//                        required : true
//                    },
//                    budget : {
//                        required : true
//                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    interested: {
                        required: 'Please select interested service'
                    },
                    budget: {
                        required: 'Please select your budget'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        });
        /* END BASIC */

    </script>
@endsection