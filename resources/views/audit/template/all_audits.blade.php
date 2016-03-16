{{--{{dd($audit_obj)}}--}}
@for($i=0;$i<count($audit_obj);)
    @if(isset($audit_obj[$i]))
    <div class="frame">
        <div class="timeline-badge">
            <i class="fa fa-headphones"></i>
        </div>
        <!--.timeline-badge-->
        {{--                                                @foreach($audit_obj as $index)--}}
        <?php $change_key = $audit_obj[$i]->change_key;
        $entity_type = $audit_obj[$i]->entity_type; $save = ''; $body = '' ?>
        <span class="timeline-date">{{\Carbon\Carbon::now()->subSeconds(time()-$audit_obj[$i]->created_at->getTimestamp())->diffForHumans()}}</span>

        <div class="time-line-title">
            <a href="{{url('user/usr'.$audit_obj[$i]->user_id.'/edit')}}">{{$audit_obj[$i]->getUser->name}}</a>
            @if($audit_obj[$i]->audit_type == 'add')
                @if($audit_obj[$i]->entity_type == 'positive_offer_model' or $audit_obj[$i]->entity_type == 'negative_offer_model')
                    changed Model:
                @elseif($audit_obj[$i]->entity_type == 'offer_pixel_map')
                    changed Offer:
                @elseif($audit_obj[$i]->entity_type == 'targetgroup_creative_map')
                    changed Target Group:
                @elseif($audit_obj[$i]->entity_type == 'targetgroup_geolocation_map')
                    changed Target Group:
                @elseif($audit_obj[$i]->entity_type == 'targetgroup_segment_map')
                    changed Target Group:
                @elseif($audit_obj[$i]->entity_type == 'targetgroup_geosegment_map')
                    changed Target Group:
                @elseif($audit_obj[$i]->entity_type == 'targetgroup_bwlist_map')
                    changed Target Group:
                @elseif($audit_obj[$i]->entity_type == 'targetgroup_bidprofile_map')
                    changed Target Group:
                @elseif($audit_obj[$i]->entity_type == 'advertiser_model_map')
                    changed Advertiser:
                {{--@elseif($audit_obj[$i]->entity_type == 'geosegmententrie')--}}
                    {{--changed Geo Segment: gsm{{$audit_obj[$i]->entity_id}}--}}
                @else
                    created a new {{$audit_obj[$i]->entity_type}}:
                @endif
            @elseif($audit_obj[$i]->audit_type == 'bulk_edit')
                Bulk Edit {{$audit_obj[$i]->entity_type}}:
            @elseif($audit_obj[$i]->audit_type == 'edit')
                changed {{$audit_obj[$i]->entity_type}}:
            @elseif($audit_obj[$i]->audit_type == 'del')
                deleted {{$audit_obj[$i]->entity_type}}:
            @endif
            @if($audit_obj[$i]->entity_type == 'client')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->id.'/edit')}}">cl{{$audit_obj[$i+1]->id}}</a>

            @endif
            @if($audit_obj[$i]->entity_type == 'advertiser')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->id.'/edit')}}">adv{{$audit_obj[$i+1]->id}}</a>

            @endif
            @if($audit_obj[$i]->entity_type == 'creative' and $audit_obj[$i]->audit_type =='bulk_edit')
                <?php $flg_content = 0; ?>
                <?php $body .= "<p><strong>" . $audit_obj[$i]->field . "</strong> to <strong>" . $audit_obj[$i]->after_value . "</strong></p>"?>
                @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='bulk_edit')
                    @if(isset($audit_obj[$i+2]) and $audit_obj[$i]->entity_id == $audit_obj[$i+2]->entity_id and $flg_content == 0)
                        <?php $body .= "<p><strong>" . $audit_obj[$i + 2]->field . "</strong> to <strong>" . $audit_obj[$i + 2]->after_value . "</strong></p>"?>
                    @else
                        <?php $flg_content = 1; ?>
                    @endif
                    @if($save != $audit_obj[$i+1]->id)
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/creative/crt'.$audit_obj[$i+1]->id.'/edit')}}">crt{{$audit_obj[$i+1]->id}}</a>
                            ,
                        </strong>
                    @endif
                    <?php $save = $audit_obj[$i+1]->id ?>
                    <?php $i = $i + 2; ?>
                @endwhile
                @if(!isset($audit_obj[$i]))
                    <?php continue ?>
                @endif
            @elseif($audit_obj[$i]->entity_type == 'creative')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/creative/crt'.$audit_obj[$i+1]->id.'/edit')}}">crt{{$audit_obj[$i+1]->id}}</a>

            @endif

            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'offer')
               <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/offer/ofr'.$audit_obj[$i+1]->id.'/edit')}}">ofr{{$audit_obj[$i+1]->id}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'pixel')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/pixel/pxl'.$audit_obj[$i+1]->id.'/edit')}}">pxl{{$audit_obj[$i+1]->id}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'bwlist')
               <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/bwlist/bwl'.$audit_obj[$i+1]->id.'/edit')}}">{{$audit_obj[$i+1]->name}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'geosegment')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/geosegment/gsm'.$audit_obj[$i+1]->id.'/edit')}}">{{$audit_obj[$i+1]->name}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'campaign' and $audit_obj[$i]->audit_type =='bulk_edit')
                <?php $flg_content = 0; ?>
                <?php $body .= "<p><strong>" . $audit_obj[$i]->field . "</strong> to <strong>" . $audit_obj[$i]->after_value . "</strong></p>"?>
                @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='bulk_edit')

                    @if(isset($audit_obj[$i+2]) and $audit_obj[$i]->entity_id == $audit_obj[$i+2]->entity_id and $flg_content == 0)

                        <?php $body .= "<p><strong>" . $audit_obj[$i + 2]->field . "</strong> to <strong>" . $audit_obj[$i + 2]->after_value . "</strong></p>"?>
                    @else
                        <?php $flg_content = 1; ?>
                    @endif
                    @if($save != $audit_obj[$i+1]->id)
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/campaign/cmp'.$audit_obj[$i+1]->id.'/edit')}}">cmp{{$audit_obj[$i+1]->id}}</a>,
                        </strong>
                    @endif
                    <?php $save = $audit_obj[$i+1]->id ?>
                    <?php $i = $i + 2; ?>
                @endwhile
            @elseif(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'campaign')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/campaign/cmp'.$audit_obj[$i+1]->id.'/edit')}}">cmp{{$audit_obj[$i+1]->id}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'modelTable')
               <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/model/mdl'.$audit_obj[$i+1]->id.'/edit')}}">mdl{{$audit_obj[$i+1]->id}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'positive_offer_model' or $audit_obj[$i]->entity_type == 'negative_offer_model')
               <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/model/mdl'.$audit_obj[$i]->after_value.'/edit')}}">mdl{{$audit_obj[$i]->after_value}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'advertiser_model_map')
              <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/edit')}}">adv{{$audit_obj[$i]->after_value}}</a>

            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'offer_pixel_map')
               <a href="{{url('client/cl'.$audit_obj[$i+1]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getAdvertiser->id.'/offer/ofr'.$audit_obj[$i]->after_value.'/edit')}}">ofr{{$audit_obj[$i]->after_value}}</a>

            @endif

            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'targetgroup' and $audit_obj[$i]->audit_type =='bulk_edit')
                <?php $flg_content = 0; ?>
                <?php $body .= "<p><strong>" . $audit_obj[$i]->field . "</strong> to <strong>" . $audit_obj[$i]->after_value . "</strong></p>"?>
                @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='bulk_edit')
                    @if(isset($audit_obj[$i+2]) and $audit_obj[$i]->entity_id == $audit_obj[$i+2]->entity_id and $flg_content == 0)
                        <?php $body .= "<p><strong>" . $audit_obj[$i + 2]->field . "</strong> to <strong>" . $audit_obj[$i + 2]->after_value . "</strong></p>"?>
                    @else
                        <?php $flg_content = 1; ?>
                    @endif
                    @if($save != $audit_obj[$i+1]->id)
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1]->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getCampaign->getAdvertiser->id.'/campaign/cmp'.$audit_obj[$i+1]->getCampaign->id.'/targetgroup/tg'.$audit_obj[$i+1]->id.'/edit')}}">tg{{$audit_obj[$i+1]->id}}</a>
                            ,
                        </strong>
                    @endif
                    <?php $save = $audit_obj[$i+1]->id ?>
                    <?php $i = $i + 2; ?>
                @endwhile
            @elseif(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'targetgroup')
                <a href="{{url('client/cl'.$audit_obj[$i+1]->getCampaign->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1]->getCampaign->getAdvertiser->id.'/campaign/cmp'.$audit_obj[$i+1]->getCampaign->id.'/targetgroup/tg'.$audit_obj[$i+1]->id.'/edit')}}">{{$audit_obj[$i+1]->name}}</a>

            @endif
            <?php $map=array('targetgroup_creative_map','targetgroup_geolocation_map','targetgroup_segment_map','targetgroup_geosegment_map','targetgroup_bwlist_map','targetgroup_bidprofile_map',)?>
            @if(isset($audit_obj[$i]) and in_array($audit_obj[$i]->entity_type,$map))
                tg{{$audit_obj[$i]->after_value}}
            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'geosegmententrie')
                @if($audit_obj[$i]->audit_type == 'del')
                    <strong>{{$audit_obj[$i]->before_vale}}</strong>
                    from
                    <strong>GSL{{$audit_obj[$i]->after_value}}</strong>
                @else
                    <strong>GS{{$audit_obj[$i]->entity_id}} </strong>
                    for
                    <strong>GSL{{$audit_obj[$i]->after_value}}</strong>
                @endif
            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'bwlistentrie')
                @if($audit_obj[$i]->audit_type == 'del')
                    <strong>{{$audit_obj[$i]->before_vale}}</strong>
                    from
                    <strong>BWL{{$audit_obj[$i]->after_value}}</strong>
                @else
                    <strong>BWE{{$audit_obj[$i]->entity_id}} </strong>
                    for
                    <strong>BWL{{$audit_obj[$i]->after_value}}</strong>
                @endif
            @endif
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->entity_type == 'bid_profile_entry')
                @if($audit_obj[$i]->audit_type == 'del')
                    <strong>BPE{{$audit_obj[$i]->before_vale}}</strong>
                    from
                    <strong>BPF{{$audit_obj[$i]->after_value}}</strong>
                @else
                    <strong>BPE{{$audit_obj[$i]->entity_id}} </strong>
                    for
                    <strong>BPF{{$audit_obj[$i]->after_value}}</strong>
                @endif
            @endif
        </div>

        @if(isset($audit_obj[$i-2]) and $audit_obj[$i-2]->audit_type == 'bulk_edit' and $audit_obj[$i-2]->change_key==$change_key)
            <div class="timeline-content">
                <?php echo $body ?>
            </div>

        @endif
        @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key)
            @if($audit_obj[$i]->audit_type == 'edit')
                <div class="timeline-content">
                    @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='edit' and $audit_obj[$i]->entity_type==$entity_type)
                        <p>
                            <strong>{{$audit_obj[$i]->field}}</strong>
                            from
                            <strong>{{$audit_obj[$i]->before_value}}</strong>
                            to
                            <strong>{{$audit_obj[$i]->after_value}}</strong>
                        </p>
                        <?php $i = $i + 2; ?>
                    @endwhile
                </div>

            @endif

            @if(isset($audit_obj[$i]) and $audit_obj[$i]->audit_type == 'add' and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->entity_type==$entity_type)
{{--                    {{dd($entity_type)}}--}}
                <div class="timeline-content">
                    @if($audit_obj[$i]->entity_type == 'geosegment')
                        Entrie(s):
                    @endif
                    @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                        Domain Name(s):
                    @endif
                    @if($audit_obj[$i]->entity_type == 'geosegmententrie')
                        Domain Name(s):
                    @endif
                    @if($audit_obj[$i]->entity_type == 'bid_profile_entry')
                        Entry(s) added:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'advertiser_model_map')
                        Model(s) Added:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'offer_pixel_map')
                        Pixel(s) Added:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'positive_offer_model')
                        Positive Offer(s) Added:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'negative_offer_model')
                        Negative Offer(s) Added:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_geolocation_map')
                        Geo Location Assigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_creative_map')
                        Creative Assigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_segment_map')
                        Segment Assigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_bidprofile_map')
                        Bid Prodile Assigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_bwlist_map')
                        BW LIST Assigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_geosegment_map')
                        Geo Segment Assigned:
                    @endif
                    <?php $flg = 0; $count = 0; ?>
                    @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type == 'add' and $audit_obj[$i]->entity_type==$entity_type)
                        @if($flg>=20)
                            <?php $count++ ?>
                        @endif
                        <p>
                            @if($audit_obj[$i]->entity_type == 'geosegmententrie' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'advertiser_model_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'offer_pixel_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'positive_offer_model' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'negative_offer_model' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'bwlistentrie' and $flg < 2)
                                name:
                                <strong>{{$audit_obj[$i+1]->domain_name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_geolocation_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->state}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_creative_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_segment_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_geosegment_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_bwlist_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_bidprofile_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'bid_profile_entry' and $flg < 20)
                                Domain:
                                <strong>{{$audit_obj[$i+1]->domain}}</strong>
                                <br/>
                                Strategy:
                                <strong>{{$audit_obj[$i+1]->bid_strategy}}</strong>
                                <br/>
                                Value:
                                <strong>{{$audit_obj[$i+1]->bid_value}}</strong>
                            @endif
                        </p>
                        <?php $i = $i + 2; $flg++; ?>
                    @endwhile
                    @if($flg>20)
                        <p> and other <strong>{{$count}}</strong>
                            more...</p>
                    @endif
                </div>

            @endif
                {{--{{dd($entity_type)}}--}}
            @if(isset($audit_obj[$i]) and $audit_obj[$i]->audit_type == 'del' and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->entity_type==$entity_type)
                <div class="timeline-content">
                    @if($audit_obj[$i]->entity_type == 'geosegment')
                        Entrie(s):
                    @endif
                    @if($audit_obj[$i]->entity_type == 'advertiser_model_map')
                        Model(s) Removed:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'offer_pixel_map')
                        Pixel(s) Removed:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'positive_offer_model')
                        Positive Offer(s) Removed:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'negative_offer_model')
                        Negative Offer(s) Removed:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                        Domain(s):
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_geolocation_map')
                        Geo Location Unassigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_creative_map')
                        Creative Unassigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_segment_map')
                        Segment Unassigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_bidprofile_map')
                        Bid Prodile Unassigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_bwlist_map')
                        BW LIST Unassigned:
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup_geosegment_map')
                        Geo Segment Unassigned:
                    @endif
                    <?php $flg = 0; $count = 0; ?>
                    @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type == 'del' and $audit_obj[$i]->entity_type==$entity_type)
                        @if($flg>=20)
                            <?php $count++ ?>
                        @endif
                        <p>
                            @if($audit_obj[$i]->entity_type == 'geosegmententrie' and $flg < 2)
                                name:
                                <strong>{{$audit_obj[$i]->before_value}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'advertiser_model_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'offer_pixel_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'positive_offer_model' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'negative_offer_model' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_geolocation_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->state}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_creative_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_segment_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_geosegment_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_bwlist_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'targetgroup_bidprofile_map' and $flg < 20)
                                name:
                                <strong>{{$audit_obj[$i+1]->name}}</strong>
                            @endif
                            @if($audit_obj[$i]->entity_type == 'bwlistentrie' and $flg < 2)
                                name:
                                <strong>{{$audit_obj[$i]->before_value}}</strong>
                            @endif
                        </p>
                        <?php $i = $i + 2; $flg++; ?>
                    @endwhile
                    <p>
                        @if($flg>20)
                            and other <strong>{{$count}}</strong>
                            more...</p>
                    @endif
                </div>
            @endif
        <?php if(isset($audit_obj[$i])) $entity_type=$audit_obj[$i]->entity_type; ?>
        @endwhile
    </div>
    @endif
@endfor
