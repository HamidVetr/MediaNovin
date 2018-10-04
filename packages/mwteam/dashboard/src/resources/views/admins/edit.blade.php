@extends('dashboard::master')

@section('title') ویرایش مدیر @endsection
@section('admins') active @endsection

@section('content')
    @if($errors->any())
        @include('dashboard::partials.alert-error',['messages' => $errors->all()])
    @endif

    @if(session()->has('success'))
        @include('dashboard::partials.alert-success',['messages' => [session()->get('success')]])
    @endif

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
        {!! Form::model($admin , ['method'=>'PUT', 'route' => ['dashboard.admins.update','adminId' => $admin->id], 'files' => false ,'id'=>'adminadd']) !!}
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-layout form-layout-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    {!! Form::label('first_name', 'نام:', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    {!! Form::label('last_name', 'نام خانوادگی:', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    {!! Form::label('username', 'نام کاربری:', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        {!! Form::text('username', null, ['class' => 'form-control text-LEft']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">*</span>
                                    {!! Form::label('email', 'ایمیل:', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        {!! Form::text('email', null, ['class' => 'form-control text-LEft']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">&nbsp;</span>
                                    {!! Form::label('password', 'رمز عبور:', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        {!! Form::password('password', ['class' => 'form-control text-LEft']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <span class="tx-danger" style="margin-top: 12px;">&nbsp;</span>
                                    {!! Form::label('password_confirmation', 'تکرار رمز عبور:', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        {!! Form::password('password_confirmation', ['class' => 'form-control text-LEft']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30 text-center">
                            {!! Form::submit('ویرایش مدیر', ['class' => 'btn btn-info']) !!}
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('bottom-assets')
    <script type="text/javascript" src="../assets/dashboard/js/bootstrapValidator.min.js"></script>
    <script>
        $('#adminadd').bootstrapValidator({
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
                        identical: {
                            field: 'password_confirmation',
                            message: 'رمز عبور و تکرار آن یکسان نیست'
                        },
                        stringLength: {
                            min: 6,
                            message: 'رمز عبور باید حداقل 6 کارکتر باشد'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'رمز عبور و تکرار آن یکسان نیست'
                        },
                        stringLength: {
                            min: 6,
                            message: 'تکرار رمز عبور باید حداقل 6 کارکتر باشد'
                        }
                    }
                }
            }
        });
    </script>
@endsection