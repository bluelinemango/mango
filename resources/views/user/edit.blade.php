@extends('Layout')
@section('siteTitle')Edit User: {{$user_obj->name}} @endsection
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
                <li>User Edit: usr{{$user_obj->id}}</li>
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
                            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
                                <!-- widget options:
                                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                    data-widget-colorbutton="false"
                                    data-widget-editbutton="false"
                                    data-widget-togglebutton="false"
                                    data-widget-deletebutton="false"
                                    data-widget-fullscreenbutton="false"
                                    data-widget-custombutton="false"
                                    data-widget-collapsed="true"
                                    data-widget-sortable="false"

                                -->
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Edit User: {{$user_obj->name}} </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">

                                        <form id="order-form" class="smart-form" action="{{URL::route('user_update')}}" method="post" novalidate="novalidate" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT"/>
                                            <input type="hidden" name="user_id" value="{{$user_obj->id}}"/>
                                            <header>
                                                General Information
                                            </header>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label for="" class="label">Name</label>
                                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="Name" value="{{$user_obj->name}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label for="" class="label">Email Address</label>
                                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                            <input type="text" name="email" placeholder="Email Address" value="{{$user_obj->email}}">
                                                        </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label for="" class="label">Password</label>
                                                        <label class="input"><i class="icon-append fa fa-briefcase"></i>
                                                            <input type="password" name="password">
                                                        </label>
                                                    </section>
                                                </div>


                                            </fieldset>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-3">
                                                        <label for="" class="label">Select Role</label>
                                                        <label class="select"><i></i>
                                                            <select name="role_group">
                                                                <option value="0" disabled>Select One</option>
                                                                @foreach($role_obj as $index)
                                                                    <option value="{{$index->id}}"@if($index->id==$user_obj->role_id) selected @endif>{{$index->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                    </section>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                                    <section class="col col-3">
                                                        <label for="" class="label">Select Company</label>
                                                        <label class="select"><i></i>
                                                            <select name="company_group">
                                                                <option value="0" disabled>Select One</option>
                                                                @foreach($company_obj as $index)
                                                                    <option value="{{$index->id}}"@if($index->id==$user_obj->company_id) selected @endif>{{$index->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                    </section>
                                                    @else
                                                    <section class="col col-3">
                                                        <label for="" class="label">Comapny Name</label>
                                                        <label class="input"><i></i>
                                                            <input type="text" value="{{$company_obj->getCompany->name}}" disabled/>
                                                        </label>
                                                        <input type="hidden" name="company_group" value="{{$company_obj->getCompany->id}}"/>
                                                    </section>

                                                    @endif
                                                    <section class="col col-3">
                                                        <label for="" class="label">status</label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="active" @if($user_obj->active==1) checked @endif>
                                                            <i></i>Active Status
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <section>
                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                        <textarea rows="5" name="description" placeholder="Tell us about your advertiser"></textarea>
                                                    </label>
                                                </section>
                                            </fieldset>
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