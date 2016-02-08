<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="{{cdn('img/avatars/sunny.png')}}" alt="me" class="online" />
                <span>
                    Welcome {{\Illuminate\Support\Facades\Auth::user()->name}} !
                </span>
            </a>
        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
            <li class="active">
                <a href="{{url('dashboard')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            @if(in_array('VIEW_CLIENT',$permission))
            <li>
                <a href="{{url('client')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Clients</span></a>
            </li>
            @endif
            @if(in_array('VIEW_ADVERTISER',$permission))
            <li>
                <a href="{{url('advertiser')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Advertiser</span></a>
            </li>
            @endif
            @if(in_array('VIEW_CAMPAIGN',$permission))
            <li>
                <a href="{{url('campaign')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Campaign</span></a>
            </li>
            @endif
            @if(in_array('VIEW_CREATIVE',$permission))
            <li>
                <a href="{{url('creative')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Creative</span></a>
            </li>
            @endif
            @if(in_array('VIEW_TARGETGROUP',$permission))
            <li>
                <a href="{{url('targetgroup')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Target Group</span></a>
            </li>
            @endif
            @if(in_array('VIEW_OFFER',$permission))
            <li>
                <a href="{{url('offer')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Offer</span></a>
            </li>
            @endif
            @if(in_array('VIEW_PIXEL',$permission))
            <li>
                <a href="{{url('pixel')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Pixel</span></a>
            </li>
            @endif
            @if(in_array('VIEW_MODEL',$permission))
            <li>
                <a href="{{url('model')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Model</span></a>
            </li>
            @endif
            @if(in_array('VIEW_BWLIST',$permission))
            <li>
                <a href="{{url('/bwlist')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Black & white list</span></a>
            </li>
            @endif
            @if(in_array('VIEW_GEOSEGMENTLIST',$permission))
            <li>
                <a href="{{url('geosegment')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Top Geo Segment</span></a>
            </li>
            @endif
            @if(!in_array('VIEW_REPORT',$permission))
            <li>
                <a href="{{url('reporting')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Reporting</span></a>
            </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Role Permission</span></a>
                    <ul>
                        <li>
                            <a href="{{url('user/role-permission')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Role Permission List</span></a>
                        </li>
                        <li>
                            <a href="{{url('user/add-role')}}">Add Role <span class="badge pull-right inbox-badge bg-color-yellow">new</span></a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                <li>
                    <a href="{{url('company')}}"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">company</span></a>

                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                <li>
                    <a href="{{url('inventory')}}"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Inventory</span></a>

                </li>
            @endif
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">User</span></a>
                <ul>
                    <li>
                        <a href="{{url('user/register')}}">Add User <span class="badge pull-right inbox-badge bg-color-yellow">new</span></a>
                    </li>
                    <li>
                        <a href="{{url('user')}}">List User <span class="badge pull-right inbox-badge bg-color-yellow">new</span></a>
                    </li>
                </ul>
            </li>


        </ul>
    </nav>
			<span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>
<!-- END NAVIGATION -->



                            {{--<li><a href="{{url('/user/login')}}"> Home</a></li>--}}
                            {{--<li><a href="{{url('/advertiser')}}">Advertiser</a></li>--}}
                            {{--<li><a href="{{url('/client')}}">Client</a></li>--}}
                            {{--<li>--}}
                                {{--<a href="{{url('/campaign')}}">Campain</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="{{url('/targetgroup')}}"> Target Group</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--@if(\Illuminate\Support\Facades\Auth::check())--}}
                    {{--<div class="col-sm-2">--}}
                        {{--<ul class="nav navbar-nav user_menu pull-right">--}}
                            {{--<li class="divider-vertical hidden-sm hidden-xs"></li>--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{cdn('img/user_avatar.png')}}" alt="" class="user_avatar">{{\Illuminate\Support\Facades\Auth::user()->name}} <b class="caret"></b></a>--}}
                                {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                                    {{--<li><a href="{{url('/user/edit/'.\Illuminate\Support\Facades\Auth::user()->id)}}">Edit Profile</a></li>--}}
                                    {{--<li class="divider"></li>--}}
                                    {{--<li><a href="{{url('/user/logout')}}">Log Out</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--@endif--}}
