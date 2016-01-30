@extends('Layout')
@section('siteTitle')
    Register New User
@endsection
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
                <li>Home</li>
                <li>User Registration</li>
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

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well">
                                <header>
                                    <h2>Add User </h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="">

                                        <form id="order-form" class="smart-form" action="{{URL::route('user_create')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <header>
                                                General Information
                                            </header>

                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label for="" class="label">Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label for="" class="label">Email Address</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="email" placeholder="Email Address">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label for="" class="label">Password</label>
                                                        <label class="input"><i class="icon-append fa fa-briefcase"></i>
                                                            <input type="password" name="password">
                                                        </label>
                                                    </section>
                                                </fieldset>

                                            </div>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                        <section class="col col-2">
                                                            <label for="" class="label">Select Role</label>
                                                            <label class="select"><i></i>
                                                                <select name="role_group">
                                                                    <option value="0" disabled>Select One</option>
                                                                    @foreach($role_obj as $index)
                                                                        <option value="{{$index->id}}">{{$index->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </label>
                                                        </section>
                                                        @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                                            <section class="col col-2">
                                                                <label for="" class="label">Select Comapny</label>
                                                                <label class="select"><i></i>
                                                                    <select name="company_group">
                                                                        <option value="0" disabled>Select One</option>
                                                                        @foreach($company_obj as $index)
                                                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </label>
                                                            </section>
                                                        @else
                                                            <section class="col col-2">
                                                                <label for="" class="label">Select Comapny</label>
                                                                <label class="input"><i></i>
                                                                    <input type="text" value="{{$company_obj->getCompany->name}}" disabled/>
                                                                </label>
                                                                <input type="hidden" name="company_group" value="{{$company_obj->getCompany->id}}"/>
                                                            </section>

                                                        @endif
                                                        <section class="col col-2">
                                                            <label for="" class="label">Status</label>
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="active">
                                                                <i></i>Active
                                                            </label>
                                                        </section>

                                                </fieldset>

                                            </div>
                                            <div class="well col-md-12">
                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label for="" class="label">Description</label>
                                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                            <textarea rows="5" name="description" placeholder="Tell us about your advertiser"></textarea>
                                                        </label>
                                                    </section>
                                                </fieldset>

                                            </div>
                                            <div class="clearfix"></div>
                                            <footer>
                                                <div class="row">
                                                    <div class="col-md-5 col-md-offset-3">
                                                        <button type="submit"
                                                                class=" button button--antiman button--round-l button--text-medium">
                                                            Submit
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

@endsection