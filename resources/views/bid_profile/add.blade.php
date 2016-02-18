@extends('Layout')
@section('siteTitle')Add Bid Profile @endsection
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
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/edit')}}">Client: cl{{$advertiser_obj->GetClientID->id}}</a></li>
                <li><a href="{{url('/client/cl'.$advertiser_obj->GetClientID->id.'/advertiser/adv'.$advertiser_obj->id.'/edit')}}">Advertiser: adv{{$advertiser_obj->id}}</a></li>
                <li>Bid Profile Registration</li>
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
                            <div class="well">
                                <header>
                                    <h2>Bid Profile Registration </h2>

                                </header>

                                <!-- widget div-->
                                <div>


                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('bidProfile_create')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="advertiser_id" value="{{$advertiser_obj->id}}">
                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label class="label" for="">Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label for="" class="label">Status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active">
                                                            <i></i>
                                                        </label>
                                                    </section>

                                                    <section class="col col-3">
                                                        <label class="label" for="">Advertiser Name</label>
                                                        <label class="input">
                                                            {{$advertiser_obj->name}}
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label" for="">Client Name</label>
                                                        <label class="input">{{$advertiser_obj->GetClientID->name}}
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>
                                            <fieldset>

                                            </fieldset>
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
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->
@endsection
@section('FooterScripts')
    <!-- PAGE RELATED PLUGIN(S) -->

    <script type="text/javascript">

        $(document).ready(function() {
            pageSetUp();

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
                        required : 'Please enter Bid Profile name'
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