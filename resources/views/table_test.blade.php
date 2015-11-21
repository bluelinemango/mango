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
            <li>Home></li><li>Forms</li><li>Smart Form Layouts</li>
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
        @if(isset($errors))
            @foreach($errors->get('msg') as $error)
                <div class="alert alert-block alert-{{($errors->get('success')[0] == true)?'success':'danger'}}">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
                    <p>
                        {{$error}}
                    </p>
                </div>
            @endforeach
        @endif
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
                                <h2>Client Registration </h2>

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

                                    <form id="order-form" class="smart-form" action="{{URL::route('client_create')}}" method="post" novalidate="novalidate" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <header>
                                            General Information
                                        </header>

                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-6">
                                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                                        <input type="text" name="name" placeholder="Name">
                                                    </label>
                                                </section>
                                                <section class="col col-6">
                                                    <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                        <input type="text" name="company" placeholder="Company">
                                                    </label>
                                                </section>
                                            </div>

                                            <div class="row">
                                                <section class="col col-6">
                                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                                        <input type="email" name="email" placeholder="E-mail">
                                                    </label>
                                                </section>
                                                <section class="col col-6">
                                                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                                                        <input type="tel" name="phone" placeholder="Phone" data-mask="(999) 999-9999">
                                                    </label>
                                                </section>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-6">
                                                    <label class="select">
                                                        <select name="interested">
                                                            <option value="0" selected="" disabled="">Interested in</option>
                                                            <option value="1">design</option>
                                                            <option value="1">development</option>
                                                            <option value="2">illustration</option>
                                                            <option value="2">branding</option>
                                                            <option value="3">video</option>
                                                        </select> <i></i> </label>
                                                </section>
                                                <section class="col col-6">
                                                    <label class="select">
                                                        <select name="budget">
                                                            <option value="0" selected="" disabled="">Budget</option>
                                                            <option value="1">less than 5000$</option>
                                                            <option value="2">5000$ - 10000$</option>
                                                            <option value="3">10000$ - 20000$</option>
                                                            <option value="4">more than 20000$</option>
                                                        </select> <i></i> </label>
                                                </section>
                                            </div>

                                            <div class="row">
                                                <section class="col col-6">
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" name="startdate" id="startdate" placeholder="Expected start date">
                                                    </label>
                                                </section>
                                                <section class="col col-6">
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" name="finishdate" id="finishdate" placeholder="Expected finish date">
                                                    </label>
                                                </section>
                                            </div>

                                            <section>
                                                <div class="input input-file">
                                                    <span class="button"><input id="file2" type="file" name="file2" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
                                                </div>
                                            </section>

                                            <section>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" name="comment" placeholder="Tell us about your project"></textarea>
                                                </label>
                                            </section>
                                        </fieldset>
                                        <footer>
                                            <button type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                            <a href="{{url('/advertiser/add')}}" class="pull-left">
                                                <button class="btn btn-primary">
                                                    ADD Advertiser
                                                </button>
                                            </a>
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



<table class="table table-hover">
    <thead>
    <th>ردیف</th>
    <th>عنوان واحد</th>
    <th>تعداد جلسات اصلی</th>
    <th>ساعات</th>
    <th>استاد</th>
    <th>شهریه(تومان)</th>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>فن راندو مقدماتی (درخت، فیگور، فونت، شیت بندی و ... با روان نویس، ماژیک، آبرنگ، گچ، پاستیل، وایتکس و مداد رنگی)</td>
        <td>10</td>
        <td>شنبه 8 -11</td>
        <td>مهندس سارا زرنگار</td>
        <td>150000</td>
    </tr>
    <tr>
        <td>2</td>
        <td>فن پرسپکتیو کاربردی(با چند جلسه لذت کشیدن هر آنچه فکر می کنید را تجربه کنید)</td>
        <td>10</td>
        <td>دوشنبه 9-12</td>
        <td>مهندس سارا زرنگار</td>
        <td>150000</td>
    </tr>
    <tr>
        <td>3</td>
        <td></td>
        <td>10</td>
        <td>دوشنبه 9-12</td>
        <td>مهندس سارا زرنگار</td>
        <td>150000</td>
    </tr>
    </tbody>
</table>




