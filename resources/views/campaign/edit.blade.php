@extends('Layout1')
@section('siteTitle')Edit Campaign: {{$campaign_obj->name}} @endsection
@section('headerCss')
    <link rel="stylesheet" href="{{cdn('newTheme/globals/plugins/components-summernote/dist/summernote.css')}}">

@endsection
@section('content')
    <div class="content">

        <div class="page-header full-content">
            <div class="row">
                <div class="col-sm-6">
                    <h1>NOMADINI
                        <small>Diffrent Ads</small>
                    </h1>
                </div>
                <!--.col-->
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ion-home"></i></a></li>
                        <li>
                            <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/edit')}}">Client:
                                cl{{$campaign_obj->getAdvertiser->GetClientID->id}}</a>
                        </li>
                        <li>
                            <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->advertiser_id.'/edit')}}">Advertiser:
                                adv{{$campaign_obj->advertiser_id}}</a>
                        </li>
                        @if($clone==1)
                            <li><a href="#" class="active">Add Campaign</a></li>
                        @else
                            <li><a href="#" class="active">Campaign: cmp{{$campaign_obj->id}}</a></li>
                        @endif
                    </ol>
                </div>
                <!--.col-->
            </div>
            <!--.row-->
        </div>
        <!--.page-header-->

        <!-- content -->
        <div class="col-md-9">
            <div class="panel red">
                <div class="panel-heading">
                    <div class="panel-title">
                        @if($clone==1)
                            <h4>Add Campaign </h4>
                        @else
                            <h4>Edit Campaign: {{$campaign_obj->name}} </h4>
                        @endif
                    </div>
                </div>
                <!--.panel-heading-->
                <div class="panel-body">

                    @if($clone==1)
                        <form id="order-form" class="form-horizontal parsley-validate"
                              action="{{URL::route('campaign_create')}}" method="post"
                              novalidate="novalidate">
                            @else
                                <form id="order-form" class="form-horizontal parsley-validate"
                                      action="{{URL::route('campaign_update')}}" method="post"
                                      novalidate="novalidate">
                                    @endif
                                    <input type="hidden" name="_token"
                                           value="{{ csrf_token() }}">                                       @if($clone==0)
                                        <input type="hidden" name="_method" value="PUT"/>
                                        <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>
                                    @else
                                        <input type="hidden" name="advertiser_id"
                                               value="{{$campaign_obj->getAdvertiser->id}}"/>
                                    @endif
                                    <div class="form-body">
                                        <div class="note note-primary note-top-striped">
                                            <h4>Real Time Information</h4>

                                            <div class="col-md-3">
                                                <div class="real-time-box">
            <span class="real-time-icon" style="background-color: #00c0ef ">
                <i class="fa fa-eye"></i>
            </span>

                                                    <div class="real-time-content">
                                                        Imps to Now:
                                                        <br/>
                                                        <strong>{{(isset($real_time[0])) ? $real_time[0]->impressions_shown_today_until_now : '0'}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="real-time-box">
            <span class="real-time-icon" style="background-color: #dd4b39 ">
                <i class="fa fa-eye"></i>
            </span>

                                                    <div class="real-time-content">
                                                        Total Imps:
                                                        <br/>
                                                        <strong>{{(isset($real_time[0])) ? $real_time[0]->total_impression_show_until_now : '0'}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="real-time-box">
            <span class="real-time-icon" style="background-color: #00a65a ">
                <i class="fa fa-dollar"></i>
            </span>

                                                    <div class="real-time-content">
                                                        Budget to Now:
                                                        <br/>
                                                        <strong>{{(isset($real_time[0])) ? $real_time[0]->daily_budget_spent_today_until_now : '0'}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="real-time-box">
            <span class="real-time-icon" style="background-color: #f39c12 ">
                <i class="fa fa-dollar"></i>
            </span>

                                                    <div class="real-time-content">
                                                        Total Budget:
                                                        <br/>
                                                        <strong>{{(isset($real_time[0])) ? $real_time[0]->total_budget_spent_until_now : '0'}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="real-time-box">
            <span class="real-time-icon" style="background-color: #f39c12 ">
                <i class="fa fa-gear"></i>
            </span>

                                                    <div class="real-time-content">
                                                        Last Shown:
                                                        <br/>
                                                        {{(isset($real_time[0])) ? $real_time[0]->last_time_ad_shown : '0'}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!--.form-group-->
                                        </div>
                                        <div class="note note-primary note-top-striped">
                                            <h4>General Informaition</h4>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Full name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{$campaign_obj->name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label" for="">Advertiser Name</label>
                                                    <h5>{{$campaign_obj->getAdvertiser->name}}</h5>

                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label" for="">Client Name</label>
                                                    <h5>{{$campaign_obj->getAdvertiser->GetClientID->name}}</h5>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label" for="">Last Modified</label>
                                                    <h5>{{$campaign_obj->updated_at}}</h5>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Domain Name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="advertiser_domain_name" class="form-control" placeholder="Domain Name"                       value="{{$campaign_obj->advertiser_domain_name}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="control-label">status</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="checkbox"
                                                                   name="active" @if($campaign_obj->status=='Active')
                                                                   checked @endif>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!--.form-group-->
                                        </div>

                                        <div class="note note-primary note-top-striped">
                                            <h4>Budget Informaition</h4>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Max Impression</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="max_impression"
                                                                   placeholder="Max Impression"
                                                                   value="{{$campaign_obj->max_impression}}" class="form-control">
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
                                                                   value="{{$campaign_obj->daily_max_impression}}" class="form-control">
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
                                                                   placeholder="Max Budget" class="form-control"
                                                                   value="{{$campaign_obj->max_budget}}">
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
                                                                   placeholder="Daily Max Budget" class="form-control"
                                                                   value="{{$campaign_obj->daily_max_budget}}">
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
                                                            <input type="text" name="cpm" placeholder="CPM" class="form-control"
                                                                   value="{{$campaign_obj->cpm}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="well col-md-6">

                                                <fieldset>
                                                    <section class="col col-4">
                                                        <label class="label" for="">cpm</label>
                                                        <label class="input"> <i
                                                                    class="icon-append fa fa-dollar"></i>
                                                            <input type="text" name="cpm" placeholder="CPM"
                                                                   value="{{$campaign_obj->cpm}}">
                                                        </label>
                                                    </section>
                                                </fieldset>
                                            </div>







                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Full name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{$campaign_obj->name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label" for="">Advertiser Name</label>
                                                    <h5>{{$campaign_obj->getAdvertiser->name}}</h5>

                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label" for="">Client Name</label>
                                                    <h5>{{$campaign_obj->getAdvertiser->GetClientID->name}}</h5>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label" for="">Last Modified</label>
                                                    <h5>{{$campaign_obj->updated_at}}</h5>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Domain Name</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="text" name="advertiser_domain_name" class="form-control" placeholder="Domain Name"                       value="{{$campaign_obj->advertiser_domain_name}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="control-label">status</label>

                                                    <div class="inputer">
                                                        <div class="input-wrapper">
                                                            <input type="checkbox"
                                                                   name="active" @if($campaign_obj->status=='Active')
                                                                   checked @endif>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!--.form-group-->
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email field</label>

                                            <div class="col-md-5">
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="email" name="basic-email" class="form-control"
                                                               placeholder="someone@exmail.org" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Password field</label>

                                            <div class="col-md-5">
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="password" name="password" class="form-control"
                                                               placeholder="password" required>
                                                    </div>
                                                </div>
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="password" name="confirmPassword"
                                                               class="form-control" placeholder="confirm password"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Integer field</label>

                                            <div class="col-md-5">
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="number" name="basic-digits" class="form-control"
                                                               placeholder="ex: 1,2,3" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Url field</label>

                                            <div class="col-md-5">
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="url" name="basic-url" class="form-control"
                                                               placeholder="http://www.themeforest.com" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Age limit</label>

                                            <div class="col-md-5">
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <input type="text" name="minmax-limit" class="form-control"
                                                               placeholder="age should be between 10 and 100" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Checkboxes</label>

                                            <div class="col-md-5">
                                                <div class="checkboxer">
                                                    <input type="checkbox" id="check1" name="checkboxes1" value=""
                                                           data-parsley-mincheck="2">
                                                    <label for="check1">Option one</label>
                                                </div>
                                                <div class="checkboxer">
                                                    <input type="checkbox" id="check2" name="checkboxes1" value="">
                                                    <label for="check2">Option two</label>
                                                </div>
                                                <div class="checkboxer">
                                                    <input type="checkbox" id="check3" name="checkboxes1" value="">
                                                    <label for="check3">Option three</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Radios</label>

                                            <div class="col-md-5">

                                                <div class="radioer">
                                                    <input type="radio" name="radio1" id="radio1" value="option1">
                                                    <label for="radio1">Option one</label>
                                                </div>
                                                <div class="radioer">
                                                    <input type="radio" name="radio1" id="radio2" value="option2">
                                                    <label for="radio2">Option two</label>
                                                </div>
                                                <div class="radioer">
                                                    <input type="radio" name="radio1" id="radio3" value="option3"
                                                           required>
                                                    <label for="radio3">Option three</label>
                                                </div>

                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Selectbox</label>

                                            <div class="col-md-5">
                                                <select name="basic-selectbox" class="selecter" required="required">
                                                    <option value="">Text</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Textarea</label>

                                            <div class="col-md-5">
                                                <div class="inputer">
                                                    <div class="input-wrapper">
                                                        <textarea name="basic-textarea" class="form-control" rows="3"
                                                                  placeholder="type minimum 5 characters"
                                                                  required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.form-group-->

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-default bv-reset">Cancel</button>
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
            <div class="panel indigo">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class="pull-left">Activities</h4>
                        <select id="audit_status" class="pull-right">
                            <option value="entity">This Entity</option>
                            <option value="all">All</option>
                            <option value="user">User</option>
                        </select>

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
        <!-- content -->

        <div class="footer-links margin-top-40">
            <div class="row no-gutters">
                <div class="col-xs-6 bg-indigo">
                    <a href="pages-timeline.html">
                        <span class="state">Pages</span>
                        <span>Timeline</span>
                        <span class="icon"><i class="ion-android-arrow-back"></i></span>
                    </a>
                </div>
                <!--.col-->
                <div class="col-xs-6 bg-cyan">
                    <a href="components-offline-detector.html">
                        <span class="state">Components</span>
                        <span>Offline Detector</span>
                        <span class="icon"><i class="ion-android-arrow-forward"></i></span>
                    </a>
                </div>
                <!--.col-->
            </div>
            <!--.row-->
        </div>
        <!--.footer-links-->

    </div><!--.content-->
























                                                    <header>
                                                        General Information
                                                    </header>
                                                    <div class="well col-md-6">
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-6">
                                                                    <label class="label" for="">Start Date</label>
                                                                    <label class="input"> <i
                                                                                class="icon-append fa fa-calendar"></i>
                                                                        <input type="text" name="start_date"
                                                                               id="startdate"
                                                                               placeholder="Expected start date"
                                                                               value="{{$campaign_obj->start_date}}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-6">
                                                                    <label class="label" for="">End Date</label>
                                                                    <label class="input"> <i
                                                                                class="icon-append fa fa-calendar"></i>
                                                                        <input type="text" name="end_date"
                                                                               id="finishdate"
                                                                               placeholder="Expected finish date"
                                                                               value="{{$campaign_obj->end_date}}">
                                                                    </label>
                                                                </section>
                                                            </div>

                                                        </fieldset>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="well col-md-12">
                                                        <fieldset>
                                                            <section class="col col-8">
                                                                <label class="label" for="">Description</label>
                                                                <label class="textarea"> <i
                                                                            class="icon-append fa fa-comment"></i>
                                                        <textarea rows="3" name="description"
                                                                  placeholder="Tell us about your Campaign">{{$campaign_obj->description}}</textarea>
                                                                </label>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                                    <div class="clearfix"></div>
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
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-heading">
                                            <h2 class="pull-left">Activities</h2>
                                            <select id="audit_status" class="pull-right">
                                                <option value="entity">This Entity</option>
                                                <option value="entity">This Entity</option>
                                                <option value="all">All</option>
                                                <option value="user">User</option>
                                            </select>

                                            <div class="clearfix"></div>
                                            <small>All Activities for this Entity</small>
                                        </div>
                                        <div class="card-body">
                                            <div class="streamline b-l b-accent m-b" id="show_audit">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- WIDGET END -->

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

            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="well">
                            <header>
                                <h2 class="font-md pull-left">List of Target Group </h2>
                                @if(in_array('ADD_EDIT_TARGETGROUP',$permission))
                                    <h2 class="pull-right">
                                        <a href="{{url('/client/cl'.$campaign_obj->getAdvertiser->GetClientID->id.'/advertiser/adv'.$campaign_obj->getAdvertiser->id.'/campaign/cmp'.$campaign_obj->id.'/targetgroup/add')}}"
                                           class=" btn btn-primary pull-left">
                                            Add Target Group
                                        </a>
                                    </h2>
                                    <h2 class="pull-right">
                                        <button type="reset" class="btn btn-primary" data-toggle="modal"
                                                data-target="#myModal_targetgroup">
                                            Upload Target Group
                                        </button>
                                    </h2>
                                    <h2 class="pull-right">
                                        <a href="{{cdn('/excel_template/targetgroup.xls')}}" type="reset"
                                           class="btn btn-primary ">
                                            Download Target Group Excel Template
                                        </a>

                                    </h2>

                                @endif

                            </header>


                            <div id="targetgroup_grid"></div>
                        </div>
                        <!-- end widget -->


                    </article>
                    <!-- WIDGET END -->


                </div>

                <!-- end row -->

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN PANEL -->








    <!-- Modal -->
    <div class="modal fade" id="myModal_targetgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload Target Group Excel File</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well well-sm well-primary">
                                <form id="order-form" class="smart-form" role="form"
                                      action="{{URL::route('targetgroup_upload')}}" method="post"
                                      novalidate="novalidate"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="campaign_id" value="{{$campaign_obj->id}}"/>
                                    {{--<form class="form form-inline " role="form" method="post" action="">--}}
                                    <section>
                                        <label class="label">File input</label>

                                        <div class="input input-file">
                                            <span class="button"><input type="file" id="file" name="upload"
                                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input
                                                    type="text" placeholder="Include some files" readonly="">
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@endsection
@section('FooterScripts')
    <script type="text/javascript" src="{{cdn('js/srcjsgrid/jsgrid.min.js')}}"></script>
    <!-- BEGIN PLUGINS AREA -->
    <script src="{{cdn('newTheme/globals/plugins/components-summernote/dist/summernote.min.js')}}"></script>
    <script src="{{cdn('newTheme/globals/plugins/parsleyjs/dist/parsley.min.js')}}"></script>
    <!-- END PLUGINS AREA -->

    <!-- PLUGINS INITIALIZATION AND SETTINGS -->
    <script src="{{cdn('newTheme/globals/scripts/forms-validations-parsley.js')}}"></script>
    <!-- END PLUGINS INITIALIZATION AND SETTINGS -->

    <!-- BEGIN INITIALIZATION-->
    <script>
        $(document).ready(function () {
            Pleasure.init();
            Layout.init();
            FormsValidationsParsley.init();
        });
    </script>
    <!-- END INITIALIZATION-->



    <script>
        $(document).ready(function () {

            pageSetUp();

            $(function () {

                var db = {

                    loadData: function (filter) {
                        return $.grep(this.targetgroup, function (targetgroup) {
                            return (!filter.name || targetgroup.name.indexOf(filter.name) > -1)
                                    && (!filter.campaign_name || targetgroup.campaign_name.indexOf(filter.campaign_name) > -1)
                                    && (!filter.id || targetgroup.id.indexOf(filter.id) > -1);
                        });
                    },

                    updateItem: function (updatingTargetgroup) {
                        updatingTargetgroup['oper'] = 'edit';
                        console.log(updatingTargetgroup);
                        $.ajax({
                            type: "PUT",
                            url: "{{url('/ajax/jqgrid/targetgroup')}}",
                            data: updatingTargetgroup,
                            dataType: "json"
                        }).done(function (response) {
                            console.log(response);
                            if (response.success == true) {
                                var title = "Success";
                                var color = "#739E73";
                                var icon = "fa fa-check";
                            } else if (response.success == false) {
                                var title = "Warning";
                                var color = "#C46A69";
                                var icon = "fa fa-bell";
                            }
                            ;

                            $.smallBox({
                                title: title,
                                content: response.msg,
                                color: color,
                                icon: icon,
                                timeout: 8000
                            });
                        });
                    }

                };

                window.db = db;

                db.targetgroup = [
                    @foreach($campaign_obj->Targetgroup as $index)
                    {
                        "id": 'tg{{$index->id}}',
                        "name": '{{$index->name}}',
                        "campaign_name": '<a href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/edit')}}">{{$index->getCampaign->name}}</a>',
                        @if($index->status == 'Active')
                        "status": '<a id="targetgroup{{$index->id}}" href="javascript: ChangeStatus(`targetgroup`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>',
                        @elseif($index->status == 'Inactive')
                        "status": '<a id="targetgroup{{$index->id}}" href="javascript: ChangeStatus(`targetgroup`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>',
                        @endif
                        "date_modify": '{{$index->updated_at}}',
                        "action": '<a class="btn" href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/targetgroup/tg'.$index->id.'/edit')}}"><img src="{{cdn('img/edit_16x16.png')}}" /></a>' @if(in_array('ADD_EDIT_TARGETGROUP',$permission)) + ' <a class="btn txt-color-white" href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/targetgroup/add')}}"><img src="{{cdn('img/plus_16x16.png')}}" /></a>'@endif



                    },
                    @endforeach
                ];

                $("#targetgroup_grid").jsGrid({
                    width: "100%",

                    filtering: true,
                    editing: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    pageSize: 15,
                    pageButtonCount: 5,

                    deleteConfirm: "Do you really want to delete the client?",

                    controller: db,
                    fields: [
                        {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                        {name: "name", title: "Name", type: "text", width: 70},
                        {
                            name: "campaign_name",
                            title: "Campaign",
                            type: "text",
                            width: 70,
                            align: "center",
                            editing: false
                        },
                        {name: "status", title: "Status", width: 50, align: "center"},
                        {name: "date_modify", title: "Last Modified", width: 70, align: "center"},
                        {name: "action", title: "Edit / +TG", sorting: false, width: 70, align: "center"},
                        {type: "control"}
                    ]

                });

            });

            var $orderForm = $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    advertiser_domain_name: {
                        required: true,
                        domain: true
                    },
                    advertiser_id: {
                        required: true
                    },
                    max_impression: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'

                    },
                    daily_max_impression: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    max_budget: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    daily_max_budget: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    cpm: {
                        required: true,
                        min: 0,
                        number: 'Enter number Plz'
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
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

            // START AND FINISH DATE
            $('#startdate').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#finishdate').datepicker('option', 'minDate', selectedDate);
                }
            });

            $('#finishdate').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#startdate').datepicker('option', 'maxDate', selectedDate);
                }
            });


            $.ajax({
                url: "{{url('ajax/getAudit/campaign/'.$campaign_obj->id)}}"
            }).success(function (response) {
                $('#show_audit').html(response);
            });

            $('#audit_status').change(function () {
                if ($(this).val() == 'all') {
                    $.ajax({
                        url: "{{url('ajax/getAllAudits')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                } else if ($(this).val() == 'entity') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/campaign/'.$campaign_obj->id)}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                } else if ($(this).val() == 'user') {
                    $.ajax({
                        url: "{{url('ajax/getAudit/user')}}"
                    }).success(function (response) {
                        $('#show_audit').html(response);
                    });
                }
            });


        })


    </script>
@endsection