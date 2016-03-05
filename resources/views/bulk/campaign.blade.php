<div style="padding: 20px">

    <form id="order-form" class="smart-form" action="{{URL::route('campaign_bulk_update')}}"
          method="post" novalidate="novalidate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-body">
            <div class="note note-primary note-bottom-striped">
                <h4>General Informaition</h4>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="name">Name</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" id="name" name="name" placeholder="Name"
                                       class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="advertiser_domain_name">Domain Name</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="advertiser_domain_name"
                                       class="form-control" placeholder="Domain Name" id="advertiser_domain_name" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="control-label" for="active">Status</label>
                        <div class="checkboxer">
                            <input type="checkbox" id="active" name="active" class="switchery-teal" disabled>
                            <label for="check1">Active</label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--.form-group-->
            </div>
            <hr/>

            <div class="note note-info note-bottom-striped">
                <h4>Budget Informaition</h4>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="max_impression">Max Impression</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="max_impression"
                                       placeholder="Max Impression"
                                       id="max_impression"
                                       class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">

                    <div class="form-group">
                        <label class="control-label" for="daily_max_impression">Daily Max Impression</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="daily_max_impression"
                                       placeholder="Daily Max Impression"
                                       id="daily_max_impression"
                                       class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="max_budget">Max Budget</label>

                        <div class="inputer">
                            <div class="input-wrapper">

                                <input type="text" name="max_budget" disabled
                                       placeholder="Max Budget" class="form-control" id="max_budget">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="daily_max_budget">Daily Max Budget</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="daily_max_budget" disabled
                                       placeholder="Daily Max Budget" class="form-control" id="daily_max_budget">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="cpm">cpm</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="cpm" disabled placeholder="CPM" id="cpm"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <hr/>

            <div class="note note-warning note-bottom-striped">
                <div class="control-group">
                    <div class="controls">
                        <label class="control-label" for="date_range">Date Range</label>
                        <div class="input-group">
                            <span class="add-on input-group-addon"><i class="ion-android-calendar"></i></span>
                            <div class="inputer">
                                <div class="input-wrapper">
                                    <input type="text" style="width: 200px" name="date_range" class="form-control bootstrap-daterangepicker-basic-range" value="" id="date_range" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>


            <div class="form-group">
                <label class="control-label" for="description">Description</label>

                <div class="inputer">
                    <div class="input-wrapper">
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="type minimum 5 characters"
                              id="description" ></textarea>
                    </div>
                </div>
            </div>
            <div class="note note-primary note-bottom-striped">

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="name">Select Client</label>

                        <select name="client_id" class="selecter">
                            <option value="all">All Client</option>
                            @foreach($client_obj as $index)
                                <option value="{{$index->id}}">{{$index->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="name">Select Advertiser</label>

                        <select name="advertiser_id" class="selecter">
                            <option value="0">All Advertiser</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--.form-group-->
            </div>

            <input type="hidden" name="campaign_list" id="campaign_list">

            <div class="well col-md-12" id="showCapmaignList">
                <div id="campaign_grid"></div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                        <button type="submit" class="btn btn-success" style="width:20%">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
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
    $('select.selecter').selectpicker();

</script>
<script>
    var campaing_list = [];
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

        db.campaign = [
            @foreach($campaign_obj as $index)
            {
                "id": '{{$index->id}}',
                "name": '{{$index->name}}',
                "daily_max_imp": '{{$index->daily_max_impression}}',
                "cpm": '{{$index->cpm}}',
                "daily_max_budget": '{{$index->daily_max_budget}}',
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
                    headerTemplate: function () {
                        return 'Check';
                    },
                    itemTemplate: function (_, item) {
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
                {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
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
