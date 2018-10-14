@extends('dashboard::master')

@section('title') ساخت مقاله جدید @endsection
@section('blog') active @endsection
@section('blog-articles-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
    <script src="{{ asset('assets/dashboard/js/ckeditor-5/ckeditor.js') }}"></script>
    <style>
        .ck-editor__editable {
            min-height: 200px;
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.articles.index') }}" class="breadcrumb-item">مقالات</a>
            <span class="breadcrumb-item active">ساخت مقاله</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-book"></i>
            ساخت مقاله
        </h4>
    </div>
    {!! Form::open(['method'=>'POST', 'route' => 'dashboard.blog.articles.store', 'files' => true]) !!}
        <div class="pd-t-30">
            <div class="col-md-9 col-xs-12">
                <div class="br-section-wrapper-level">
                    @include('dashboard::partials.alert-error')
                    @include('dashboard::partials.alert-session')
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group row mg-t-20">
                                <label for="title" class="col-sm-2 form-control-label">
                                    زبان مقاله:
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
                                    ترجمه مقاله‌ی:
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
                                <label for="description" class="col-sm-2 form-control-label">
                                    خلاصه:
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                                </div>
                            </div>

                            <div class="form-group row mg-t-20">
                                <label for="body" class="col-sm-2 form-control-label">
                                    متن مقاله:
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body', 'style' => 'display:none']) !!}
                                </div>
                            </div>

                            {{--<div class="form-group row mg-t-20">--}}
                                {{--<label for="" class="col-sm-2 form-control-label">--}}
                                    {{--انتخاب فایل:--}}
                                    {{--<span class="tx-danger">*</span>--}}
                                {{--</label>--}}
                                {{--<div class="col-lg-8 col-md-10">--}}
                                    {{--<form class="md-form" action="#">--}}
                                        {{--<div class="file-field">--}}
                                            {{--<div class="btn btn-primary btn-md float-left">--}}

                                            {{--<span>--}}
                                                {{--<i class="fa fa-cloud-upload"></i>--}}
                                            {{--</span>--}}
                                                {{--<span class="pd-r-5">انتخاب فایل</span>--}}
                                                {{--<input type="file" multiple>--}}
                                            {{--</div>--}}
                                            {{--<div class="file-path-wrapper">--}}
                                                {{--<input class="file-path validate" type="text" placeholder="یک یا چند فایل را آپلود کنید" name="file">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="row justify-content-center">
                                <div class="btn-demo">
                                    <button class="btn btn-info btn-block mg-b-10">ایجاد مقاله </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="br-section-wrapper-category">
                    <div class="category-title">
                        <span>انتشار</span>
                    </div>
                    {{--<div class="pd-t-20 text-center">--}}
                        {{--<p> تاریخ آخرین انتشار:  <b> 1397/07/15 </b>   </p>--}}
                        {{--<p class="mg-b-0">نوشته شده توسط‌ : <b>مریم محمدی</b> </p>--}}
                    {{--</div>--}}
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
                    <div class="category-content pd-15 form-group row">
                        {!! Form::select('blog_category_id', ['0' => 'بدون دسته بندی'] + $categories, null,['id' => 'category','class' => 'form-control', 'style'  => 'display:none']) !!}
                    </div>
                </div>
                <div class="br-section-wrapper-category mg-y-20">
                    <div class="category-title">
                        <span>انتخاب برچسب</span>
                    </div>
                    <div class="pd-x-20 pd-y-20">
                        <div class="form-group row">
                            <label for="multi-select"></label>
                            {!! Form::label('tags', 'برچسب مناسب را انتخاب کنید') !!}
                            <br>
                            {!! Form::select('tags[]', $tags, null, ['multiple' => 'multiple', 'id' => 'tags','class' => 'form-control', 'style' => 'display:none']) !!}
                        </div>
                    </div>
                </div>
                <div class="br-section-wrapper-category mg-y-20">
                    <div class="category-title">
                        <span>تصویر شاخص</span>
                    </div>
                    <div class="category-content">
                        <div class="wrap">
                            <div class="thumb"> <img id="img" src="https://via.placeholder.com/300x300"></div>
                            <label for="upload">انتخاب فایل
                                <input type='file' name="index_image" id="upload">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/bootstrapValidator.min.js') }}"></script>
    <script type="text/javascript">
        $('#tags').select2({
            placeholder: "انتخاب کنید...",
            allowClear: true,
            width: "300px"
        });

        $('#category').select2({
            placeholder: "انتخاب کنید...",
            width: "300px"
        });

        $('#language').select2();
        $('#parent').select2();
    </script>
    <script>
        ClassicEditor.create( document.querySelector( '#body' ), {
            ckfinder: {
                uploadUrl: '{{ route('dashboard.blog.articles.uploadInline') }}'
            }
        } );

        function preview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#upload").change(function(){
            $("#img").css({top: 0, left: 0});
            preview(this);
            // $("#img").draggable({ containment: 'parent',scroll: false });
        });
    </script>
    <script>
        $('#addArticle').bootstrapValidator({
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'باید عنوان فارسی را وارد کنید'
                        }
                    }
                },

                body: {
                    validators: {
                        notEmpty: {
                            message: 'باید متن فارسی مقاله را وارد کنید'
                        }
                    }
                },
                // file: {
                //     validators: {
                //         notEmpty: {
                //             message: 'فایل مورد نظر را وارد کنید'
                //         }
                //     }
                // }
            }
        })
    </script>
@endsection
