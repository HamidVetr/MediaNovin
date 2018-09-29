<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"></label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{route('dashboard.home')}}" class="br-menu-link {{Request::is('dashboard') ? 'active':''}}">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">صفحه اصلی</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="" class="br-menu-link with-sub">
                <i class="menu-item-icon icon ion-android-chat tx-24"></i>
                <span class="menu-item-label">تیکتینگ</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="" class="sub-link">ارسال تیکت</a></li>
                <li class="sub-item"><a href="" class="sub-link">تیکت های پشتیبانی</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub">
                <i class="menu-item-icon icon ion-android-contacts tx-20"></i>
                <span class="menu-item-label">بخش کاربران</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="" class="sub-link">اضافه کردن کاربر جدید</a></li>
                <li class="sub-item"><a href="" class="sub-link">لیست کاربران</a></li>
            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{Request::is('dashboard/admins*') ? 'active':''}}">
                <i class="menu-item-icon icon ion-ios-contact-outline tx-24"></i>
                <span class="menu-item-label">بخش مدیران</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{route('dashboard.admins.create')}}" class="sub-link">اضافه کردن مدیر جدید</a></li>
                <li class="sub-item"><a href="{{route('dashboard.admins.index')}}" class="sub-link">لیست مدیران</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub">
                <i class="menu-item-icon ion-social-usd tx-24"></i>
                <span class="menu-item-label">بخش مالی</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="" class="sub-link">تسویه حساب ها</a></li>
                <li class="sub-item"><a href="" class="sub-link">تراکنش ها</a></li>
                <li class="sub-item"><a href="" class="sub-link">آمار</a></li>
                <li class="sub-item"><a href="" class="sub-link">درگاه های پرداخت</a></li>

            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#" class="br-menu-link">
                <i class="menu-item-icon icon ion-android-mail tx-20"></i>
                <span class="menu-item-label">ارسال پیام دسته جمعی</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">تنظیمات</span>
            </a>
        </li>
    </ul><!-- br-sideleft-menu -->
    <br>
</div><!-- br-sideleft -->