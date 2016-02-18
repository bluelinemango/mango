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
                                                <input type="text" name="name" placeholder="Name" readonly>
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
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
                                                <input type="checkbox" name="active" readonly="readonly">
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
                                            <input type="text" name="max_impression" placeholder="Max Impression" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Daily Max Impression</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="daily_max_impression"
                                                   placeholder="Daily Max Impression" readonly>
                                        </label>
                                    </section>
                                </fieldset>
                            </div>
                            <div class="well col-md-6 ">

                                <fieldset>
                                    <section class="col col-3">
                                        <label class="label" for="">Max Budget</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="max_budget" placeholder="Max Budget" readonly="readonly">
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Daily Max Budget</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="daily_max_budget" placeholder="Daily Max Budget" readonly="readonly">
                                        </label>
                                    </section>
                                </fieldset>
                            </div>
                            <div class="clearfix"></div>
                            <div class="well col-md-6">

                                <fieldset>
                                    <section class="col col-3">
                                        <label class="label" for="">CPM</label>
                                        <label class="input"> <i class="icon-append fa fa-dollar"></i>
                                            <input type="text" name="cpm" placeholder="CPM" readonly="readonly">
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
                                                <input type="text" name="start_date" id="startdate"
                                                       placeholder="Expected start date" readonly="readonly">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label" for="">End Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="end_date" id="finishdate"
                                                       placeholder="Expected finish date" readonly="readonly">
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
                            <div class="well col-md-12">
                                <div class="col-md-3">
                                    <label class="label" for="">Select Client</label>
                                     <select name="client_id">
                                        <option value="all">All Client</option>
                                        @foreach($client_obj as $index)
                                            <option value="{{$index->id}}">{{$index->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="label" for="">Select Advertiser</label>
                                    <select name="advertiser_id">
                                        <option value="0">All Advertiser</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="campaign_list" id="campaign_list">
                            <div class="well col-md-12" id="showCapmaignList">
                                <div id="campaign_grid"></div>
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

<script>
    $("select[name='client_id']").change(function () {
        $('input[name="campaign_list"]').val('');
        $('#showCapmaignList').html('');
        var ad_id = $(this).val();
        if (ad_id != 'all') {
            $.ajax({
                url: "{{url('ajax/getAdvertiserSelect')}}" + '/' + ad_id
            }).success(function (response) {
                $('select[name="advertiser_id"]').html(response);
            });
        } else {
            $('select[name="advertiser_id"]').html("");
        }
    });
    $("select[name='advertiser_id']").change(function () {
        $('input[name="campaign_list"]').val('');
        $('#showCapmaignList').html('');
        var ad_id = $(this).val();
        if (ad_id != 'all') {
            $.ajax({
                url: "{{url('ajax/getCampaignList')}}" + '/' + ad_id
            }).success(function (response) {
                $('#showCapmaignList').html(response);

            });
        } else {
            $('#showCapmaignList').html("");
        }
    });

</script>
<script>
    var campaing_list=[];
    $(function () {

        var db = {

            loadData: function (filter) {
                return $.grep(this.campaign, function (campaign) {
                    return (!filter.name || campaign.name.indexOf(filter.name) > -1)
                            && (!filter.daily_max_imp || campaign.daily_max_imp.indexOf(filter.daily_max_imp) > -1)
                            && (!filter.cpm || campaign.cpm.indexOf(filter.cpm) > -1)
                            && (!filter.id || campaign.id.indexOf(filter.id) > -1)
                            && (!filter.daily_max_budget || campaign.daily_max_budget.indexOf(filter.daily_max_budget) > -1);
                });
            },

            updateItem: function (updatingCampaign) {
                updatingCampaign['oper'] = 'edit';
                console.log(updatingCampaign);
                $.ajax({
                    type: "PUT",
                    url: "{{url('/ajax/jqgrid/campaign')}}",
                    data: updatingCampaign,
                    dataType: "json"
                }).done(function (response) {
                    console.log(response);
                    if(response.success==true){
                        var title= "Success";
                        var color="#739E73";
                        var icon="fa fa-check";
                    }else if(response.success==false) {
                        var title= "Warning";
                        var color="#C46A69";
                        var icon="fa fa-bell";
                    };

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

        db.campaign = [
            @foreach($campaign_obj as $index)
            {
                "id": '{{$index->id}}',
                "name": '{{$index->name}}',
                "daily_max_imp":'{{$index->daily_max_impression}}',
                "cpm":'{{$index->cpm}}',
                "daily_max_budget":'{{$index->daily_max_budget}}',
                @if($index->status == 'Active')
                "status": '<span class="label label-success">Active</span>',
                @elseif($index->status == 'Inactive')
                "status": '<span class="label label-danger">Inactive</span> ',
                @endif
                "date_modify": '{{$index->updated_at}}'

            },
            @endforeach
        ];

        $("#campaign_grid").jsGrid({
            width: "100%",

            filtering: true,
            editing: false,
            sorting: true,
            paging: true,
            autoload: true,

            pageSize: 15,
            pageButtonCount: 5,

            deleteConfirm: "Do you really want to delete the client?",

            controller: db,
            fields: [
                {
                    headerTemplate: function() {
                        return 'Check';
                    },
                    itemTemplate: function(_, item) {
                        return $("<input>").attr("type", "checkbox")
                                .on("change", function () {
                                    console.log(item.id);
                                    $(this).is(":checked") ? campaing_list.push(item.id) : campaing_list.splice(item.id, 1);
                                    $('#campaign_list').val(campaing_list);
                                });
                    },
                    align: "center",
                    width: 50
                },
                {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                {name: "name", title: "Name", type: "text", width: 70},
                {name: "daily_max_imp", title: "Daily Imps", type: "text", width: 70, align: "center"},
                {name: "cpm", title: "CPM", type: "text", width: 60, align: "center"},
                {name: "daily_max_budget", title: "Daily Budget", type: "text", width: 80, align: "center"},
                {name: "status", title: "Status", width: 50, align: "center"},
                {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
            ]

        });

    });

</script>
