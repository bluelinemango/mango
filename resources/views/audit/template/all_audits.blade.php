<div class="streamline b-l b-accent m-b">
    @for($i=0;$i<count($audit_obj);)
        {{--                                                @foreach($audit_obj as $index)--}}
        <?php $change_key = $audit_obj[$i]->change_key; $save='' ?>
        <div class="sl-item">
            <div class="sl-content">
                <div class="text-muted-dk">{{$audit_obj[$i]->created_at}}</div>
                <p>
                    <a href="{{url('user/usr'.$audit_obj[$i]->user_id.'/edit')}}">{{$audit_obj[$i]->getUser->name}}</a>
                    @if($audit_obj[$i]->audit_type == 'add')
                        @if($audit_obj[$i]->entity_type == 'positive_offer_model' or $audit_obj[$i]->entity_type == 'negative_offer_model')
                            changed Model:
                        @elseif($audit_obj[$i]->entity_type == 'offer_pixel_map')
                            changed Offer:
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
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->id.'/edit')}}">cl{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'advertiser')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->id.'/edit')}}">adv{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'creative' and $audit_obj[$i]->audit_type =='bulk_edit')
                        @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='bulk_edit')
                            @if($save != $audit_obj[$i+1][0]->id)
                            <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/creative/crt'.$audit_obj[$i+1][0]->id.'/edit')}}">crt{{$audit_obj[$i+1][0]->id}}</a> ,
                            </strong>
                            @endif
                            <?php $save = $audit_obj[$i+1][0]->id ?>
                            <?php $i = $i + 2; ?>
                        @endwhile

                    @endif
                    @if($audit_obj[$i]->entity_type == 'creative')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/creative/crt'.$audit_obj[$i+1][0]->id.'/edit')}}">crt{{$audit_obj[$i+1][0]->id}}</a> ,
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'offer')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/offer/ofr'.$audit_obj[$i+1][0]->id.'/edit')}}">ofr{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'pixel')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/pixel/pxl'.$audit_obj[$i+1][0]->id.'/edit')}}">pxl{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'bwlist')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/bwlist/bwl'.$audit_obj[$i+1][0]->id.'/edit')}}">{{$audit_obj[$i+1][0]->name}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'geosegment')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/geosegment/gsm'.$audit_obj[$i+1][0]->id.'/edit')}}">{{$audit_obj[$i+1][0]->name}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'campaign' and $audit_obj[$i]->audit_type =='bulk_edit')
                        @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='bulk_edit')
                            @if($save != $audit_obj[$i+1][0]->id)
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/campaign/cmp'.$audit_obj[$i+1][0]->id.'/edit')}}">cmp{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                            @endif
                            <?php $save = $audit_obj[$i+1][0]->id ?>
                            <?php $i = $i + 2; ?>
                        @endwhile
                    @endif
                    @if($audit_obj[$i]->entity_type == 'campaign')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/campaign/cmp'.$audit_obj[$i+1][0]->id.'/edit')}}">cmp{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'modelTable')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/model/mdl'.$audit_obj[$i+1][0]->id.'/edit')}}">mdl{{$audit_obj[$i+1][0]->id}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'positive_offer_model' or $audit_obj[$i]->entity_type == 'negative_offer_model')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/model/mdl'.$audit_obj[$i]->after_value.'/edit')}}">mdl{{$audit_obj[$i]->after_value}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'offer_pixel_map')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->getAdvertiser->GetClientID->id.'/advertiser/adv'.$audit_obj[$i+1][0]->getAdvertiser->id.'/offer/ofr'.$audit_obj[$i]->after_value.'/edit')}}">ofr{{$audit_obj[$i]->after_value}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'targetgroup')
                        <strong><a href="{{url('client/cl'.$audit_obj[$i+1][0]->id.'/edit')}}">{{$audit_obj[$i+1][0]->name}}</a>
                        </strong>
                    @endif
                    @if($audit_obj[$i]->entity_type == 'geosegmententrie')
                        @if($audit_obj[$i]->audit_type == 'del')
                            <strong>{{$audit_obj[$i]->before_vale}}</strong>
                            from
                            <strong>GSL{{$audit_obj[$i+1][0]->id}}</strong>
                        @else
                            <strong>GS{{$audit_obj[$i]->entity_id}} </strong>
                            for
                            <strong>GSL{{$audit_obj[$i+1][0]->id}}</strong>
                        @endif
                    @endif
                    @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                        @if($audit_obj[$i]->audit_type == 'del')
                            <strong>{{$audit_obj[$i]->before_vale}}</strong>
                            from
                            <strong>BWL{{$audit_obj[$i+1][0]->id}}</strong>
                        @else
                            <strong>BWE{{$audit_obj[$i]->entity_id}} </strong>
                            for
                            <strong>BWL{{$audit_obj[$i+1][0]->id}}</strong>
                        @endif
                    @endif
                </p>

                @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key)

                    @if($audit_obj[$i]->audit_type == 'bulk_edit')
                        <div class="well well-sm display-inline">
                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='bulk_edit')
                                <p>
                                    <strong>{{$audit_obj[$i]->field}}</strong>
                                    to
                                    <strong>{{$audit_obj[$i]->after_value}}</strong>
                                </p>
                                <?php $i = $i + 2; ?>
                            @endwhile
                        </div>

                    @endif
                    @if($audit_obj[$i]->audit_type == 'edit')
                        <div class="well well-sm display-inline">
                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type =='edit')
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
                    @if(isset($audit_obj[$i]->audit_type) and $audit_obj[$i]->audit_type == 'add' and $audit_obj[$i]->change_key==$change_key)
                        <div class="well well-sm display-inline">
                            @if($audit_obj[$i]->entity_type == 'geosegment')
                                Entrie(s):
                            @endif
                            @if($audit_obj[$i]->entity_type == 'bwlistentrie')
                                Domain Name(s):
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
                            <?php $flg = 0; $count = 0; ?>
                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type == 'add')
                                @if($flg>=20)
                                    <?php $count++ ?>
                                @endif
                                <p>
                                    @if($audit_obj[$i]->entity_type == 'geosegmententrie' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'offer_pixel_map' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'positive_offer_model' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'negative_offer_model' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'bwlistentrie' and $flg < 2)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
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

                    @if(isset($audit_obj[$i]->audit_type) and $audit_obj[$i]->audit_type == 'del' and $audit_obj[$i]->change_key==$change_key)
                        <div class="well well-sm display-inline">
                            @if($audit_obj[$i]->entity_type == 'geosegment')
                                Entrie(s):
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

                            <?php $flg = 0; $count = 0; ?>
                            @while(isset($audit_obj[$i]) and $audit_obj[$i]->change_key==$change_key and $audit_obj[$i]->audit_type == 'del')
                                @if($flg>=20)
                                    <?php $count++ ?>
                                @endif
                                <p>
                                    @if($audit_obj[$i]->entity_type == 'geosegmententrie' and $flg < 2)
                                        name:
                                        <strong>{{$audit_obj[$i]->before_value}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'offer_pixel_map' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'positive_offer_model' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
                                    @endif
                                    @if($audit_obj[$i]->entity_type == 'negative_offer_model' and $flg < 20)
                                        name:
                                        <strong>{{$audit_obj[$i+1][0]->name}}</strong>
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

                @endwhile
            </div>
            @endfor
        </div>
</div>
