@extends('dashboard::master')

@section('title') پروفایل @endsection
@section('blog') active @endsection
@section('blog-articles-index') active @endsection

@section('top-assets')

@endsection

@section('content')

    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
    [
     'title' => 'پروفایل',
     'url' => route('dashboard.admins.index'),
    ],
    [
     'title' => 'ویرایش پروفایل',
     'url' => null,
    ],
]])
    @include('dashboard::partials.page-title', ['title' => 'پروفایل', 'icon' => 'ion-android-person'])

    <div class="pd-t-30">
        <form action="" id="admin_profile">
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-layout form-layout-4">
                        <div class="row mg-t-20">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    <label for="first_name" class="col-sm-2 form-control-label">نام :</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" name="first_name" value="علی">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    <label for="last_name" class="col-sm-2 form-control-label">نام خانوادگی :</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" name="last_name" value="حسنی">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mg-t-20">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    <label for="username" class="col-sm-2 form-control-label">نام کاربری :</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control text-LEft" name="username" value="user@">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    <label for="email" class="col-sm-2 form-control-label">ایمیل :</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control text-LEft" name="email" value="user@">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    <label for="password" class="col-sm-2 form-control-label">رمز عبور :</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="password" class="form-control text-LEft" name="password" value="user@">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    <label for="password_confirmation" class="col-sm-2 form-control-label">تکرار رمز عبور :</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="password" class="form-control text-LEft" name="password_confirmation" value="user@">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30 text-center">
                           <button type="submit" class="btn btn-info">
                               ذخیره تغییرات
                               <i class="fa fa-floppy-o"></i>
                           </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('bottom-assets')
    <script>
        $('#admin_profile').bootstrapValidator({
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'نام را وارد کنید'
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'نام خانوادگی را وارد کنید'
                        }
                    }
                },
                username: {
                    validators: {
                        notEmpty: {
                            message: 'نام کاربری را وارد کنید'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'ایمیل را وارد کنید'
                        },
                        emailAddress: {
                            message: 'فرمت ایمیل صحیح نمی باشد'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'رمز عبور را وارد کنید '
                        },
                        identical: {
                            field: 'password_confirmation',
                            message: 'رمز عبور و تکرار آن یکسان نیست '
                        },
                        stringLength: {
                            min: 6,
                            message: 'رمز عبور باید حداقل 6 کارکتر باشد '
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'تکرار رمز عبور را وارد کنید '
                        },
                        identical: {
                            field: 'password',
                            message: 'رمز عبور و تکرار آن یکسان نیست '
                        },
                        stringLength: {
                            min: 6,
                            message: 'تکرار رمز عبور باید حداقل 6 کارکتر باشد'
                        }
                    }
                }
            }
        })
    </script>
@endsection