@extends('Layout1')
@section('siteTitle')Edit Offer: {{$offer_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$offer_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client:
                cl{{$offer_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$offer_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$offer_obj->advertiser_id.'/edit')}}">Advertiser:
                adv{{$offer_obj->advertiser_id}}</a>
        </li>
        <li><a href="#" class="active">Offer: ofr{{$offer_obj->id}}</a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Edit Offer: {{$offer_obj->name}} </h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('offer_update')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="offer_id" value="{{$offer_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control" value="{{$offer_obj->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Status</label>

                                    <div class="switcher">
                                        <input type="checkbox" name="active"
                                               hidden @if($offer_obj->status=='Active')
                                               checked @endif id="active">
                                        <label for="active"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label" for="">Advertiser Name</label>
                                <h5>{{$offer_obj->getAdvertiser->name}}</h5>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="">Client Name</label>
                                <h5>{{$offer_obj->getAdvertiser->GetClientID->name}}</h5>

                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="">Last Modified</label>
                                <h5>{{$offer_obj->updated_at}}</h5>

                            </div>
                            <div class="clearfix"></div>
                            <!--.form-group-->
                        </div>
                        <hr/>
                        <div class="note note-warning note-bottom-striped">
                            <h4>List Of Pixels</h4>

                            <div class="col-xs-5">
                                <select name="from_pixel[]" id="assign_pixel" class="form-control" size="8"
                                        multiple="multiple">
                                    @foreach($pixel_obj as $index)
                                        <option value="{{$index->id}}">{{$index->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="assign_model_rightAll" class="btn btn-block"><i
                                            class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="assign_pixel_rightSelected" class="btn btn-block"><i
                                            class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="assign_pixel_leftSelected" class="btn btn-block"><i
                                            class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="assign_pixel_leftAll" class="btn btn-block"><i
                                            class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <select name="to_pixel[]" id="assign_pixel_to" class="form-control" size="8"
                                        multiple="multiple">
                                    @foreach($pixel_obj as $index)
                                        @if(in_array($index->id,$offer_pixel))
                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <hr/>
                        <div style="padding: 15px">

                            <div class="form-group">
                                <label class="control-label">Description</label>

                                <div class="inputer">
                                    <div class="input-wrapper">
                                                    <textarea name="description" class="form-control" rows="3"
                                                              placeholder="type minimum 5 characters"
                                                              >{{$offer_obj->description}}</textarea>
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
    <div class="clearfix"></div>
@endsection
@section('FooterScripts')

    <script src="{{cdn('js/multi_select/multiselect.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('#assign_pixel').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />'
                }
            });


            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });

            $.ajax({
                url: "{{url('ajax/getAudit/offer/'.$offer_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/offer/'.$offer_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });


        });


    </script>
@endsection