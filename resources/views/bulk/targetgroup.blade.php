<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="well">
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class=>

                        <form id="order-form" class="smart-form" action="{{URL::route('campaign_bulk_update')}}"
                              method="post" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <header>
                                General Information
                            </header>

                            <div class="well col-md-12">
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-2">
                                            <label class="label" for="">Name</label>
                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                <input type="text" name="name" placeholder="Name" readonly="readonly">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-2">
                                            <label class="label" for="">IAB
                                                Category</label>

                                            <label class="input"> <i
                                                        class="icon-append fa fa-user"></i>

                                                <div class="form-group">
                                                    <select name="iab_category"
                                                            class="form-control "
                                                            id=""
                                                            onchange="ShowSubCategory(this.value)">
                                                        <option value="0"
                                                                disabled>
                                                            Select one ...
                                                        </option>
                                                        @foreach($iab_category_obj as $index)
                                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </label>
                                        </section>
                                        <section class="col col-2">
                                            <label class="label" for="">IAB Sub
                                                Category</label>

                                            <label class="input"> <i
                                                        class="icon-append fa fa-user"></i>

                                                <div class="form-group">
                                                    <select name="iab_sub_category"
                                                            class="form-control "
                                                            id="iab_sub_category">
                                                        <option value="0"
                                                                disabled>
                                                            Select Iab
                                                            Category First
                                                            ...
                                                        </option>
                                                    </select>
                                                </div>
                                            </label>
                                        </section>
                                        <section class="col col-2">
                                            <label class="label" for="">Domain Name</label>
                                            <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                <input type="text" name="advertiser_domain_name" id="domain_name"
                                                       placeholder="Domain Name" readonly="readonly">
                                            </label>
                                        </section>
                                        <section class="col col-2">
                                            <label for="" class="label">Status</label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="active">
                                                <i></i>
                                            </label>
                                        </section>


                                    </div>
                                </fieldset>

                            </div>
                            <header>
                                Budget Information
                            </header>
                            <div class="well col-md-6 ">
                                <fieldset>
                                    <section class="col col-3">
                                        <label class="label" for="">Max Impression</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="max_impression" placeholder="Max Impression">
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Daily Max Impression</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="daily_max_impression"
                                                   placeholder="Daily Max Impression">
                                        </label>
                                    </section>
                                </fieldset>
                            </div>
                            <div class="well col-md-6 ">

                                <fieldset>
                                    <section class="col col-3">
                                        <label class="label" for="">Max Budget</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="max_budget" placeholder="Max Budget">
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Daily Max Budget</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="daily_max_budget" placeholder="Daily Max Budget">
                                        </label>
                                    </section>
                                </fieldset>
                            </div>
                            <div class="clearfix"></div>
                            <div class="well col-md-12">

                                <fieldset>
                                    <section class="col col-2">
                                        <label class="label" for="">Frequency In Sec </label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input placeholder="Frequency per sec" type="text" name="frequency_in_sec" id="frequency_in_sec">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label" for="">Pacing Plan</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input placeholder="Pacing Plan" type="text" name="pacing_plan" id="pacing_plan">
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">CPM</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="cpm" placeholder="CPM">
                                        </label>
                                    </section>
                                </fieldset>
                            </div>
                            <div class="clearfix"></div>
                            <header>
                                Time Information
                            </header>
                            <div class="well col-md-6">

                                <fieldset>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label" for="">Start Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="startdate" id="startdate"
                                                       placeholder="Expected start date">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label" for="">End Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="finishdate" id="finishdate"
                                                       placeholder="Expected finish date">
                                            </label>
                                        </section>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="clearfix"></div>
                            <div class="well col-md-12">
                                <fieldset>
                                    <section class="col col-4">
                                        <label class="label" for="">Description</label>
                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="5" name="description"
                                                      placeholder="Tell us about your Campaign"></textarea>
                                        </label>
                                    </section>
                                </fieldset>
                            </div>
                            <header>
                                <span class="pull-left  margin-right-5">Manage Assign</span>
                                <div class="pull-left  margin-right-5">
                                <select name="advertiser_id" id="advertiser_change">
                                    <option value="0">Select Advertiser</option>
                                    @foreach($adver_obj as $index)
                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="pull-left margin-right-5">
                                <select name="campaign_id" id="show_campaignList">
                                    <option value="0">Select Advertiser First</option>
                                </select>
                                </div>
                            </header>
                            <div class="well col-md-12" id="show_assign">
                            </div>
                            <div class="well col-md-12">
                                <div class="">
                                    <h4>Bid By Hours</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-hover time-table">
                                                <thead>
                                                <tr>
                                                    <th>Hours</th>
                                                    <th>12am</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>8</th>
                                                    <th>9</th>
                                                    <th>10</th>
                                                    <th>11</th>
                                                    <th>12pm</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>8</th>
                                                    <th>9</th>
                                                    <th>10</th>
                                                    <th>11</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i=0;$i<7;$i++)
                                                    <tr>
                                                        <td>@if($i==0)
                                                                Monday @elseif($i==1)
                                                                Tusday @elseif($i==2)
                                                                Wendsday @elseif($i==3)
                                                                Tursday @elseif($i==4)
                                                                Friday @elseif($i==5)
                                                                Satarday @elseif($i==6)
                                                                Sunday @endif</td>
                                                        @for($j=0;$j<24;$j++)
                                                            <td style="padding: 1px!important;">
                                                                <div id="{{$i}}-{{$j}}-time" class="time_table_unselect" ></div>

                                                                <input type="checkbox" name="{{$i}}-{{$j}}-hour" id="{{$i}}-{{$j}}-time-checkbox" style="display: none"/>
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endfor

                                                </tbody>
                                            </table>


                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a id="clear_all" class="btn btn-primary">Clear All</a>
                                        </div>
                                        <div class="col-md-5">
                                            <h4 style="float: left; padding: 5px 10px;">Legend:</h4>
                                            <div class="time_table_unselect" style="max-width: 40px; float: left; padding: 5px 10px;"></div>
                                            <div style="float: left; padding: 5px 10px;">Inactive</div>
                                            <div class="time-table-div-select" style="max-width: 40px; float: left; padding: 5px 10px;"></div>
                                            <div style="float: left; padding: 5px 10px;">Active</div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <select name=""
                                                    id="suggested">
                                                <option value="business-hours">Business Hours</option>
                                                <option value="happy-hours">Happy Hours</option>
                                                <option value="business-hours">Business Hours</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="well col-md-12">
                                @foreach($targetgroup_obj as $index)
                                    <div class="col-md-2">
                                        <section>
                                            <label class="checkbox">
                                                <input type="checkbox" name="targetgroup[]" value="{{$index->id}}">
                                                <i></i> {{$index->name}}
                                            </label>
                                        </section>
                                    </div>
                                @endforeach
                            </div>
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
