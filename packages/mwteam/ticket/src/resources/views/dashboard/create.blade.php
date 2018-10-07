@extends('dashboard::master')

@section('title') ارسال تیکت @endsection
@section('tickets') active @endsection
@section('tickets-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    @if($errors->any())
        @include('dashboard::partials.alert-error',['messages' => $errors->all()])
    @endif

    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'لیست تیکت ها',
         'url' => route('dashboard.tickets.index'),
        ],
        [
         'title' => 'ارسال تیکت',
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'ارسال تیکت'])

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            {!! Form::open(['method'=>'POST', 'url' => route('dashboard.tickets.store'), 'files' => true, 'id' => 'tiketsend']) !!}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label(null, 'عنوان :', ['class' => 'col-sm-2 form-control-label']) !!}

                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label(null, 'نام کاربر :', ['class' => 'col-sm-2 form-control-label']) !!}
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('user',$users, null, ['class' => 'form-control select2', 'placeholder' => 'انتخاب کنید...']) !!}
                            </div>
                        </div>
                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label(null, 'وضعیت تیکت :', ['class' => 'col-sm-2 form-control-label']) !!}
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('status',\Mwteam\Ticket\App\Models\Ticket::statuses(), null, ['class' => 'form-control select2', 'placeholder' => 'انتخاب کنید...']) !!}
                            </div>
                        </div>

                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label(null, 'متن پیام :', ['class' => 'col-sm-2 form-control-label']) !!}
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::textarea('message',null,['cols' => 30, 'rows' => 6, 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row mg-t-20">
                            {!! Form::label(null, 'انتخاب فایل :', ['class' => 'col-sm-2 form-control-label']) !!}

                            <div class="col-lg-8 col-md-10">
                                <div class="file-field">
                                    <div class="btn btn-primary btn-md float-left">
                                        <span>
                                            <i class="fa fa-cloud-upload"></i>
                                        </span>
                                        <span class="pd-r-5">انتخاب فایل</span>
                                        {!! Form::file('file') !!}
                                    </div>
                                    <div class="file-path-wrapper">
                                        {!! Form::text(null, null, ['class' => 'file-path validate']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="btn-demo">
                                {!! Form::submit('ارسال تیکت', ['class'=>'btn btn-info btn-block mg-b-10']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $('.select2').select2();

        $('#tiketsend').bootstrapValidator({
            excluded: ':disabled',
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'عنوان را وارد کنید'
                        }
                    }
                },
                user: {
                    validators: {
                        notEmpty: {
                            message: 'کاربر را انتخاب کنید'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'وضعیت را انتخاب کنید'
                        }
                    }
                },
                message: {
                    validators: {
                        notEmpty: {
                            message: 'متن را وارد کنید'
                        },
                    }
                },
                file: {
                    validators: {
                        file: {
                            type: "{{\App\Helpers\PackageHelper::getConfig('ticket')['validation']['file']['js']['type']}}",
                            maxSize: parseInt("{{\App\Helpers\PackageHelper::getConfig('ticket')['validation']['file']['js']['maxSize']}}"),
                            message: "{{\App\Helpers\PackageHelper::getConfig('ticket')['validation']['file']['js']['message']}}"
                        }
                    }
                },
            }
        });
    </script>
@endsection
