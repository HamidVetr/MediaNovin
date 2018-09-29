@extends('dashboard.master')

@section('content')
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}

                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{----}}
                    {{--You are logged in!--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>پنل مدیریت</title>
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../dashbord/css/bracket.css">
    <link rel="stylesheet" type="text/css" href="../dashbord/css/them.css">
    <link rel="stylesheet" type="text/css" href="../dashbord/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../dashbord/css/ionicons.css">
</head>
<body>
<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href="#"><span>[</span> مدیا <i> نوین </i> <span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"></label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="index.html" class="br-menu-link active">
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
            <a href="#" class="br-menu-link with-sub">
                <i class="menu-item-icon icon ion-ios-contact-outline tx-24"></i>
                <span class="menu-item-label">بخش مدیران</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="" class="sub-link">اضافه کردن مدیر جدید</a></li>
                <li class="sub-item"><a href="" class="sub-link">لیست مدیران</a></li>
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
<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">مریم محمدی</span>
                    <img src="../dashbord/images/img1.jpg" class="wd-32 rounded-circle" alt="">
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250">
                    <div class="tx-center">
                        <a href="#"><img src="../dashbord/images/img1.jpg" class="wd-80 rounded-circle" alt=""></a>
                        <h6 class="logged-fullname">مریم محمدی</h6>
                        <p>youremail@domain.com</p>
                    </div>
                    <hr>
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="#"><i class="icon ion-ios-person"></i>ویرایش پروفایل</a></li>
                        <li><a href="#"><i class="icon ion-ios-gear"></i> تنظیمات</a></li>
                        <li><a href="#"><i class="icon ion-power"></i> خروج</a></li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>

    </div><!-- br-header-right -->
</div><!-- br-header -->
<div class="br-mainpanel">
    <br>
    <div class="br-pagebody">
        <div class="x_content">
            <div class="row tile_count">
                <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <a href="">
                        <div class="count">
                            <span class="count_top tx-16"><i class="fa fa-ticket fa-bigone animated"></i> تیکت های بدون پاسخ</span>
                            0
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <a href="">
                        <div class="count sabz">
                            <span class="count_top"><i class="fa fa  fa-users  fa-bigone animated"></i> تعداد کل کاربران</span>
                            0
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <a href="">
                        <div class="count abi">
                            <span class="count_top"><i class="fa fa-list-alt fa-bigone animated"></i> تبلیغات فعال</span>
                            0</div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <a href="">
                        <div class="count sorkhabi">
                            <span class="count_top"><i class="fa fa-shopping-cart fa-bigone animated"></i> سفارشات در انتظار تایید</span>
                            0
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="pd-t-20 pd-b-20">
            <div class="row">
                <div class="col-lg-6 widget-1">
                    <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-t-20 mg-b-10">لیست 10 ورود آخر ادمین</h6>
                    <table class="table table-striped jambo_table bulk_action">
                        <div class="text-center empty-state">
                            <img src="../dashbord/images/empty.png" width="400">
                            <div>لیست ورود ادمینی وجود ندارد</div>
                        </div>
                        <thead>
                        <tr class="headings">
                            <th class="wd-10p">شناسه</th>
                            <th class="wd-35p">مرورگر</th>
                            <th class="wd-35p">ساعت</th>
                            <th class="wd-20p">تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="even pointer">
                            <th  scope="row">1</th>
                            <td><a href=""><img src="../dashbord/images/chrome.png"></a></td>
                            <td>12:45:00</td>
                            <td>1397/07/04</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">2</th>
                            <td><a href=""><img src="../dashbord/images/explorer.png"></a></td>
                            <td>10:16:22</td>
                            <td>1397/07/03</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">3</th>
                            <td><a href=""><img src="../dashbord/images/safari.png"></a></td>
                            <td>05:22:16</td>
                            <td>1397/07/01</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">4</th>
                            <td><a href=""><img src="../dashbord/images/opera.png"></a></td>
                            <td>15:22:56</td>
                            <td>1397/07/01</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">5</th>
                            <td><a href=""><img src="../dashbord/images/firefox.png"></a></td>
                            <td>13:30:00</td>
                            <td>1397/06/31</td>
                        </tr>
                        <tr class="even pointer">
                            <th  scope="row">1</th>
                            <td><a href=""><img src="../dashbord/images/chrome.png"></a></td>
                            <td>12:45:00</td>
                            <td>1397/07/04</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">2</th>
                            <td><a href=""><img src="../dashbord/images/explorer.png"></a></td>
                            <td>10:16:22</td>
                            <td>1397/07/03</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">3</th>
                            <td><a href=""><img src="../dashbord/images/safari.png"></a></td>
                            <td>05:22:16</td>
                            <td>1397/07/01</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">4</th>
                            <td><a href=""><img src="../dashbord/images/opera.png"></a></td>
                            <td>15:22:56</td>
                            <td>1397/07/01</td>
                        </tr>
                        <tr class="even pointer">
                            <th scope="row">5</th>
                            <td><a href=""><img src="../dashbord/images/firefox.png"></a></td>
                            <td>13:30:00</td>
                            <td>1397/06/31</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-6 widget-1">
                    <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-t-20 mg-b-10">گزارش پرداختی ماه جاری</h6>
                    <div class="chart-panel">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cancel"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../dashbord/js/jquery.js"></script>
<script src="../dashbord/js/popper.js"></script>
<script src="../dashbord/js/bootstrap.js"></script>
<script src="../dashbord/js/highcharts.js"></script>
<script src="../dashbord/js/bracket.js"></script>
<script type="text/javascript">

    Highcharts.setOptions({
        lang: {
            numericSymbols: null //otherwise by default ['k', 'M', 'G', 'T', 'P', 'E']
        }
    });
    Highcharts.chart('cancel', {
        colors: ['#ED561B'],

        chart: {
            type: 'area', zoomType: 'x'
        },
        title: {
            text: ' آمار بازدید سایت'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 180,
            y: 100,
            floating: true,
            borderWidth: 1, symbolPadding: -20, rtl: true, reversed: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [10,20,15,10,5,1,15,2,9,50],

        },
        yAxis: {
            title: {
                text: 'تعداد '
            }
        },
        tooltip: {
            split: true,
            useHTML: true,
            valueSuffix: ' تعداد'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [
            {
                name: 'بازدید',
                data: [10,20,15,10,5,1,15,2,9,50]
            }

        ]
    });

</script>
</body>
</html>
@endsection
