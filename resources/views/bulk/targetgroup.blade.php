<form id="order-form" class="smart-form" action="{{URL::route('targetgroup_bulk_update')}}"
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
                    <label class="control-label" for="iab_category">IAB
                        Category</label>
                    <select name="iab_category"
                            class="selecter "
                            id="iab_category" disabled
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
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="iab_sub_category">IAB Sub
                        Category</label>
                    <select name="iab_sub_category"
                            class="selecter"
                            id="iab_sub_category">
                        <option value="0"
                                disabled>
                            Select Iab
                            Category First
                            ...
                        </option>
                    </select>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="domain_name">Domain Name</label>

                    <div class="inputer">
                        <div class="input-wrapper">
                            <input type="text" id="domain_name" name="domain_name" placeholder="Domain Name"
                                   class="form-control" disabled>
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
            <div class="col-md-3 ">
                <div class="form-group">
                    <label class="control-label" for="frequency_in_sec">Frequency In Sec </label>

                    <div class="inputer">
                        <div class="input-wrapper">
                            <input type="text" name="frequency_in_sec" disabled placeholder="Frequency per sec"
                                   id="frequency_in_sec"
                                   class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="form-group">
                    <label class="control-label" for="pacing_plan">Pacing Plan</label>

                    <div class="inputer">
                        <div class="input-wrapper">
                            <input type="text" name="pacing_plan" disabled placeholder="Pacing Plan" id="pacing_plan"
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
                                <input type="text" style="width: 200px" name="date_range"
                                       class="form-control bootstrap-daterangepicker-basic-range" value=""
                                       id="date_range"/>
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
                              id="description" disabled></textarea>
                </div>
            </div>
        </div>

        <div class="note note-warning note-bottom-striped">
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
                                        <div id="{{$i}}-{{$j}}-time" class="time_table_unselect"></div>

                                        <input type="checkbox" name="{{$i}}-{{$j}}-hour"
                                               id="{{$i}}-{{$j}}-time-checkbox" style="display: none"/>
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
            <div class="clearfix"></div>
        </div>
        <hr/>
        <div class="note note-warning note-bottom-striped"  id="show_assign">
            <h4>Manage Assign</h4>

        </div>
        <hr/>
        <div class="note note-primary note-bottom-striped">

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="client_id">Select Client</label>
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
                    <label class="control-label" for="advertiser_id">Select Advertiser</label>

                    <select name="advertiser_id" class="selecter">
                        <option value="0">All Advertiser</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="campaign_id">Select Campaign</label>

                    <select name="campaign_id" class="selecter">
                        <option value="0">All Campaign</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <!--.form-group-->
        </div>
        <hr/>
        <input type="hidden" name="tg_list" id="tg_list">

        <div class="col-md-12" id="showTargetgroupList">
            <div id="targetgroup_grid"></div>
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


