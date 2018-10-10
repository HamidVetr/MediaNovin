@extends('dashboard::master')

@section('title') لیست مقالات @endsection
@section('blog') active @endsection
@section('blog-articles-index') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/persian-datepicker-0.4.5.css') }}">
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
            <span class="breadcrumb-item active">مقالات</span>
        </nav>
    </div>
    <div class="br-pagetitle row pd-r-0">
        <div class="col-lg-6 col-xs-6">
            <h4 class="pd-r-10">
                <i class="icon ion-ios-book"></i>
                لیست مقالات
            </h4>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="heading-elements">
                <a href="{{ route('dashboard.blog.articles.create') }}" class="btn btn-info btn-with-icon btn-block">
                    <div class="ht-40 justify-content-between">
                        <span class="ht-58 justify-content-between pd-r-20 pd-l-20"> ایجاد مقاله جدید</span>
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
                    {!! Form::open(['method'=>'GET', 'route' => 'dashboard.blog.articles.index']) !!}
                        <div class="row">
                            <div class="col-md-2 col-xs-6">
                                <div class="text-right">عنوان</div>
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-2 col-xs-6">
                                <div class="text-right">کاربر</div>
                                {!! Form::text('user', null, ['class' => 'form-control']) !!}
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
                            <th>شناسه مقاله</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>خلاصه مقاله</th>
                            <th>تعداد نظرات</th>
                            <th>تاریخ ساخت</th>
                            <th>ساخته شده توسط</th>
                            <th>آخرین بروزرسانی</th>
                            <th>بروزرسانی توسط</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td><img style="border-radius: 25px; width: 50px; height: 50px;" src="{{ is_null($article->image) ? 'https://api.adorable.io/avatars/50/' . $article->id . '@adorable.png' : $article->getImage() }}"></td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->description }}</td>
                                <td>{{ $article->comments }}</td>
                                <td>{{ $article->jalalianCreatedAt() }}</td>
                                <td>{{ $article->author->full_name }}</td>
                                <td>{{ $article->jalalianUpdatedAt() }}</td>
                                <td>{{ is_null($article->editor_id) ? $article->author->full_name : $article->editor->full_name }}</td>
                                <td>
                                    <a href="{{ route('dashboard.blog.articles.edit', $article->id) }}">
                                        <button class="btn btn-warning">ویرایش</button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modal-delete-article" class="btn btn-danger delete-article" id="delete-article-{{ $article->id }}">حذف </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $articles->appends($_GET)->links('dashboard::partials.pagination') }}
            </div>
        </div>
    </div>

    <div id="modal-delete-article" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h6 class="tx-black  tx-semibold mg-b-20">آیا از حذف مقاله مطمئنید؟</h6>
                    <h6 class="tx-black  tx-semibold mg-b-20"><span style="color: red">نکته:</span> با حذف مقاله اصلی، تمام ترجمه های آن نیز پاک می گردد</h6>
                    <p class="pd-x-100"></p>
                    {!! Form::open(['method' => 'DELETE', 'url' => '', 'id' => 'delete-article-form']) !!}
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

        $('.delete-article').on('click', function (event) {
            var articleID = $(this).attr('id').substr(15);
            $('#delete-article-form').attr('action', '{{ route('dashboard.blog.articles.destroy', '') }}/' + articleID);
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