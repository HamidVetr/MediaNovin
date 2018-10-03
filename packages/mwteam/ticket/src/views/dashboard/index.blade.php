@extends('dashboard::master')

@section('title') تیکت ها @endsection

@section('tickets-index') active @endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/dashboard/css/persian-datepicker-0.4.5.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
       <nav class="breadcrumb pd-0 mg-0 tx-12">
           <a href="" class="breadcrumb-item">خانه</a>
           <span class="breadcrumb-item active">تیکت ها</span>
       </nav>
    </div>
    <div class="br-pagetitle">
       <i class="icon icon ion-android-exit"></i>
       <h4 class="pd-r-10">تیکت ها</h4>
    </div>
    <div class="pd-t-30">
           <div class="br-section-wrapper-level">
               <div class="search-advance search-advance-vendor">
                   <button type="button" class="bg-teal-400 searchbtn searchbtn-store btn-icon btn-rounded"  data-toggle="tooltip" title="جستجو پیشرفته"><img src="{{ asset('/assets/dashboard/images/search.svg') }}" width="18"></button>
                   <div id="searchboxpage" class="searchboxpage-vendor">
                       <br><br>
                       <form action="">
                           <div class="row">
                               <div class="col-md-2 col-xs-6">
                                   <div class="text-right">شناسه سفارش</div>
                                   <input type="text" class="form-control">
                               </div>

                               <div class="col-md-2 col-xs-6">
                                   <div class="text-right">کاربر</div>
                                   <input type="text" class="form-control">
                               </div>

                               <div class="col-md-2 col-xs-6">
                                   <div class="text-right">وضعیت</div>
                                   <select class="form-control select-store">
                                       <option>همه</option>
                                       <option>تکمیل شده</option>
                                       <option>تکمیل نشده</option>
                                   </select>
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
                                        <th>شماره تیکت</th>
                                        <th>عنوان</th>
                                        <th>نام کاربر</th>
                                        <th>سمت</th>
                                        <th>به روز شده</th>
                                        <th>وضعیت</th>
                                        <th>جزئیات</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>41</td>
                                    <td>تبریک، برنده مزایده شده اید</td>
                                    <td>
                                        <a href="">user</a>
                                    </td>
                                    <td>کاربر عادی</td>
                                    <td>14:09 1397/6/25</td>
                                    <td>
                                        <span class="btn btn-warning pd-5">پاسخ مشتری</span>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="{{ asset('/assets/dashboard/images/analytics.png') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal"data-target="#modaldemo5">
                                            <span class="trash-ticket">
                                                <i class="fa fa-trash-o"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>47</td>
                                    <td>حذف پیام ارسال شده</td>
                                    <td>
                                        <a href="">user</a>
                                    </td>
                                    <td>کاربر عادی</td>
                                    <td>14:09 1397/6/25</td>
                                    <td>
                                        <span class="btn btn-warning pd-5">پاسخ مشتری</span>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="{{ asset('/assets/dashboard/images/analytics.png') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal"data-target="#modaldemo5">
                                            <span class="trash-ticket">
                                                <i class="fa fa-trash-o"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>52</td>
                                    <td>تبریک، برنده مزایده شده اید</td>
                                    <td>
                                        <a href="">user</a>
                                    </td>
                                    <td>کاربر عادی</td>
                                    <td>14:09 1397/6/25</td>
                                    <td>
                                        <span class="btn btn-primary pd-5">بسته شده</span>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="{{ asset('/assets/dashboard/images/analytics.png') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal"data-target="#modaldemo5">
                                            <span class="trash-ticket">
                                                <i class="fa fa-trash-o"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>68</td>
                                    <td>	حذف دیدگاه</td>
                                    <td>
                                        <a href="">user</a>
                                    </td>
                                    <td>کاربر عادی</td>
                                    <td>14:09 1397/6/25</td>
                                    <td>
                                        <span class="btn btn-primary pd-5">بسته شده</span>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="{{ asset('/assets/dashboard/images/analytics.png') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal"data-target="#modaldemo5">
                                            <span class="trash-ticket">
                                                <i class="fa fa-trash-o"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>66</td>
                                    <td>	حذف دیدگاه</td>
                                    <td>
                                        <a href="">user</a>
                                    </td>
                                    <td>کاربر عادی</td>
                                    <td>14:09 1397/6/25</td>
                                    <td>
                                        <span class="btn btn-info pd-5"> در حال بررسی</span>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="{{ asset('/assets/dashboard/images/analytics.png') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal"data-target="#modaldemo5">
                                            <span class="trash-ticket">
                                                <i class="fa fa-trash-o"></i>
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
    <div id="modaldemo5" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h6 class="tx-danger  tx-semibold mg-b-20">آیا مایلید تیکت مورد نظر خود را حذف کنید؟</h6>
                    <p class="pd-x-100"></p>
                    <button type="button" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                      حذف</button>
                    <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                     انصراف</button>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@section('js-footer')
    <script src="{{ asset('/assets/dashboard/js/persian-datepicker-0.4.5.js') }}"></script>
    <script src="{{ asset('/assets/dashboard/js/pwt-date.js') }}"></script>
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
