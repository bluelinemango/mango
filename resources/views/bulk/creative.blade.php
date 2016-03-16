
<div class="">

    <form id="order-form" class="smart-form" action="{{URL::route('creative_bulk_update')}}"
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
                                       class="form-control" placeholder="Domain Name"
                                       id="advertiser_domain_name" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="control-label" for="active">Status</label>

                        <div class="switcher">
                            <input type="checkbox" name="active" hidden disabled id="active">
                            <label for="active"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="ad_type">Ad Type</label>

                        <div class="">
                            <select name="ad_type" class="selecter" id="ad_type" disabled>
                                <option value="0">Select One</option>
                                <option value="IFRAME">IFrame
                                </option>
                                <option value="JAVASCRIPT">Javascript
                                </option>
                                <option value="XHTML_BANNER_AD">XHTML Banner Ad
                                </option>
                                <option value="XHTML_TEXT_AD">XHTML Text Ad
                                </option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--.form-group-->
            </div>
            <hr/>

            <div class="note note-info note-bottom-striped">
                <h4>URL infromation</h4>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="landing_page_url" class="control-label">Landign Page
                            URL</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="landing_page_url"
                                       placeholder="Landign Page URL" id="landing_page_url"
                                       class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="attributes">Attributes</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="attributes" placeholder="Attributes"
                                       class="form-control" id="attributes" disabled>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="preview_url">Preview URL</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="preview_url" placeholder="Preview URL"
                                       class="form-control" id="preview_url" disabled>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="api">API</label>

                        <select name="api[]" multiple class="selecter" id="api" disabled>
                            <option value="VPAID_1.0">VPAID 1.0
                            </option>
                            <option value="VPAID_2.0">VPAID 2.0
                            </option>
                            <option value="MRAID-1"> MRAID-1
                            </option>
                            <option value="ORMMA">ORMMA
                            </option>
                            <option value="MRAID-2">MRAID-2
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1 ">
                    <div class="form-group">
                        <label class="control-label" for="size_width">Width</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="size_width" placeholder="Width"
                                       class="form-control"
                                       id="size_width" disabled>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 ">
                    <div class="form-group">
                        <label class="control-label" for="size_height">Height</label>

                        <div class="inputer">
                            <div class="input-wrapper">
                                <input type="text" name="size_height" placeholder="Height"
                                       id="size_height"
                                       class="form-control" disabled>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <hr/>

            <div class="note note-warning note-bottom-striped">
                <div class="form-group">
                    <label class="control-label" for="ad_tag">Ad Tag</label>

                    <div class="inputer">
                        <div class="input-wrapper">
                        <textarea name="ad_tag" class="form-control" rows="3"
                                  placeholder="type minimum 5 characters" id="ad_tag" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>

            <div class="form-group">
                <label class="control-label">Description</label>

                <div class="inputer">
                    <div class="input-wrapper">
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="type minimum 5 characters"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="size_height">Select Client</label>

                        <select name="client_id" class="selecter">
                            <option value="all">All Client</option>
                            @foreach($client_obj as $index)
                                <option value="{{$index->id}}">{{$index->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" for="size_height">Select Advertiser</label>

                        <select name="advertiser_id" class="selecter">
                            <option value="0">All Advertiser</option>
                        </select>
                    </div>
                </div>

            </div>
            <input type="hidden" name="creative_list" id="creative_list">
            <div class="well col-md-12" id="showCreativeList">
                <div id="creative_grid"></div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-5 col-md-9" style="padding: 25px 0">
                        <button type="submit" class="btn btn-success" style="width:20%">Submit
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

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
                $.ajax({
                    url: "{{url('ajax/getCreativeList/client')}}" + '/' + ad_id
                }).success(function (response) {
                    $('#showCreativeList').html(response);
                });
                $('select.selecter').selectpicker('refresh');

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
                url: "{{url('ajax/getCreativeList/advertiser')}}" + '/' + ad_id
            }).success(function (response) {
                $('#showCreativeList').html(response);
                $('select.selecter').selectpicker('refresh');
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


    var $orderForm = $("#order-form").validate({
        // Rules for form validation
        rules : {
            name : {
                required : true
            },
            advertiser_id : {
                required : true
            },
            advertiser_domain_name : {
                required : true,
                domain: true
            },
            ad_tag : {
                required : true
            },
            landing_page_url : {
                required : true
            },
            size_width : {
                required : true,
                min: 0,
                number: 'Enter number Plz'
            },
            size_height : {
                required : true,
                min: 0,
                number: 'Enter number Plz'
            },
            attributes : {
                required : true
            },
            preview_url : {
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

    $('select.selecter').selectpicker();
//    Pleasure.init();


</script>
