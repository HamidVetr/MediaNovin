@extends('dashboard::master')

@section('title') نظرات @endsection
@section('blog') active @endsection
@section('blog-comments-index') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/persian-datepicker-0.4.5.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <span class="breadcrumb-item active">نظرات</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <i class="icon icon ion-chatbubbles"></i>
        <h4 class="pd-r-10">لیست نظرات</h4>
    </div>
    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            @include('dashboard::partials.alert-session')
            <div class="search-advance search-advance-vendor">
                <button type="button" class="bg-teal-400 searchbtn searchbtn-store btn-icon btn-rounded"  data-toggle="tooltip" title="جستجو پیشرفته"><img src="{{ asset('assets/dashboard/images/search.svg') }}" width="18"></button>
                <div id="searchboxpage" class="searchboxpage-vendor">
                    <br><br>
                    {!! Form::open(['method'=>'GET', 'route' => 'dashboard.blog.comments.index']) !!}
                    <div class="row">
                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">نام نظر دهنده</div>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">ایمیل</div>
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">موبایل</div>
                            {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">متن نظر</div>
                            {!! Form::text('body', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2 col-xs-6">
                            <div class="text-right">وضعیت</div>
                            {!! Form::select('approved', [
                                'all' => 'همه',
                                '0' => 'تایید نشده',
                                '1' => 'تایید شده',
                            ], null, ['class' => 'form-control select-store']) !!}
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="text-right">از تاریخ</div>
                            <input type="text" name="fromDate" class="form-control persianDatePricker text-left" id="from-date" autocomplete="off" value="{{ isset($_GET['fromDate']) && trim($_GET['fromDate']) != '' ? \App\Helpers\DatetimeHelper::toGregorianDatetime($_GET['fromDate'] . ' 00:00:00') : '' }}">
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="text-right">تا تاریخ</div>
                            <input type="text" name="toDate" class="form-control persianDatePricker text-left" id="to-date" autocomplete="off" value="{{ isset($_GET['toDate']) && trim($_GET['toDate']) != '' ? \App\Helpers\DatetimeHelper::toGregorianDatetime($_GET['toDate'] . ' 00:00:00') : '' }}">
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
                            <th>شناسه نظر</th>
                            <th>نام نظر دهنده</th>
                            <th>ایمیل</th>
                            <th>موبایل</th>
                            <th>خلاصه نظر</th>
                            <th>وضعیت</th>
                            <th>مربوط به مقاله</th>
                            <th>تاریخ ارسال</th>
                            <th>نمایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->mobile }}</td>
                                <td>{{ str_limit($comment->body, 50) }}</td>
                                <td>
                                    <a href="{{ route('dashboard.blog.comments.approve', $comment->id) }}">
                                        @if($comment->approved)
                                            <button type="button" class="btn btn-outline-danger">رد نظر</button>
                                        @else
                                            <button type="button" class="btn btn-outline-success">تایید نظر</button>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.blog.articles.show', $comment->article->id) }}">
                                        {{ $comment->article->title }}
                                    </a>
                                </td>
                                <td>{{ $comment->jalalianCreatedAt() }}</td>
                                <td>
                                    <a href="{{ route('dashboard.blog.comments.edit', $comment->id) }}">
                                        <button class="btn btn-success">نمایش <i class="icon ion-eye tx-15"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger delete-comment" id="delete-comment-{{ $comment->id }}">حذف <i class="icon ion-ios-trash-outline tx-15"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $comments->appends($_GET)->links('dashboard::partials.pagination') }}
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
                    <h6 class="tx-black  tx-semibold mg-b-20">آیا از حذف نظر مطمئنید؟</h6>
                    <p class="pd-x-100"></p>
                    {!! Form::open(['method' => 'DELETE', 'url' => '', 'id' => 'delete-comment-form']) !!}
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

        $(".persianDatePricker").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue :{
                enabled: false
            }
        });

        $('.delete-comment').on('click', function (event) {
            var commentID = $(this).attr('id').substr(15);
            $('#delete-comment-form').attr('action', '{{ route('dashboard.blog.comments.destroy', '') }}/' + commentID);
        });
    </script>

    @if(!isset($_GET['fromDate']) || trim($_GET['fromDate']) == '')
        <script>
            $('#from-date').val('');
        </script>
    @endif

    @if(!(isset($_GET['toDate']) && trim($_GET['toDate']) != ''))
        <script>
            $('#to-date').val('');
        </script>
    @endif
@endsection