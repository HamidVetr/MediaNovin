@extends('dashboard::master')

@section('title') ویرایش تگ @endsection
@section('blog') active @endsection
@section('blog-tags-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.articles.index') }}" class="breadcrumb-item">برچسب ها</a>
            <span class="breadcrumb-item active">ویرایش برچسب</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-pricetags"></i>
          ویرایش برچسب
        </h4>
    </div>
    <div class="pd-t-30">
        <div class="col-md-9 col-xs-12">
            <div class="br-section-wrapper-level">
                <form  id="tagedit">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group row mg-t-20">
                                <label for="" class="col-sm-2 form-control-label">
                                    نام(فارسی) :
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" class="form-control"  name="first_name">
                                </div>
                            </div>
                            <div class="form-group row mg-t-20">
                                <label for="" class="col-sm-2 form-control-label">
                                    نام (انگلیسی):
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" class="form-control text-LEft" name="english_name">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="btn-demo">
                                    <button class="btn btn-info btn-block mg-b-10">ویرایش برچسب </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="br-section-wrapper-category">
                <div class="category-title">
                    <span>انتشار</span>
                </div>
                <div class="pd-t-20 text-center">
                    <p> تاریخ آخرین انتشار:  <b> 1397/07/15 </b>   </p>
                    <p class="mg-b-0">نوشته شده توسط‌ : <b>مریم محمدی</b> </p>
                </div>
                <div class="category-content">
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
                    <span>تصویر شاخص</span>
                </div>
                <div class="category-content">
                    <div class="wrap">
                        <div class="thumb"> <img id="img" src="https://placeimg.com/300/300/people"/></div>
                        <form action="">
                            <label for="upload">انتخاب فایل
                                <input type='file' id="upload"></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/bootstrapValidator.min.js') }}"></script>
    <script>
        $('#tagedit').bootstrapValidator({
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'نام را وارد کنید'
                        }
                    }
                },
                english_name: {
                    validators: {
                        notEmpty: {
                            message: 'نام انگلیسی را وارد کنید'
                        }
                    }
                }
            }
        })
    </script>
    <script>
        function preview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) { $('#img').attr('src', e.target.result);  }
                reader.readAsDataURL(input.files[0]);     }   }

        $("#upload").change(function(){
            $("#img").css({top: 0, left: 0});
            preview(this);
            $("#img").draggable({ containment: 'parent',scroll: false });
        });
    </script>
@endsection
