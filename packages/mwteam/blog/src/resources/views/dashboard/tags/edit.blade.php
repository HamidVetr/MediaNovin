@extends('dashboard::master')

@section('title') ویرایش برچسب {{ $tag->name }} @endsection
@section('blog') active @endsection
@section('blog-tags-index') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.tags.index') }}" class="breadcrumb-item">برچسب‌ها</a>
            <span class="breadcrumb-item active">ویرایش برچسب {{ $tag->name }}</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-pricetags"></i>
            ویرایش برچسب {{ $tag->name }}
        </h4>
    </div>
    <div class="pd-t-30">
        <div class="col-md-12">
            <div class="br-section-wrapper-level">
                @include('dashboard::partials.alert-error')
                @include('dashboard::partials.alert-session')
                {!! Form::model($tag , ['method' => 'PUT', 'route' => ['dashboard.blog.tags.update', $tag]]) !!}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row mg-t-20">
                            <label for="title" class="col-sm-2 form-control-label">
                                زبان برچسب:
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
                                ترجمه برچسب:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('parent_id', ['0' => 'هیچ کدام'] + $parents, null, ['id' => 'parent', 'style' => 'display:none']) !!}
                            </div>
                        </div>
                        <div class="form-group row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                نام برچسب:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="btn-demo">
                                <button class="btn btn-warning btn-block mg-b-10">ویرایش دسته</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#language').select2();
        $('#parent').select2();
    </script>
@endsection
