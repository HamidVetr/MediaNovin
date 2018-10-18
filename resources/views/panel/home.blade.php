<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>پنل کاربر</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/bracket.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/them.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/ionicons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/bootstrap.rtl.css') }}">
</head>
<body>
<div class="br-logo br-logo-user"><a href="#"><span>[</span> مدیا <i> نوین </i> <span>]</span></a></div>

<div class="br-sideleft br-sideleft-user overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"></label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="#" class="br-menu-link br-menu-link-user active">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">صفحه اصلی</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="" class="br-menu-link br-menu-link-user with-sub">
                <i class="menu-item-icon icon ion-android-chat tx-24"></i>
                <span class="menu-item-label">تیکتینگ</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub br-menu-sub-user">
                <li class="sub-item"><a href="" class="sub-link">ارسال تیکت</a></li>
                <li class="sub-item"><a href="" class="sub-link">تیکت های پشتیبانی</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link br-menu-link-user with-sub">
                <i class="menu-item-icon ion-speakerphone  tx-24"></i>
                <span class="menu-item-label">تبلیغ گیرندگان</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub br-menu-sub-user">
                <li class="sub-item"><a href="" class="sub-link">اضافه کردن مدیر جدید</a></li>
                <li class="sub-item"><a href="" class="sub-link">لیست مدیران</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link br-menu-link-user with-sub">
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
            <a href="#" class="br-menu-link br-menu-link-user">
                <i class="menu-item-icon icon ion-android-mail tx-20"></i>
                <span class="menu-item-label">پشتیبانی</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link br-menu-link-user">
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
                    <img src="http://127.0.0.1:8000/avatars/e049d45bf06e72815368e7c8b4c8bcdblGeQk9Uzhz8byKU.png" class="wd-32 rounded-circle" alt="">
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250">
                    <div class="tx-center">
                        <a href="#"><img src="http://127.0.0.1:8000/avatars/e049d45bf06e72815368e7c8b4c8bcdblGeQk9Uzhz8byKU.png" class="wd-80 rounded-circle" alt=""></a>
                        <h6 class="logged-fullname">b b</h6>
                        <p>youremail@domain.com</p>
                    </div>
                    <hr>
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="#"><i class="icon ion-ios-person"></i>ویرایش پروفایل</a></li>
                        <li><a href="#"><i class="icon ion-power"></i> خروج</a></li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>

    </div><!-- br-header-right -->
</div><!-- br-header -->

<div class="br-mainpanel">
    <div class="br-pagebody">





        <div class="row">
            <div class="col-lg-6 widget-1">
                <div class="content-wrap no-margin">
                    <h6 class="text-chart tx-inverse tx-uppercase tx-bold tx-14 no-margin">
                        <i class="fa  fa-bar-chart"></i>
                        گزارش پرداختی ماه جاری
                    </h6>
                </div>
                <div class="chart-panel wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="cancel"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 widget-1">
                <div class="content-wrap no-margin">
                    <h6 class="text-chart tx-inverse tx-uppercase tx-bold tx-14 no-margin">
                        <i class="fa fa-users"></i>
                        لیست 10 ورود آخر کاربر
                    </h6>
                </div>
                     <table class="table table-striped jambo_table jambo_table-user bulk_action jambo_table-user">
                    <div class="text-center empty-state">
                        <img src="{{ asset('assets/dashboard/images/empty.png') }}" width="400">
                        <div>لیست ورود کاربر وجود ندارد</div>
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
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/chrome.png') }}"></a></td>
                        <td>12:45:00</td>
                        <td>1397/07/04</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">2</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/explorer.png') }}"></a></td>
                        <td>10:16:22</td>
                        <td>1397/07/03</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">3</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/safari.png') }}"></a></td>
                        <td>05:22:16</td>
                        <td>1397/07/01</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">4</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/opera.png') }}"></a></td>
                        <td>15:22:56</td>
                        <td>1397/07/01</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">5</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/firefox.png') }}"></a></td>
                        <td>13:30:00</td>
                        <td>1397/06/31</td>
                    </tr>
                    <tr class="even pointer">
                        <th  scope="row">1</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/chrome.png') }}"></a></td>
                        <td>12:45:00</td>
                        <td>1397/07/04</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">2</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/explorer.png') }}"></a></td>
                        <td>10:16:22</td>
                        <td>1397/07/03</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">3</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/safari.png') }}"></a></td>
                        <td>05:22:16</td>
                        <td>1397/07/01</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">4</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/opera.png') }}"></a></td>
                        <td>15:22:56</td>
                        <td>1397/07/01</td>
                    </tr>
                    <tr class="even pointer">
                        <th scope="row">5</th>
                        <td><a href=""><img src="{{ asset('assets/dashboard/images/firefox.png') }}"></a></td>
                        <td>13:30:00</td>
                        <td>1397/06/31</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>








      <div class="dashboard-comp">
         <div class="col col-xs-12" style="padding: 0px;">
            <div class="col col-xs-12 stats">
                <div class="col col-sm-3">
                    <a href="" class="item bell">
                        <div class="icon-bg bell"></div>
                        <div class="text">
                            <span>0</span>
                            <div class="title">کمپین تبلیغاتی فعال</div>
                        </div>
                    </a>
                </div>
                <div class="col col-sm-3">
                    <a href="" class="item website">
                        <div class="icon-bg website"></div>
                        <div class="text">
                            <span>0</span>
                            <div class="title">تعداد بنرها</div>
                        </div>
                    </a>
                </div>
                <div class="col col-sm-3">
                    <a href="" class="item credit">
                        <div class="icon-bg credit"></div>
                        <div class="text price">
                            <span style="direction: ltr">0</span>
                           موجودی				</div>
                    </a>
                </div>
                <div class="col col-sm-3">
                    <a href="" class="item message">
                        <div class="icon-bg message"></div>
                        <div class="text">
                            <span>0</span>
                            <div class="title">تیکت باز</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
       </div>



    </div>
</div>

<script src="{{ asset('assets/dashboard/js/jquery.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bracket.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrapValidator.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/uniform.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/highcharts.js') }}"></script>
<script type="text/javascript">
    Highcharts.setOptions({
        lang: {
            numericSymbols: null //otherwise by default ['k', 'M', 'G', 'T', 'P', 'E']
        }

    });
    $(window).resize(function(){
        var chart = $('#cancel').highcharts();

        console.log('redraw');
        var w = $('#cancel').closest(".wrapper").width()
        // setsize will trigger the graph redraw
        chart.setSize(
            w,w * (3/4),false
        );
    });

    Highcharts.chart('cancel', {
        colors: ['#ED561B'],

        chart: {
            type: 'area', zoomType: 'x'
        },
        title: {
            text: ''
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
                data: [10,20,15,10,5,1,15,2,9,50],
            }

        ]
    });

</script>
</body>
</html>