@extends('dashboard.master')

@section('title')
    پنل مدیریت
@endsection

@section('content')
    <br>
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
@endsection

@section('js-footer')
    <script src="/dashbord/js/highcharts.js"></script>
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
@endsection
