@extends('Layout1')
@section('siteTitle')Add Bid Profile @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client: cl{{$advertiser_obj->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser: adv{{$advertiser_obj->id}}</a>
        </li>
        <li><a href="#" class="active">Bid Profile Registration</a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Bid Profile Registration </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('bidProfile_create')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="advertiser_id" value="{{$advertiser_obj->id}}">
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

                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$advertiser_obj->name}}</h5>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$advertiser_obj->GetClientID->name}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <!--.form-group-->
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


@endsection
@section('FooterScripts')
    <script type="text/javascript">
        $(document).ready(function() {

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