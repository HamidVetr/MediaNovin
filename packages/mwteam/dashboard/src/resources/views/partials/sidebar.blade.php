<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"></label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{route('dashboard.home')}}" class="br-menu-link @yield('dashboard-home')">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">صفحه اصلی</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        @foreach($packagesSidebarMenus as $packageName => $sidebarMenus)
            @foreach($sidebarMenus as $sidebarMenu)
                @can($sidebarMenu['permission'], $sidebarMenu['model'])
                    <li class="br-menu-item">
                        <a href="" class="br-menu-link {{isset($sidebarMenu['subMenus']) && count($sidebarMenu['subMenus']) > 0 ? 'with-sub':''}} @yield($sidebarMenu['yield'])">
                            <i class="menu-item-icon icon {{$sidebarMenu['icon']}}"></i>
                            <span class="menu-item-label">{{$sidebarMenu['title']}}
                                @if(isset(${$packageName . 'NotificationsCount'}) && isset(${$packageName . 'NotificationsCount'}['total']) && ${$packageName . 'NotificationsCount'}['total'] != 0)
                                    <span class="badge badge-danger">{{ ${$packageName . 'NotificationsCount'}['total'] }}</span>
                                @endif
                        </span>
                        </a><!-- br-menu-link -->

                        @if(isset($sidebarMenu['subMenus']) && count($sidebarMenu['subMenus']) > 0)
                            <ul class="br-menu-sub">
                                @foreach($sidebarMenu['subMenus'] as $subMenu)
                                    @can($subMenu['permission'], $subMenu['model'])
                                        <li class="sub-item">
                                            <a href="{{$subMenu['url']}}" class="sub-link @yield($subMenu['yield'])">{{$subMenu['title']}}
                                                @if(isset(${$packageName . 'NotificationsCount'}) && isset(${$packageName . 'NotificationsCount'}[$subMenu['yield']]) && ${$packageName . 'NotificationsCount'}[$subMenu['yield']] != 0)
                                                    <span class="badge badge-danger">{{ ${$packageName . 'NotificationsCount'}[$subMenu['yield']] }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        @endif
                    </li><!-- br-menu-item -->
                @endcan
            @endforeach
        @endforeach

        {{--<li class="br-menu-item">--}}
        {{--<a href="#" class="br-menu-link with-sub">--}}
        {{--<i class="menu-item-icon icon ion-android-contacts tx-20"></i>--}}
        {{--<span class="menu-item-label">بخش کاربران</span>--}}
        {{--</a><!-- br-menu-link -->--}}
        {{--<ul class="br-menu-sub">--}}
        {{--<li class="sub-item"><a href="" class="sub-link">اضافه کردن کاربر جدید</a></li>--}}
        {{--<li class="sub-item"><a href="" class="sub-link">لیست کاربران</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}

        {{--<li class="br-menu-item">--}}
            {{--<a href="#" class="br-menu-link with-sub">--}}
                {{--<i class="menu-item-icon ion-social-usd tx-24"></i>--}}
                {{--<span class="menu-item-label">بخش مالی</span>--}}
            {{--</a><!-- br-menu-link -->--}}
            {{--<ul class="br-menu-sub">--}}
                {{--<li class="sub-item"><a href="" class="sub-link">تسویه حساب ها</a></li>--}}
                {{--<li class="sub-item"><a href="" class="sub-link">تراکنش ها</a></li>--}}
                {{--<li class="sub-item"><a href="" class="sub-link">آمار</a></li>--}}
                {{--<li class="sub-item"><a href="" class="sub-link">درگاه های پرداخت</a></li>--}}

            {{--</ul>--}}
        {{--</li>--}}
    </ul><!-- br-sideleft-menu -->
    <br>
</div><!-- br-sideleft -->