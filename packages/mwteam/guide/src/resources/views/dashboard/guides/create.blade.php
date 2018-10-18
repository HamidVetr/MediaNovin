@extends('dashboard::master')

@section('title') ساخت راهنمای جدید @endsection
@section('guide') active @endsection
@section('guide-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
    <script src="{{ asset('assets/dashboard/js/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.guide.index') }}" class="breadcrumb-item">راهنماها</a>
            <span class="breadcrumb-item active">ساخت راهنما</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-book"></i>
            ساخت راهنما
        </h4>
    </div>
    {!! Form::open(['method'=>'POST', 'route' => 'dashboard.guide.store']) !!}
    <div class="pd-t-30">
        <div class="col-md-12">
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
                                ترجمه راهنمای:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('parent_id', ['0' => 'هیچ کدام'] + $parents, null, ['id' => 'parent', 'style' => 'display:none']) !!}
                            </div>
                        </div>

                        <div class="form-group row mg-t-20">
                            <label for="guide_category_id" class="col-sm-2 form-control-label">
                                انتخاب دسته بندی:
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('guide_category_id', ['0' => 'بدون دسته بندی'] + $categories, null, ['id' => 'category', 'style' => 'display:none']) !!}
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
                                <button class="btn btn-info btn-block mg-b-10">ایجاد راهنما </button>
                            </div>
                        </div>
                    </div>
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
            filebrowserUploadUrl: '{{ route('dashboard.blog.articles.uploadInline') }}'
        });
    </script>
@endsection
