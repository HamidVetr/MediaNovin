@extends('dashboard::master')

@section('title') ارسال پیام @endsection
@section('broadcast-email') active @endsection
@section('broadcast-email-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'پیام ها',
         'url' => route('dashboard.broadcastEmail.index'),
        ],
        [
         'title' => 'ارسال پیام',
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'جزئیات پیام', 'icon' => 'ion-ios-email'])

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            @include('dashboard::partials.alert-error')

            {!! Form::open(['method'=>'POST', 'url' => route('dashboard.broadcastEmail.store'), 'files' => false, 'id' => 'send']) !!}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label('title', 'عنون پیام:', ['class' => 'col-sm-2 form-control-label']) !!}

                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label('users', 'انتخاب کاربر:', ['class' => 'col-sm-2 form-control-label']) !!}

                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::select('users[]',$users, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'انتخاب کنید...']) !!}
                            </div>
                        </div>
                        <div class="form-group row mg-t-20">
                            <span class="tx-danger">*</span>
                            {!! Form::label('content', 'متن پیام:', ['class' => 'col-sm-2 form-control-label']) !!}

                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                {!! Form::textarea('content',null,['rows' => '6', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn-demo">
                                {!! Form::submit('ارسال پیام', ['class'=>'btn btn-info btn-block mg-b-10']) !!}
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

        $('#send').bootstrapValidator({
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'عنوان پیام را وارد کنید'
                        }
                    }
                },
                users: {
                    validators: {
                        notEmpty: {
                            message: 'کاربران را انتخاب کنید'
                        }
                    }
                },
                content: {
                    validators: {
                        notEmpty: {
                            message: 'متن پیام را وارد کنید'
                        }
                    }
                }
            }
        });
    </script>
@endsection