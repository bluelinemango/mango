@extends('Layout1')
@section('siteTitle')Add Creative @endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="ion-home"></i></a></li>
        <li>
            <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client:
                cl{{$advertiser_obj->GetClientID->id}}</a>
        </li>
        <li>
            <a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser:
                adv{{$advertiser_obj->id}}</a>
        </li>
        <li><a href="#" class="active">Creative Registration</a></li>
    </ol>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="panel gray">
            <div class="panel-heading with-gap">
                <div class="panel-title">
                    <h4>Creative Registration</h4>
                </div>
            </div>
            <!--.panel-heading-->
            <div class="panel-body" style="padding: 0">

                <form id="order-form" class="form-horizontal parsley-validate"
                      action="{{URL::route('creative_create')}}" method="post"
                      novalidate="novalidate">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="advertiser_id"
                           value="{{$advertiser_obj->id}}"/>

                    <div class="form-body">
                        <div class="note note-primary note-bottom-striped">
                            <h4>General Informaition</h4>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}"
                                                   class="form-control">
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
                                                   class="form-control" placeholder="Domain Name"
                                                   id="advertiser_domain_name" value="{{old('advertiser_domain_name')}}">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ad Type</label>

                                    <div class="">
                                        <select name="ad_type" class="selecter">
                                            <option value="0">Select One</option>
                                            <option value="IFRAME">IFrame
                                            </option>
                                            <option value="JAVASCRIPT">Javascript
                                            </option>
                                            <option value="XHTML_BANNER_AD">XHTML Banner Ad
                                            </option>
                                            <option value="XHTML_TEXT_AD">XHTML Text Ad
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
                                                   placeholder="Landign Page URL" id="landing_page_url" value="{{old('landing_page_url')}}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label" for="attributes">Attributes</label>
                                    <select name="attributes[]" multiple id="attributes" class="selecter">
                                        <option value="AUDIO-AD-(AUTO-PLAY)">Audio Ad (Auto-Play)</option>
                                        <option value="AUDIO-AD-(USER INITIATED)">Audio Ad (User Initiated)</option>
                                        <option value="EXPANDABLE-(AUTOMATIC)"> Expandable (Automatic)
                                        </option>
                                        <option value="EXPANDABLE-(USER-INITIATED-CLICK)">Expandable (User Initiated - Click)
                                        </option>
                                        <option value="EXPANDABLE-(USER-INITIATED-ROLLOVER)">Expandable (User Initiated - Rollover)
                                        </option>
                                        <option value="IN-BANNER-VIDEO-AD-(AUTO-PLAY)">In-Banner Video Ad (Auto-Play)</option>
                                        <option value="IN-BANNER VIDEO AD (USER INITIATED)">In-Banner Video Ad (User Initiated)</option>
                                        <option value="POP">Pop</option>
                                        <option value="PROVOCATIVE OR SUGGESTIVE IMAGERY">Provocative or Suggestive Imagery</option>
                                        <option value="SHAKY, FLASHING, FLICKERING, EXTREME ANIMATION, SMILEYS">Shaky, Flashing, Flickering, Extreme Animation, Smileys</option>
                                        <option value="SURVEYS">Surveys</option>
                                        <option value="TEXT-ONLY">Text Only</option>
                                        <option value="USER INTERACTIVE (E.G., EMBEDDED GAMES)">User Interactive (e.g., Embedded Games)</option>
                                        <option value="WINDOWS DIALOG OR ALERT STYLE">Windows Dialog or Alert Style</option>
                                        <option value="HAS AUDIO ON/OFF BUTTON">Has Audio On/Off Button</option>
                                        <option value="AD CAN BE SKIPPED">Ad Can be Skipped</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label">Preview URL</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="preview_url" placeholder="Preview URL" value="{{old('preview_url')}}"
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
                                        <option value="VPAID_1.0">VPAID 1.0
                                        </option>
                                        <option value="VPAID_2.0">VPAID 2.0
                                        </option>
                                        <option value="MRAID-1"> MRAID-1
                                        </option>
                                        <option value="ORMMA">ORMMA
                                        </option>
                                        <option value="MRAID-2">MRAID-2
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 ">
                                <div class="form-group">
                                    <label class="control-label">Width</label>

                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input type="text" name="size_width" placeholder="Width"
                                                   class="form-control"
                                                   id="size_width" value="{{old('size_width')}}">

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
                                                   id="size_height"
                                                   class="form-control" value="{{old('size_height')}}">

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
                                                              placeholder="type minimum 5 characters" id="ad_tag"
                                                            >{{old('ad_tag')}}</textarea>
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
                                                              id="description">{{old('description')}}</textarea>
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
@endsection
@section('FooterScripts')
    <script>
        $(document).ready(function () {
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
        })
    </script>
@endsection