@extends('dashboard::master')

@section('title') تگ‌ها @endsection
@section('blog') active @endsection
@section('blog-tags-index') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/persian-datepicker-0.4.5.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <span class="breadcrumb-item active">برچسب ها</span>
        </nav>
    </div>
    <div class="br-pagetitle row">
        <div class="col-lg-6">
            <div class="title-add">
                <i class="icon icon ion-android-exit"></i>
                <h4 class="pd-r-10">برچسب ها</h4>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="heading-elements pd-l-20">
                <a href="{{route('dashboard.admins.create')}}" class="btn btn-info btn-with-icon btn-block">
                    <div class="ht-40 justify-content-between">
                        <span class="ht-58 justify-content-between pd-r-20 pd-l-20">افزودن برچسب</span>
                        <span class="icon wd-40">
                             <i class="fa fa-plus"></i>
                         </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <div class="search-advance search-advance-vendor">
                <button type="button" class="bg-teal-400 searchbtn searchbtn-store btn-icon btn-rounded"  data-toggle="tooltip" title="جستجو پیشرفته"><img src="{{ asset('assets/dashboard/images/search.svg') }}" width="18"></button>
                <div id="searchboxpage" class="searchboxpage-vendor">
                    <br><br>
                    <form action="">
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="text-right">عنوان برچسب</div>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="text-right">تعداد</div>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="text-right">از تاریخ</div>
                                <input type="text" class="form-control persianDatePricker text-left" name="from-date"  id="from-date" value>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="text-right">تا تاریخ</div>
                                <input type="text" class="form-control persianDatePricker text-left" name="to-date"  id="to-date" value>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-5 col-md-2">
                                <div class="btn-demo">
                                    <button type="submit" class="btn btn-oblong btn-teal active btn-block mg-b-30 mg-t-30"> جستجو</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="rounded table-responsive">
                    <table class="table mg-b-0 table-tickets">
                        <thead>
                            <tr>
                                <th>عنوان برچسب</th>
                                <th>تعداد</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>فروش محصولات</td>
                            <td>15</td>
                            <td>
                                <a href="">
                                   <span>
                                       <i class="fa fa-pencil-square-o"></i>
                                   </span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>حذف پیام ارسال شده</td>
                            <td>3</td>
                            <td>
                                <a href="">
                                   <span>
                                       <i class="fa fa-pencil-square-o"></i>
                                   </span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>تبریک، برنده مزایده شده اید</td>
                            <td>5</td>
                            <td>
                                <a href="">
                                   <span>
                                       <i class="fa fa-pencil-square-o"></i>
                                   </span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>	حذف دیدگاه</td>
                            <td>10</td>
                            <td>
                                <a href="">
                                   <span>
                                       <i class="fa fa-pencil-square-o"></i>
                                   </span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>	حذف دیدگاه</td>
                            <td>66</td>
                            <td>
                                <a href="">
                                   <span>
                                       <i class="fa fa-pencil-square-o"></i>
                                   </span>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="ht-80 d-flex align-items-center justify-content-center mg-t-20 rtl">
                    <ul class="pagination pagination-circle mg-b-0">
                        <li class="page-item hidden-xs-down">
                            <a class="page-link" href="#" aria-label="First"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous"><i class="fa fa-angle-right"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item hidden-xs-down"><a class="page-link" href="#">3</a></li>
                        <li class="page-item hidden-xs-down"><a class="page-link" href="#">4</a></li>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next"><i class="fa fa-angle-left"></i></a>
                        </li>
                        <li class="page-item hidden-xs-down">
                            <a class="page-link" href="#" aria-label="Last"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('assets/dashboard/js/persian-datepicker-0.4.5.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/pwt-date.js') }}"></script>
    <script type="text/javascript">
        $('.searchbtn').click(function(){
            $('#searchboxpage').stop().slideToggle();
        });

        $(".persianDatePricker").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue :{
                enabled: false
            }
        });

        $('#from-date').val('');

        $('#to-date').val('');
    </script>
@endsection