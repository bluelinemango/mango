@extends('Layout1')
@section('siteTitle')Add Advertiser @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$client_obj->id.'/edit')}}">Client: cl{{$client_obj->id}}</a>
        </li>
        <li><a href="#" class="active">Advertiser Registration </a></li>
    </ol>
@endsection

@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Add Advertiser  </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('advertiser_create')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token"
                    <input type="hidden" name="client_id" value="{{$client_obj->id}}">
                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$client_obj->name}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Domain Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="domain_name"
                                                   class="form-control" placeholder="Domain Name"
                                                   id="domain_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="checkboxer">
                                        <input type="checkbox" name="active"
                                               class="switchery-teal">
                                        <label for="check1">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!--.form-group-->
                        </div>

                        <div style="padding: 15px">

                            <div class="form-group">
                                <label class="control-label">Description</label>

                                <div class="inputer">
                                    <div class="input-wrapper">
                                                    <textarea name="description" class="form-control" rows="3"placeholder="type minimum 5 characters"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                                <button type="submit" class="btn btn-success" style="width:20%">Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
    <!--.col-->



@endsection
@section('FooterScripts')
    <script>
        $(document).ready(function () {
            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    },
                    domain_name: {
                        required: true,
                        domain: true
                    }
                },

                // Messages for form validation
                messages : {
                    name : {
                        required : 'Please enter your name'
                    },
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    phone : {
                        required : 'Please enter your phone number'
                    },
                    client_id : {
                        required : 'Please select Client Name'
                    },
                    budget : {
                        required : 'Please select your budget'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
            FormsSwitchery.init();
        })
    </script>
@endsection