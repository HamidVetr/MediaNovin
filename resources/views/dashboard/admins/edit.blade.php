@extends('dashboard.master')

@section('title')
    ویرایش مدیر
@endsection

@section('content')
        <div class="br-pageheader">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a href="" class="breadcrumb-item">خانه</a>
                <a href="" class="breadcrumb-item">مدیران سایت</a>
                <span class="breadcrumb-item active">ویرایش اطلاعات</span>
            </nav>
        </div>

        <div class="br-pagetitle">
            <i class="icon icon ion-android-exit"></i>
            <h4 class="pd-r-10">ویرایش اطلاعات</h4>
        </div>
        <div class="pd-t-30">
            <form  id="adminadd">
             <div class="row">
                <div class="col-xl-12">
                    <div class="form-layout form-layout-4">
                        <div class="row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                نام :
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control"  name="first_name">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                نام خانوادگی :
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                نام کاربری:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                ایمیل:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                رمز عبور:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control"  name="password">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                تکرار رمز عبور:
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control"   name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button type="submit" class="btn btn-info">ویرایش مدیر</button>
                        </div>

                    </div>
                </div>
            </div>
         </form>
        </div>
@endsection
@section('js-footer')
    <script type="text/javascript" src="/dashbord/js/bootstrapValidator.min.js"></script>
    <script>
        $('#adminadd').bootstrapValidator({
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'لطفا نام را وارد کنید'
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'لطفا نام خانوادگی را وارد کنید'
                        }
                    }
                },
                username: {
                    validators: {
                        notEmpty: {
                            message: 'لطفا نام کاربری را وارد کنید'
                        }
                    }
                },
                mobile: {
                    validators: {
                        notEmpty: {
                            message: 'لطفا شماره موبایل خود   را وارد کنید'
                        },
                    }
                },
                'national-id': {
                    validators: {
                        notEmpty: {
                            message: 'لطفا شماره ملی خود را وارد کنید'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'تعداد ارقام کد ملی باید 10 عدد باشد'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'لطفا آدرس پست الکترونیکی را وارد کنید'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'رمز عبور را وارد کنید'
                        },
                        identical: {
                            field: 'password_confirmation',
                            message: 'رمز عبور و تکرار آن یکسان نیست'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'تکرار گذرواژه را لطفا وارد کنید'
                        },
                        identical: {
                            field: 'password',
                            message: 'رمز عبور و تکرار آن یکسان نیست'
                        }
                    }
                }
            }
        })
    </script>
@endsection