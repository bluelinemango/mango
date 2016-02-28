@extends('Layout')
@section('siteTitle')Add Inventory @endsection
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
                <li>Add New Inventory</li>
            </ol>

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
                                <h2>Inventory Registration </h2>

                            </header>

                            <!-- widget div-->
                            <div>
                                <!-- widget content -->
                                <div class="">

                                    <form id="order-form" class="smart-form" action="{{URL::route('inventory_create')}}" method="post" novalidate="novalidate" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <header>
                                            General Information
                                        </header>

                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-2">
                                                    <label class="label" for="">Name</label>
                                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                                        <input type="text" name="name" placeholder="Name">
                                                    </label>
                                                </section>
                                                <section class="col col-2">
                                                    <label class="label" for="">Type</label>
                                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                                        <input type="text" name="type" placeholder="Type">
                                                    </label>
                                                </section>
                                                <section class="col col-2">
                                                    <label class="label" for="">Category</label>
                                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                                        <input type="text" name="category" placeholder="Category">
                                                    </label>
                                                </section>
                                                <section class="col col-2">
                                                    <label class="label" for="">Daily Limit</label>
                                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                                        <input type="text" name="daily_limit" placeholder="Daily Limit">
                                                    </label>
                                                </section>

                                            </div>

                                        </fieldset>

                                        <footer>
                                            <button type="submit"
                                                    class=" button button--ujarak button--border-thick button--text-upper button--size-s button--inverted button--text-thick">
                                                Save
                                            </button>
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
    <script>
        $(document).ready(function () {

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