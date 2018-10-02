@extends('dashboard::master')

@section('title')
    جزئیات تیکت
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('dashbord/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="" class="breadcrumb-item">خانه</a>
            <a href="" class="breadcrumb-item">تیکت ها</a>
            <span class="breadcrumb-item active">نمایش تیکت</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <i class="icon icon ion-android-exit"></i>
        <h4 class="pd-r-10">نمایش تیکت</h4>
    </div>
    <div class="pd-t-30">
        <div class="row">
            <div class="col-md-9">
                <div class="br-section-wrapper-level">
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
                </div>
            </div>
            <div class="col-md-3">
                <div class="br-section-wrapper-level">
                    <div class="list-group list-group-flush mg-t-20">
                         <div class="list-group-item">
                             <i class="fa fa-user"></i>
                             نام کاربری
                             : user
                         </div>
                        <div class="list-group-item">
                            <i class="fa fa-newspaper-o"></i>
                            سمت:
                            کاربر عادی
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-mobile"></i>
                            شماره تماس : 09123456781
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-cog"></i>
                            وضعیت تیکت :
                            <br>
                            <br>
                            <div class="form-group row">
                                <select data-placeholder="انتخاب کنید..." class="form-control js-example-placeholder-single" name="status"  id="e9">
                                    <option value=""></option>
                                    <option value="1">پاسخ داده شده</option>
                                    <option value="2">بسته شده</option>
                                    <option value="3">در انتظار پاسخ  </option>
                                    <option value="4">در حال بررسی</option>
                                </select>
                             </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row justify-content-center"><
                                <div class="col-md-2">
                                       <button class="btn btn-danger active btn-block mg-b-10">حذف</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-footer')
    <script type="text/javascript" src="{{ asset('dashbord/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#e9').select2();

        $(".js-example-placeholder-single").select2({
            placeholder: "انتخاب کنید...",
            allowClear: true
        });
    </script>
@endsection
