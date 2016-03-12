@extends('Layout1')
@section('siteTitle')Add Campaign @endsection
@section('headerCss')
    <link rel="stylesheet" href="{{cdn('newTheme/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}">
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client: cl{{$advertiser_obj->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser: adv{{$advertiser_obj->id}}</a>
        </li>
        <li><a href="#" class="active">Campaign Registration</a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Campaign Registration  </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate" action="{{URL::route('campaign_create')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="advertiser_id" value="{{$advertiser_obj->id}}"/>
                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{old('name')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$advertiser_obj->name}}</h5>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$advertiser_obj->GetClientID->name}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Domain Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="advertiser_domain_name"
                                                   class="form-control" placeholder="Domain Name" id="advertiser_domain_name"
                                                   value="{{old('advertiser_domain_name')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <div class="switcher">
                                        <input type="checkbox" name="active"
                                               hidden id="active">
                                        <label for="active"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!--.form-group-->
                        </div>
                        <hr/>
                        <div class="note note-info note-bottom-striped">
                            <h4>Budget Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Max Impression</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="max_impression"
                                                   placeholder="Max Impression"
                                                   id="max_impression"
                                                   class="form-control" value="{{old('max_impression')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">

                                <div class="form-group">
                                    <label class="control-label">Daily Max Impression</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="daily_max_impression"
                                                   placeholder="Daily Max Impression"
                                                   id="daily_max_impression"
                                                   class="form-control" value="{{old('daily_max_impression')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label">Max Budget</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">

                                            <input type="text" name="max_budget"
                                                   placeholder="Max Budget" class="form-control" id="max_budget" value="{{old('max_budget')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label">Daily Max Budget</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="daily_max_budget"
                                                   placeholder="Daily Max Budget" class="form-control" id="daily_max_budget" value="{{old('daily_max_budget')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label">cpm</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="cpm" placeholder="CPM" id="cpm"
                                                   class="form-control" value="{{old('cpm')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <hr/>
                        <div class="note note-warning note-bottom-striped">
                            <h4>Date Range</h4>

                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="add-on input-group-addon"><i class="ion-android-calendar"></i></span>
                                        <div class="inputer">
                                            <div class="input-wrapper">
                                                <input type="text" style="width: 200px" name="date_range" class="form-control bootstrap-daterangepicker-basic-range" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div style="padding: 15px">

                            <div class="form-group">
                                <label class="control-label">Description</label>

                                <div class="inputer">
                                    <div class="input-wrapper">
                                            <textarea name="description" class="form-control" rows="3"
                                                      placeholder="type minimum 5 characters"
                                                      required> {{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                                <button type="submit" class="btn btn-success" style="width:20%">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!--.panel-body-->
        </div>
        <!--.panel-->
    </div>
@endsection
@section('FooterScripts')

    <script src="{{cdn('newTheme/globals/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{cdn('newTheme/globals/scripts/forms-pickers.js')}}"></script>


    <!-- BEGIN INITIALIZATION-->
    <script>
        $(document).ready(function () {
            FormsPickers.init();
        });
    </script>
    <!-- END INITIALIZATION-->

    <script>
        $(document).ready(function () {
            var $orderForm = $("#order-form").validate({
                rules : {
                    name : {
                        required : true
                    },
                    advertiser_domain_name: {
                        required: true,
                        domain: true
                    },
                    advertiser_id : {
                        required : true
                    },
                    max_impression : {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    daily_max_impression : {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    max_budget : {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    daily_max_budget : {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    cpm : {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    start_date : {
                        required : true
                    },
                    end_date : {
                        required : true
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
                    interested : {
                        required : 'Please select interested service'
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
        })

    </script>


@endsection