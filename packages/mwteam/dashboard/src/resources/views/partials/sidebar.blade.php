<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"></label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{route('dashboard.home')}}" class="br-menu-link @yield('dashboard-home')">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">صفحه اصلی</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        @foreach($menus as $menuName => $menu)
            @can($menu['permission'], $menu['model'])
                <li class="br-menu-item">
                    <a href="" class="br-menu-link with-sub @yield($menu['yield'])">
                        <i class="menu-item-icon icon {{$menu['icon']}}"></i>
                        <span class="menu-item-label">{{$menu['title']}}
                            @if(isset(${$menuName . 'NotificationsCount'}))
                                <span class="badge badge-danger">{{ ${$menuName . 'NotificationsCount'}['total'] }}</span>
                            @endif
                        </span>
                    </a><!-- br-menu-link -->

                    <ul class="br-menu-sub">
                        @foreach($menu['subMenus'] as $subMenu)
                            @can($subMenu['permission'], $subMenu['model'])
                                <li class="sub-item">
                                    <a href="{{$subMenu['url']}}" class="sub-link @yield($subMenu['yield'])">{{$subMenu['title']}}
                                        @if(isset(${$menuName . 'NotificationsCount'}) && isset(${$menuName . 'NotificationsCount'}[$subMenu['yield']]))
                                            <span class="badge badge-danger">{{ ${$menuName . 'NotificationsCount'}[$subMenu['yield']] }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endcan
                        @endforeach
                    </ul>
                </li><!-- br-menu-item -->
            @endcan
        @endforeach

        <li class="br-menu-item">
            <a href="#" class="br-menu-link">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">تنظیمات</span>
            </a>
        </li>

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