<script>
    $('select.selecter').selectpicker();

    for (var i = 0; i < 7; i++) {
        for (var j = 0; j < 24; j++) {
            $('#' + i + '-' + j + '-time').click(function () {
                var id = $(this).attr('id');
                if ($(this).hasClass('time_table_unselect')) {
                    $('#' + id + '-checkbox').prop('checked', true);
                    $('#' + id + '-review').removeClass();
                    $('#' + id + '-review').addClass('time-table-div-select');
                    $(this).removeClass();
                    $(this).addClass('time-table-div-select');
                } else {
                    $('#' + id + '-checkbox').prop('checked', false);
                    $('#' + id + '-review').removeClass();
                    $('#' + id + '-review').addClass('time_table_unselect');
                    $(this).removeClass();
                    $(this).addClass('time_table_unselect');

                }
            });
        }
    }

    $('#clear_all').click(function () {
        for (var i = 0; i < 7; i++) {
            for (var j = 0; j < 24; j++) {
                var id = $('#' + i + '-' + j + '-time').attr('id');
                $('#' + id + '-checkbox').prop('checked', false);
                $('#' + i + '-' + j + '-time').removeClass();
                $('#' + i + '-' + j + '-time').addClass('time_table_unselect');
            }
        }

    });

    $('#suggested').change(function () {
        if ($(this).val() == 'business-hours') {
            $('#clear_all').click();
            for (var i = 0; i < 5; i++) {
                for (var j = 9; j < 17; j++) {
                    var id = $('#' + i + '-' + j + '-time').attr('id');
                    $('#' + id + '-checkbox').prop('checked', true);
                    $('#' + i + '-' + j + '-time').removeClass();
                    $('#' + i + '-' + j + '-time').addClass('time-table-div-select');
                }
            }
        }
        if ($(this).val() == 'happy-hours') {
            $('#clear_all').click();
            for (var i = 0; i < 5; i++) {
                for (var j = 17; j < 24; j++) {
                    var id = $('#' + i + '-' + j + '-time').attr('id');
                    $('#' + id + '-checkbox').prop('checked', true);
                    $('#' + i + '-' + j + '-time').removeClass();
                    $('#' + i + '-' + j + '-time').addClass('time-table-div-select');
                }
            }
            for (var i = 5; i < 7; i++) {
                for (var j = 0; j < 24; j++) {
                    var id = $('#' + i + '-' + j + '-time').attr('id');
                    $('#' + id + '-checkbox').prop('checked', true);
                    $('#' + i + '-' + j + '-time').removeClass();
                    $('#' + i + '-' + j + '-time').addClass('time-table-div-select');
                }
            }
        }
    });

    var tg_list = [];

    $(function () {
        var db = {
            loadData: function (filter) {
                return $.grep(this.targetgroup, function (targetgroup) {
                    return (!filter.name || targetgroup.name.indexOf(filter.name) > -1)
                            && (!filter.campaign_name || targetgroup.campaign_name.indexOf(filter.campaign_name) > -1)
                            && (!filter.id || targetgroup.id.indexOf(filter.id) > -1);
                });
            }

        };
        window.db = db;
        db.targetgroup = [
            @foreach($targetgroup_obj as $index)
            {
                "id": '{{$index->id}}',
                "name": '{{$index->name}}',
                "campaign_name": '<a href="{{url('/client/cl'.$index->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getCampaign->getAdvertiser->id.'/campaign/cmp'.$index->getCampaign->id.'/edit')}}">{{$index->getCampaign->name}}</a>',
                @if($index->status == 'Active')
                "status": '<span class="label label-success">Active</span>',
                @elseif($index->status == 'Inactive')
                "status": '<span class="label label-danger">Inactive</span> ',
                @endif
                "date_modify": '{{$index->updated_at}}'

            },
            @endforeach
        ];

        $("#targetgroup_grid").jsGrid({
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
                                    $(this).is(":checked") ? tg_list.push(item.id) : tg_list.splice(item.id, 1);
                                    $('#tg_list').val(tg_list);
                                });
                    },
                    align: "center",
                    width: 50
                },
                {name: "id", title: "ID", type: "text", width: 40, align: "center", editing: false},
                {name: "name", title: "Name", type: "text", width: 70},
                {name: "campaign_name", title: "Campaign", type: "text", width: 70, align: "center", editing: false},
                {name: "status", title: "Status", width: 50, align: "center"},
                {name: "date_modify", title: "Last Modified", width: 70, align: "center"}
            ]

        });

    });

    $("select[name='client_id']").change(function () {
        $('input[name="targetgroup_list"]').val('');
        $('#showTargetgroupList').html('');
        var ad_id = $(this).val();
        if (ad_id != 'all') {
            $.ajax({
                url: "{{url('ajax/getAdvertiserSelect')}}" + '/' + ad_id
            }).success(function (response) {
                $('select[name="advertiser_id"]').html(response);
                $('select.selecter').selectpicker('refresh');
            });
        } else {
            $('select[name="advertiser_id"]').html("");
        }
    });

    $("select[name='advertiser_id']").change(function () {
        $('input[name="targetgroup_list"]').val('');
        $('#showTargetgroupList').html('');
        var ad_id = $(this).val();
        if (ad_id != 'all') {
            $.ajax({
                url: "{{url('ajax/getCampaignSelect')}}" + '/' + ad_id
            }).success(function (response) {
                console.log(response);
                $('select[name="campaign_id"]').html(response);
                $('select.selecter').selectpicker('refresh');

            });
            $.ajax({
                url: "{{url('ajax/getAssignList')}}" + '/' + ad_id
            }).success(function (response) {
                $('#assign_box').remove();
                $('#show_assign').append(response);
                $('#show_assign').append('<div class="clearfix"></div>');

            });
        } else {
            $('select[name="campaign_id"]').html("");
            $('#show_assign').html("");
        }
    });

    $("select[name='campaign_id']").change(function () {
        console.log('ss');
        $('input[name="targetgroup_list"]').val('');
        $('#showTargetgroupList').html('');
        var ad_id = $(this).val();
        if (ad_id != 'all') {
            $.ajax({
                url: "{{url('ajax/getTargetgroupList')}}" + '/' + ad_id
            }).success(function (response) {
                $('#showTargetgroupList').html(response);

            });
        } else {
            $('#showTargetgroupList').html("");
        }
    });

</script>
