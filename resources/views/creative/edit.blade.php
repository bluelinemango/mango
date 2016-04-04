@extends('Layout1')
@section('siteTitle')Edit Creative: {{$creative_obj->name}} @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$creative_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client :
                cl{{$creative_obj->getAdvertiser->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$creative_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$creative_obj->advertiser_id.'/edit/')}}">Advertiser
                : adv{{$creative_obj->getAdvertiser->id}}</a>
        </li>
        @if($clone==1)
            <li><a href="#" class="active">Add Creative</a></li>
        @else
            <li><a href="#" class="active">Creative: crt{{$creative_obj->id}}</a></li>
        @endif
    </ol>
@endsection

@section('content')

<div class="col-md-9">
    <div class="panel gray">
        <div class="panel-heading with-gap">
            <div class="panel-title">
                @if($clone==1)
                    <h4>Add Creative </h4>
                @else
                    <h4>Edit Creative: {{$creative_obj->name}} </h4>
                @endif
            </div>
        </div>
        <!--.panel-heading-->
        <div class="panel-body" style="padding: 0">

            @if($clone==1)
                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('creative_create')}}" method="post"
                      novalidate="novalidate">
                    @else
                        <form id="order-form" class="form-horizontal parsley-validate"
                              action="{{URL::route('creative_update')}}" method="post"
                              novalidate="novalidate">
                            @endif
                            <input type="hidden" name="_token"
                                   value="{{ csrf_token() }}">                                       @if($clone==0)
                                <input type="hidden" name="_method" value="PUT"/>
                                <input type="hidden" name="creative_id" value="{{$creative_obj->id}}"/>
                            @else
                                <input type="hidden" name="advertiser_id"
                                       value="{{$creative_obj->getAdvertiser->id}}"/>
                            @endif
                            <div class="form-body">
                                <div class="note note-primary note-bottom-striped">
                                    <h4>General Informaition</h4>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <input type="text" id="name" name="name" placeholder="Name"
                                                           class="form-control" value="{{$creative_obj->name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" for="">Advertiser Name</label>
                                        <h5>{{$creative_obj->getAdvertiser->name}}</h5>

                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" for="">Client Name</label>
                                        <h5>{{$creative_obj->getAdvertiser->GetClientID->name}}</h5>

                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="">Last Modified</label>
                                        <h5>{{$creative_obj->updated_at}}</h5>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Domain Name</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <input type="text" name="advertiser_domain_name"
                                                           class="form-control" placeholder="Domain Name"
                                                           id="advertiser_domain_name"
                                                           value="{{$creative_obj->advertiser_domain_name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>

                                            <div class="switcher">
                                                <input type="checkbox" name="active"
                                                       hidden @if($creative_obj->status=='Active')
                                                       checked @endif id="active">
                                                <label for="active"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Ad Type</label>

                                            <div class="">
                                                <select name="ad_type" class="selecter">
                                                    <option value="0">Select One</option>
                                                    <option value="IFRAME" @if($creative_obj->ad_type=='IFRAME')
                                                            selected @endif>IFrame
                                                    </option>
                                                    <option value="JAVASCRIPT" @if($creative_obj->ad_type=='JAVASCRIPT')
                                                            selected @endif>Javascript
                                                    </option>
                                                    <option value="XHTML_BANNER_AD" @if($creative_obj->ad_type=='XHTML_BANNER_AD')
                                                            selected @endif>XHTML Banner Ad
                                                    </option>
                                                    <option value="XHTML_TEXT_AD" @if($creative_obj->ad_type=='XHTML_TEXT_AD')
                                                            selected @endif>XHTML Text Ad
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!--.form-group-->
                                </div>
                                <hr/>
                                <div class="note note-info note-bottom-striped">
                                    <h4>URL infromation</h4>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="landing_page_url" class="control-label">Landign Page
                                                URL</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <input type="text" name="landing_page_url"
                                                           placeholder="Landign Page URL" id="landing_page_url"
                                                           value="{{$creative_obj->landing_page_url}}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label class="control-label">Attributes</label>

                                            <select name="attributes[]" id="attributes" multiple class="selecter">
                                                <option value="AUDIO-AD-(AUTO-PLAY)" @if(in_array('AUDIO-AD-(AUTO-PLAY)',$attributes_select))
                                                        selected @endif>Audio Ad (Auto-Play)</option>
                                                <option value="AUDIO-AD-(USER INITIATED)" @if(in_array('AUDIO-AD-(USER INITIATED)',$attributes_select))
                                                        selected @endif>Audio Ad (User Initiated)</option>
                                                <option value="EXPANDABLE-(AUTOMATIC)" @if(in_array('EXPANDABLE-(AUTOMATIC)',$attributes_select))
                                                        selected @endif> Expandable (Automatic)
                                                </option>
                                                <option value="EXPANDABLE-(USER-INITIATED-CLICK)" @if(in_array('EXPANDABLE-(USER-INITIATED-CLICK)',$attributes_select))
                                                        selected @endif>Expandable (User Initiated - Click)
                                                </option>
                                                <option value="EXPANDABLE-(USER-INITIATED-ROLLOVER)" @if(in_array('EXPANDABLE-(USER-INITIATED-ROLLOVER)',$attributes_select))
                                                        selected @endif>Expandable (User Initiated - Rollover)
                                                </option>
                                                <option value="IN-BANNER-VIDEO-AD-(AUTO-PLAY)" @if(in_array('IN-BANNER-VIDEO-AD-(AUTO-PLAY)',$attributes_select))
                                                        selected @endif>In-Banner Video Ad (Auto-Play)</option>
                                                <option value="IN-BANNER VIDEO AD (USER INITIATED)" @if(in_array('IN-BANNER VIDEO AD (USER INITIATED)',$attributes_select))
                                                        selected @endif>In-Banner Video Ad (User Initiated)</option>
                                                <option value="POP" @if(in_array('POP',$attributes_select))
                                                        selected @endif>Pop</option>
                                                <option value="PROVOCATIVE OR SUGGESTIVE IMAGERY" @if(in_array('PROVOCATIVE OR SUGGESTIVE IMAGERY',$attributes_select))
                                                        selected @endif>Provocative or Suggestive Imagery</option>
                                                <option value="SHAKY, FLASHING, FLICKERING, EXTREME ANIMATION, SMILEYS" @if(in_array('SHAKY, FLASHING, FLICKERING, EXTREME ANIMATION, SMILEYS',$attributes_select))
                                                        selected @endif>Shaky, Flashing, Flickering, Extreme Animation, Smileys</option>
                                                <option value="SURVEYS" @if(in_array('SURVEYS',$attributes_select))
                                                        selected @endif>Surveys</option>
                                                <option value="TEXT-ONLY" @if(in_array('TEXT-ONLY',$attributes_select))
                                                        selected @endif>Text Only</option>
                                                <option value="USER INTERACTIVE (E.G., EMBEDDED GAMES)" @if(in_array('USER INTERACTIVE (E.G., EMBEDDED GAMES)',$attributes_select))
                                                        selected @endif>User Interactive (e.g., Embedded Games)</option>
                                                <option value="WINDOWS DIALOG OR ALERT STYLE" @if(in_array('WINDOWS DIALOG OR ALERT STYLE',$attributes_select))
                                                        selected @endif>Windows Dialog or Alert Style</option>
                                                <option value="HAS AUDIO ON/OFF BUTTON" @if(in_array('HAS AUDIO ON/OFF BUTTON',$attributes_select))
                                                        selected @endif>Has Audio On/Off Button</option>
                                                <option value="AD CAN BE SKIPPED" @if(in_array('AD CAN BE SKIPPED',$attributes_select))
                                                        selected @endif>Ad Can be Skipped</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label class="control-label">Preview URL</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <input type="text" name="preview_url" placeholder="Preview URL"
                                                           value="{{$creative_obj->preview_url}}"
                                                           class="form-control" id="preview_url">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label class="control-label">API</label>

                                            <select name="api[]" multiple class="selecter">
                                                <option value="VPAID_1.0" @if(in_array('VPAID_1.0',$api_select))
                                                        selected @endif>VPAID 1.0
                                                </option>
                                                <option value="VPAID_2.0" @if(in_array('VPAID_2.0',$api_select))
                                                        selected @endif>VPAID 2.0
                                                </option>
                                                <option value="MRAID-1" @if(in_array('MRAID-1',$api_select))
                                                        selected @endif> MRAID-1
                                                </option>
                                                <option value="ORMMA" @if(in_array('ORMMA',$api_select))
                                                        selected @endif>ORMMA
                                                </option>
                                                <option value="MRAID-2" @if(in_array('MRAID-2',$api_select))
                                                        selected @endif>MRAID-2
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php $size = explode('x', $creative_obj->size);?>
                                    <div class="col-md-1 ">
                                        <div class="form-group">
                                            <label class="control-label">Width</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <input type="text" name="size_width" placeholder="Width"
                                                           value="{{$size[0]}}" class="form-control"
                                                           id="size_width">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <div class="form-group">
                                            <label class="control-label">Height</label>

                                            <div class="inputer">
                                                <div class="input-wrapper">
                                                    <input type="text" name="size_height" placeholder="Height"
                                                           value="{{$size[1]}}" id="size_height"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <hr/>
                                <div class="note note-warning note-bottom-striped">
                                    <div class="form-group">
                                        <label class="control-label">Ad Tag</label>

                                        <div class="inputer">
                                            <div class="input-wrapper">
                                                    <textarea name="ad_tag" class="form-control" rows="3"
                                                              placeholder="type minimum 5 characters"
                                                              required>{{$creative_obj->ad_tag}}</textarea>
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
                                                              required>{{$creative_obj->description}}</textarea>
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
@if($clone==0)

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
    @endif
            <!--.col-->
    <div class="clearfix"></div>

@endsection
@section('FooterScripts')
    <script>
        $(document).ready(function () {
            FormsSwitchery.init();

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    advertiser_id: {
                        required: true
                    },
                    advertiser_domain_name: {
                        required: true,
                        domain: true
                    },
                    ad_tag: {
                        required: true
                    },
                    landing_page_url: {
                        required: true
                    },
                    size_width: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    size_height: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    attributes: {
                        required: true
                    },
                    preview_url: {
                        required: true
                    }
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

            $.ajax({
                url: "{{url('ajax/getAudit/creative/'.$creative_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/creative/'.$creative_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });


        })


    </script>
@endsection