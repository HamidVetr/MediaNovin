@extends('dashboard::master')

@section('title') لیست مقالات @endsection
@section('guide') active @endsection
@section('guide-index') active @endsection

@section('top-assets')
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <span class="breadcrumb-item active">راهنماها</span>
        </nav>
    </div>
    <div class="br-pagetitle row pd-r-0">
        <div class="col-lg-6 col-xs-6">
            <h4 class="pd-r-10">
                <i class="icon ion-ios-book"></i>
                لیست راهنماها
            </h4>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="heading-elements">
                <a href="{{ route('dashboard.guide.create') }}" class="btn btn-info btn-with-icon btn-block">
                    <div class="ht-40 justify-content-between">
                        <span class="ht-58 justify-content-between pd-r-20 pd-l-20"> ایجاد راهنمای جدید</span>
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
            @include('dashboard::partials.alert-session')
            <div class="search-advance search-advance-vendor">
                <button type="button" class="bg-teal-400 searchbtn searchbtn-store btn-icon btn-rounded"  data-toggle="tooltip" title="جستجو پیشرفته"><img src="{{ asset('assets/dashboard/images/search.svg') }}" width="18"></button>
                <div id="searchboxpage" class="searchboxpage-vendor">
                    <br><br>
                    {!! Form::open(['method'=>'GET', 'route' => 'dashboard.guide.index']) !!}
                    <div class="row">
                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">عنوان</div>
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">کاربر</div>
                            {!! Form::text('user', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-5 col-md-2">
                            <div class="btn-demo">
                                <button type="submit" class="btn btn-oblong btn-teal active btn-block mg-b-30 mg-t-30"> جستجو</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="rounded table-responsive">
                    <table class="table table-striped mg-b-0 table-tickets">
                        <thead>
                        <tr>
                            <th>شناسه راهنما</th>
                            <th>عنوان</th>
                            <th>متن راهنما</th>
                            <th>تاریخ ساخت</th>
                            <th>ساخته شده توسط</th>
                            <th>آخرین بروزرسانی</th>
                            <th>بروزرسانی توسط</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($guides as $guide)
                            <tr>
                                <td>{{ $guide->id }}</td>
                                <td>{{ $guide->title }}</td>
                                <td>{{ str_limit(strip_tags($guide->body), 50) }}</td>
                                <td>{{ $guide->jalalianCreatedAt() }}</td>
                                <td>{{ $guide->author->full_name }}</td>
                                <td>{{ $guide->jalalianUpdatedAt() }}</td>
                                <td>{{ is_null($guide->editor_id) ? $guide->author->full_name : $guide->editor->full_name }}</td>
                                <td>
                                    <a href="{{ route('dashboard.guide.edit', $guide->id) }}">
                                        <button class="btn btn-warning">ویرایش <i class="icon ion-edit tx-15"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger delete-guide" id="delete-guide-{{ $guide->id }}">حذف <i class="icon ion-ios-trash-outline tx-15"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $guides->appends($_GET)->links('dashboard::partials.pagination') }}
            </div>
        </div>
    </div>

    <div id="modal-delete" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h6 class="tx-black  tx-semibold mg-b-20">آیا از حذف راهنما مطمئنید؟</h6>
                    <h6 class="tx-black  tx-semibold mg-b-20"><span style="color: red">نکته:</span> با حذف راهنمای اصلی، تمام ترجمه های آن نیز پاک می گردد</h6>
                    <p class="pd-x-100"></p>
                    {!! Form::open(['method' => 'DELETE', 'url' => '', 'id' => 'delete-guide-form']) !!}
                        <button type="submit" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">حذف</button>
                        <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">انصراف</button>
                    {!! Form::close() !!}
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

        $('.delete-guide').on('click', function (event) {
            var guideID = $(this).attr('id').substr(13);
            $('#delete-guide-form').attr('action', '{{ route('dashboard.guide.destroy', '') }}/' + guideID);
        });
    </script>
@endsection