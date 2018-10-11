@extends('dashboard::master')

@section('title') برچسب‌ها @endsection
@section('blog') active @endsection
@section('blog-tags-index') active @endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <span class="breadcrumb-item active">برچسب‌ها</span>
        </nav>
    </div>
    <div class="br-pagetitle row pd-r-0">
        <div class="col-lg-6 col-xs-6">
            <h4 class="pd-r-10">
                <i class="icon ion-ios-pricetags"></i>
                برچسب‌ها
            </h4>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="heading-elements">
                <a href="{{ route('dashboard.blog.tags.create') }}" class="btn btn-info btn-with-icon btn-block">
                    <div class="ht-40 justify-content-between">
                        <span class="ht-58 justify-content-between pd-r-20 pd-l-20">ایجاد برچسب جدید</span>
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
                    {!! Form::open(['method'=>'GET', 'route' => 'dashboard.blog.tags.index']) !!}
                        <div class="row">
                            <div class="col-md-2 col-xs-6">
                                <div class="text-right">نام برچسب</div>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
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
                            <th>شناسه برچسب</th>
                            <th>نام</th>
                            <th>تعداد مقالات</th>
                            <th>تاریخ ساخت</th>
                            <th>آخرین بروزرسانی</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->articles->count() }}</td>
                                <td>{{ $tag->jalalianCreatedAt() }}</td>
                                <td>{{ $tag->jalalianUpdatedAt() }}</td>
                                <td>
                                    <a href="{{ route('dashboard.blog.tags.edit', $tag->id) }}">
                                        <button class="btn btn-warning">ویرایش <i class="icon ion-edit tx-15"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger delete-tag" id="delete-tag-{{ $tag->id }}">حذف <i class="icon ion-ios-trash-outline tx-15"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $tags->appends($_GET)->links('dashboard::partials.pagination') }}
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
                    <h6 class="tx-black  tx-semibold mg-b-20">آیا از حذف برچسب مطمئنید؟</h6>
                    <h6 class="tx-black  tx-semibold mg-b-20"><span style="color: red">نکته:</span> با حذف برچسب اصلی، تمام ترجمه های آن نیز پاک می گردد</h6>
                    <p class="pd-x-100"></p>
                    {!! Form::open(['method' => 'DELETE', 'url' => '', 'id' => 'delete-tag-form']) !!}
                        <button type="submit" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">حذف</button>
                        <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">انصراف</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script type="text/javascript">
        $('.searchbtn').click(function(){
            $('#searchboxpage').stop().slideToggle();
        });

        $('.delete-tag').on('click', function (event) {
            var tagID = $(this).attr('id').substr(11);
            $('#delete-tag-form').attr('action', '{{ route('dashboard.blog.tags.destroy', '') }}/' + tagID);
        });
    </script>
@endsection