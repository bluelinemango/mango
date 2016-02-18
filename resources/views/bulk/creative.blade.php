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
                    <div class="">

                        <form id="order-form" class="smart-form" action="{{URL::route('creative_bulk_update')}}"
                              method="post" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <header>
                                General Information
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-2">
                                        <label class="label" for=""> Name</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="name" placeholder="Name" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label" for="">Domain Name</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="advertiser_domain_name" placeholder="Domain Name" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label for="" class="label">Status</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="active">
                                            <i></i>
                                        </label>
                                    </section>

                                    <section class="col col-2">
                                        <label for="" class="label">Ad Type</label>
                                        <label class="select"><i></i>
                                            <select name="ad_type">
                                                <option value="0">Select One</option>
                                                <option value="IFRAME">IFrame</option>
                                                <option value="JAVASCRIPT">Javascript</option>
                                                <option value="XHTML_BANNER_AD">XHTML Banner Ad</option>
                                                <option value="XHTML_TEXT_AD">XHTML Text Ad</option>

                                            </select>
                                        </label>
                                    </section>

                                </div>
                            </fieldset>
                            <header>
                                URL infromation
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label" for="">Ad Tag</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="ad_tag" placeholder="Ad Tag" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Landign Page URL</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="landing_page_url" placeholder="Landign Page URL" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Width</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="size_width" placeholder="Width" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Height</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="size_height" placeholder="Height" readonly>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label" for="">Attributes</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="attributes" placeholder="Attributes" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Preview URL</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="preview_url" placeholder="Preview URL" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">API</label>
                                        <label class="select select-multiple">
                                            <select name="api[]" multiple class="custom-scroll">
                                                <option value="VPAID_1.0">VPAID 1.0</option>
                                                <option value="VPAID_2.0">VPAID 2.0</option>
                                                <option value="MRAID-1"> MRAID-1</option>
                                                <option value="ORMMA">ORMMA</option>
                                                <option value="MRAID-2">MRAID-2</option>
                                            </select> </label>

                                        <div class="note">
                                            <strong>Note:</strong> hold down the ctrl/cmd button to select multiple
                                            options.
                                        </div>
                                    </section>

                                </div>
                                <section>
                                    <label class="label" for="">Description</label>
                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                        <textarea rows="5" name="description"
                                                  placeholder="Tell us about your Creative"></textarea>
                                    </label>
                                </section>
                            </fieldset>
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
                            <input type="hidden" name="creative_list" id="creative_list">
                            <div class="well col-md-12" id="showCreativeList">
                                <div id="creative_grid"></div>
                            </div>

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

<script>
    $("select[name='client_id']").change(function () {
        $('input[name="creative_list"]').val('');
        $('#showCreativeList').html('');
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
        $('input[name="creative_list"]').val('');
        $('#showCreativeList').html('');
        var ad_id = $(this).val();
        if (ad_id != 'all') {
            $.ajax({
                url: "{{url('ajax/getCreativeList')}}" + '/' + ad_id
            }).success(function (response) {
                $('#showCreativeList').html(response);

            });
        } else {
            $('#showCreativeList').html("");
        }
    });
    var creative_list=[];

    $(function () {

        var db = {

            loadData: function (filter) {
                return $.grep(this.creative, function (creative) {
                    return (!filter.name || creative.name.indexOf(filter.name) > -1)
                            && (!filter.size || creative.size.indexOf(filter.size) > -1)
                            && (!filter.advertiser || creative.advertiser.indexOf(filter.advertiser) > -1)
                            && (!filter.id || creative.id.indexOf(filter.id) > -1);
                });
            },

            updateItem: function (updatingCreative) {
                updatingCreative['oper'] = 'edit';
                console.log(updatingCreative);
                $.ajax({
                    type: "PUT",
                    url: "{{url('/ajax/jqgrid/creative')}}",
                    data: updatingCreative,
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

        db.creative = [
            @foreach($creative_obj as $index)
            {
                "id": '{{$index->id}}',
                "name": '{{$index->name}}',
                "size":'{{$index->size}}',
                "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                @if($index->status == 'Active')
                "status": '<span class="label label-success">Active</span> ',
                @elseif($index->status == 'Inactive')
                "status": '<span class="label label-danger">Inactive</span>',
                @endif
                "date_modify": '{{$index->updated_at}}'

            },
            @endforeach
        ];

        $("#creative_grid").jsGrid({
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
                                    $(this).is(":checked") ? creative_list.push(item.id) : creative_list.splice(item.id, 1);
                                    $('#creative_list').val(creative_list);
                                });
                    },
                    align: "center",
                    width: 50
                },
                {name: "id", title: "ID", width: 40, type: "text", align: "center",editing:false},
                {name: "name", title: "Name", type: "text", width: 70},
                {name: "size", title: "Size", type: "text", width: 50, align: "center",editing:false},
                {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center",editing:false},
                {name: "status", title: "Status", width: 50, align: "center"},
                {name: "date_modify", title: "Last Modified", align: "center"}
            ]

        });

    });

</script>
