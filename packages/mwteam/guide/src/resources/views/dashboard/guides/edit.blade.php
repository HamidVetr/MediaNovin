@extends('dashboard::master')

@section('title') ویرایش راهنما {{ $guide->title }} @endsection
@section('guide') active @endsection
@section('guide-index') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
    <script src="{{ asset('assets/dashboard/js/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.guide.index') }}" class="breadcrumb-item">راهنماها</a>
            <span class="breadcrumb-item active"> ویرایش راهنما {{ $guide->title }}</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-book"></i>
            ویرایش راهنما {{ $guide->title }}
        </h4>
    </div>
    {!! Form::model($guide , ['method' => 'PUT', 'route' => ['dashboard.guide.update', $guide->id], 'files' => true]) !!}
    <div class="pd-t-30">
        <div class="col-md-9">
            <div class="br-section-wrapper-level">
                @include('dashboard::partials.alert-error')
                @include('dashboard::partials.alert-session')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row mg-t-20">
                            <label for="title" class="col-sm-2 form-control-label">
                                زبان راهنما:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('language', [
                                    'fa' => 'فارسی',
                                    'en' => 'انگلیسی',
                                    'ar' => 'عربی',
                                ], null, ['id' => 'language', 'style' => 'display:none']) !!}
                            </div>
                        </div>

                        <div class="form-group row mg-t-20">
                            <label for="title" class="col-sm-2 form-control-label">
                                ترجمه راهنما‌ی:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('parent_id', ['0' => 'هیچ کدام'] + $parents, null, ['id' => 'parent', 'style' => 'display:none']) !!}
                            </div>
                        </div>

                        <div class="form-group row mg-t-20">
                            <label for="title" class="col-sm-2 form-control-label">
                                عنوان:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
                            </div>
                        </div>

                        <div class="form-group row mg-t-20">
                            <label for="body" class="col-sm-2 form-control-label">
                                متن راهنما:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body', 'style' => 'display:none']) !!}
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="btn-demo">
                                <button class="btn btn-warning btn-block mg-b-10">ویرایش راهنما </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="br-section-wrapper-category">
                <div class="category-title">
                    <span>انتشار</span>
                </div>
                <div class="pd-t-20 text-center">
                    <p> تاریخ انتشار:  <b> {{ $guide->jalalianCreatedAt() }} </b>   </p>
                    <p>نوشته شده توسط‌ : <b>{{ $guide->author->full_name }}</b> </p>
                    @if(!is_null($guide->editor_id))
                        <p> تاریخ آخرین ویرایش:  <b> {{ $guide->jalalianUpdatedAt() }} </b>   </p>
                        <p>آخرین ویرایش توسط‌ : <b>{{ $guide->editor->full_name }}</b> </p>
                    @endif
                </div>
                <div class="category-content pd-15">
                    <div class="row justify-content-center">
                        <a href="" class="btn btn-danger btn-with-icon mg-y-20 mg-x-5">
                            <div class="ht-40">
                                <span class="icon wd-40">
                                    <i class="fa fa-eye"></i>
                                </span>
                                <span class="pd-x-15">
                                       پیش نمایش
                                </span>
                            </div>
                        </a>

                        <a href="" class="btn btn-success btn-with-icon mg-y-20 mg-x-5">
                            <div class="ht-40">
                                <span class="icon wd-40">
                                    <i class="fa fa-floppy-o"></i>
                                </span>
                                <span class="pd-x-35">
                                    ذخیره
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="br-section-wrapper-category mg-y-20">
                <div class="category-title">
                    <span>انتخاب دسته بندی</span>
                </div>
                <div class="category-content pd-15">
                    {!! Form::select('guide_category_id', ['0' => 'بدون دسته بندی'] + $categories, null, ['id' => 'category', 'style' => 'display:none']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#category').select2({
            placeholder: "انتخاب کنید...",
        });

        $('#language').select2();
        $('#parent').select2();
    </script>
    <script>
        var editor = CKEDITOR.replace( 'body', {
            filebrowserUploadUrl: '{{ route('dashboard.blog.articles.uploadInline') }}',
        });
    </script>
@endsection
