@if($entity_type == 'geosegment')
    <div id="geosegment_grid"></div>
    <script>
        $(function () {

            var db = {
                loadData: function (filter) {
                    return $.grep(this.geosegment, function (geosegment) {
                        return (!filter.name || geosegment.name.indexOf(filter.name) > -1)
                                && (!filter.id || geosegment.id.indexOf(filter.id) > -1)
                                && (!filter.parent || geosegment.parent.indexOf(filter.parent) > -1)
                                && (!filter.lat || geosegment.lat.indexOf(filter.lat) > -1)
                                && (!filter.lon || geosegment.lon.indexOf(filter.lon) > -1)
                                && (!filter.segment_radius || geosegment.segment_radius.indexOf(filter.segment_radius) > -1);
                    });
                }

            };

            window.db = db;

            db.geosegment = [

                @foreach($entity_obj as $index1)
                    @foreach($index1 as $index)
                {
                    "id": '{{$index->id}}',
                    "parent": '{{$index->getParent->name}}',
                    "name": '{{$index->name}}',
                    "lat": '{{$index->lat}}',
                    "lon": '{{$index->lon}}',
                    "segment_radius": '{{$index->segment_radius}}'
                    },
                    @endforeach
                @endforeach
            ];

            $("#geosegment_grid").jsGrid({
                width: "100%",
                filtering: true,
                editing: false,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 10,
                pageButtonCount: 5,
                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                    {name: "parent", title: "Parent", type: "text", width: 70},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "lat", title: "Lat", type: "text", width: 70},
                    {name: "lon", title: "Lon", type: "text", width: 70},
                    {name: "segment_radius", title: "Radius", type: "text", width: 70}
                ]

            });

        });

    </script>
@endif
@if($entity_type == 'bwlist')
    <div id="bwlist_grid"></div>
    <script>
        $(function () {

            var db = {
                loadData: function (filter) {
                    return $.grep(this.bwlist, function (bwlist) {
                        return (!filter.name || bwlist.name.indexOf(filter.name) > -1)
                                && (!filter.id || bwlist.id.indexOf(filter.id) > -1)
                                && (!filter.parent || bwlist.parent.indexOf(filter.parent) > -1);
                    });
                }

            };

            window.db = db;

            db.bwlist = [

                @foreach($entity_obj as $index1)
                    @foreach($index1 as $index)
                {
                    "id": '{{$index->id}}',
                    "parent": '{{$index->getParent->name}}',
                    "name": '{{$index->domain_name}}'
                    },
                    @endforeach
                @endforeach
            ];

            $("#bwlist_grid").jsGrid({
                width: "100%",
                filtering: true,
                editing: false,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 10,
                pageButtonCount: 5,
                controller: db,
                fields: [
                    {name: "id", title: "ID", type: "text", width: 40, align: "center",editing:false},
                    {name: "parent", title: "Parent", type: "text", width: 70},
                    {name: "name", title: "Name", type: "text", width: 70}
                ]

            });

        });

    </script>
@endif
@if($entity_type == 'creative')
    <div id="creative_grid"></div>
    <script>
        $(function () {

            var db = {

                loadData: function (filter) {
                    return $.grep(this.creative, function (creative) {
                        return (!filter.name || creative.name.indexOf(filter.name) > -1)
                                && (!filter.size || creative.size.indexOf(filter.size) > -1)
                                && (!filter.advertiser || creative.advertiser.indexOf(filter.advertiser) > -1)
                                && (!filter.id || creative.id.indexOf(filter.id) > -1);
                    });
                }

            };

            window.db = db;

            db.creative = [
                @foreach($entity_obj as $index)
                {
                    "id": 'crt{{$index->id}}',
                    "name": '{{$index->name}}',
                    "size":'{{$index->size}}',
                    "advertiser":'<a href="{{url('/client/cl'.$index->getAdvertiser->GetClientID->id.'/advertiser/adv'.$index->getAdvertiser->id.'/edit')}}">{{$index->getAdvertiser->name}}</a>',
                    @if($index->status == 'Active')
                    "status": '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-success">Active</span> </a>'
                    @elseif($index->status == 'Inactive')
                    "status": '<a id="creative{{$index->id}}" href="javascript: ChangeStatus(`creative`,`{{$index->id}}`)"><span class="label label-danger">Inactive</span> </a>'
                    @endif

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
                    {name: "id", title: "ID", width: 40, type: "text", align: "center",editing:false},
                    {name: "name", title: "Name", type: "text", width: 70},
                    {name: "size", title: "Size", type: "text", width: 50, align: "center",editing:false},
                    {name: "advertiser", title: "Advertiser", type: "text", width: 70, align: "center",editing:false},
                    {name: "status", title: "Status", width: 50, align: "center"}
                ]

            });

        });

    </script>
@endif
@if($entity_type == 'bid_profile')
    <div id="bid_profile_grid"></div>
    <script>
        $(function () {

            var db = {

                loadData: function (filter) {
                    return $.grep(this.bid_profile, function (bid_profile) {
                        return (!filter.name || bid_profile.name.indexOf(filter.name) > -1)
                                && (!filter.parent || bid_profile.parent.indexOf(filter.parent) > -1)
                                && (!filter.domain || bid_profile.domain.indexOf(filter.domain) > -1)
                                && (!filter.strategy || bid_profile.strategy.indexOf(filter.strategy) > -1)
                                && (!filter.value || bid_profile.value.indexOf(filter.value) > -1)
                                && (!filter.id || bid_profile.id.indexOf(filter.id) > -1);
                    });
                }

            };

            window.db = db;

            db.bid_profile = [
                @foreach($entity_obj as $index1)
                    @foreach($index1 as $index)
                {
                    "id": '{{$index->id}}',
                    "parent": '{{$index->getParent->name}}',
                    "domain": '{{$index->domain}}',
                    "strategy": '{{$index->bid_strategy}}',
                    "value": '{{$index->bid_value}}'

                    },
                    @endforeach
                @endforeach
            ];

            $("#bid_profile_grid").jsGrid({
                width: "100%",
                filtering: true,
                editing: false,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 10,
                pageButtonCount: 5,
                controller: db,
                fields: [
                    {name: "id", title: "ID", width: 40, type: "text", align: "center"},
                    {name: "parent", title: "Parent", type: "text", width: 70},
                    {name: "domain", title: "Domain", type: "text", width: 70},
                    {name: "strategy", title: "Strategy", type: "text", width: 70},
                    {name: "value", title: "Value", type: "text", width: 70}
                ]

            });

        });

    </script>
@endif