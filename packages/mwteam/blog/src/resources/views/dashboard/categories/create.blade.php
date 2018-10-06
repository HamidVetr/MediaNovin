@extends('dashboard::master')

@section('title') ساخت دسته بندی جدید @endsection
@section('blog') active @endsection
@section('blog-categories-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.articles.index') }}" class="breadcrumb-item">دسته بندی</a>
            <span class="breadcrumb-item active">ساخت دسته</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <i class="icon icon ion-android-exit"></i>
        <h4 class="pd-r-10">ساخت دسته جدید</h4>
    </div>
    <div class="pd-t-30">
        <div class="col-md-9">
            <div class="br-section-wrapper-level">
                <form  id="tiketsend">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group row mg-t-20">
                                <label for="" class="col-sm-2 form-control-label">
                                    نام دسته‌ :
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" class="form-control"  name="first_name">
                                </div>
                            </div>
                            <div class="form-group row mg-t-20">
                                <label for="" class="col-sm-2 form-control-label">
                                   دسته مادر :
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select data-placeholder="انتخاب کنید..." class="form-control js-example-placeholder-single" name="status"  id="e9">
                                        <option value=""></option>
                                        <option value="1">پاسخ داده شده</option>
                                        <option value="2">بسته شده</option>
                                        <option value="3">در انتظار پاسخ  </option>
                                        <option value="4">در حال بررسی</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mg-t-20">
                                <label for="" class="col-sm-2 form-control-label">
                                    متن پیام:
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <textarea name="" id="" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mg-t-20">
                                <label for="" class="col-sm-2 form-control-label">
                                    انتخاب فایل:
                                    <span class="tx-danger">*</span>
                                </label>
                                <div class="col-lg-8 col-md-10">
                                    <form class="md-form" action="#">
                                        <div class="file-field">
                                            <div class="btn btn-primary btn-md float-left">

                                            <span>
                                                <i class="fa fa-cloud-upload"></i>
                                            </span>
                                                <span class="pd-r-5">انتخاب فایل</span>
                                                <input type="file" multiple>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="یک یا چند فایل را آپلود کنید">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="btn-demo">
                                    <button class="btn btn-info btn-block mg-b-10">ایجاد دسته</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="br-section-wrapper-category">
                <div class="category-title">
                    <span>انتشار</span>
                </div>
                <br>
                <br>
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
                    <span>دسته بندی</span>
                </div>
                <div class="category-content pd-15">
                    <ul class="pd-r-0">
                        <li>
                            <input type="checkbox" name="publish" id="publish" value="1">
                            <label for="publish" >نمایش کالا در سایت</label>
                        </li>
                        <li>
                            <input type="checkbox" name="product" id="product" value="1">
                            <label for="product">محصولات</label>
                            <ul>
                                <li>
                                    <input type="checkbox" name="sold" id="sold" value="1">
                                    <label for="sold" >محصولات فروخته شده</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="mozayede" id="mozayede" value="1">
                                    <label for="mozayede" >مزایده</label>
                                    <ul>
                                        <li>
                                            <input type="checkbox" name="sold1" id="sold1" value="1">
                                            <label for="sold1" >محصولات فروخته شده</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="sold2" id="sold2" value="1">
                                            <label for="sold2" >محصولات فروخته شده</label>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="br-section-wrapper-category mg-y-20">
                <div class="category-title">
                    <span>برچسب</span>
                </div>
                <div class="pd-x-20 pd-y-20">
                    <div class="form-group">
                        <select data-placeholder="انتخاب کنید..." class="form-control js-example-placeholder-single" name="status"  id="e9">
                            <option value=""></option>
                            <option value="1">پاسخ داده شده</option>
                            <option value="2">بسته شده</option>
                            <option value="3">در انتظار پاسخ  </option>
                            <option value="4">در حال بررسی</option>
                        </select>
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
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $('#e9').select2();

        $(".js-example-placeholder-single").select2({
            placeholder: "انتخاب کنید...",
            allowClear: true
        });
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
