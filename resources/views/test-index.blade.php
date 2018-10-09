@extends('dashboard::master')

@section('title') ایمیل ها @endsection
@section('blog') active @endsection
@section('blog-articles-index') active @endsection

@section('top-assets')

@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <span class="breadcrumb-item active">ایمیل ها</span>
        </nav>
    </div>

    <div class="br-pagetitle row pd-r-0">
        <div class="col-lg-6 col-xs-6">
            <h4 class="pd-r-10">
                <i class="icon ion-ios-email"></i>
               ایمیل ها
            </h4>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="heading-elements">
                <a href="" class="btn btn-info btn-with-icon btn-block">
                    <div class="ht-40 justify-content-between">
                        <span class="ht-58 justify-content-between pd-r-20 pd-l-20"> ایجاد ایمیل</span>
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
            <div class="card">
                <div class="card-header" id="heading-example">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example">
                            <i class="fa fa-chevron-down pull-left"></i>
                            <h6 class="tx-16">جستجو در لیست ایمیل ها</h6>
                        </a>
                    </h5>
                </div>
                <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
                    <div class="card-block">
                        <form action="">
                            <div class="mg-x-50 mg-y-20">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="متن مورد نظر را وارد نمایید">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            جستجو <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <div class="rounded table-responsive">
                <table class="table mg-b-0 table-tickets table-striped">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>تاریخ ارسال</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>14</td>
                            <td>حذف مقاله</td>
                            <td>1397/7/15 ساعت 15:31</td>
                            <td>
                                <a href="">
                                    <img src="{{ asset('assets/dashboard/images/notes.png') }}" data-toggle="tooltip" data-original-title="مشاهده عملیات">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>ارسال تبلیغات</td>
                            <td>1397/7/17 ساعت 15:31</td>
                            <td>
                                <a href="">
                                    <img src="{{ asset('assets/dashboard/images/notes.png') }}" data-toggle="tooltip" data-original-title="مشاهده عملیات">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>حذف مقاله</td>
                            <td>1397/7/26 ساعت 12:31</td>
                            <td>
                                <a href="">
                                    <img src="{{ asset('assets/dashboard/images/notes.png') }}" data-toggle="tooltip" data-original-title="مشاهده عملیات">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')

@endsection