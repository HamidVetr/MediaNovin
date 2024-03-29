<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">{{ auth()->user()->first_name .' '. auth()->user()->last_name }}</span>
                    <img src="{{ \App\Models\User::getAvatar(auth()->user()) }}" class="wd-32 rounded-circle" alt="">
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250">
                    <div class="tx-center">
                        <a href="#"><img src="{{ \App\Models\User::getAvatar(auth()->user()) }}" class="wd-80 rounded-circle" alt=""></a>
                        <h6 class="logged-fullname">{{ auth()->user()->username }}</h6>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <hr>
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="{{ route('dashboard.showProfile') }}"><i class="icon ion-ios-person"></i>ویرایش پروفایل</a></li>
                        <li><a href="javascript:{}" onclick="document.getElementById('form-admin-logout').submit();">
                                <i class="icon ion-power"></i> خروج</a>

                            {!! Form::open(['method'=>'POST', 'url' => route('logout'), 'files' => false, 'id' => 'form-admin-logout']) !!}
                            {!! Form::close() !!}
                        </li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>

    </div><!-- br-header-right -->
</div><!-- br-header -->