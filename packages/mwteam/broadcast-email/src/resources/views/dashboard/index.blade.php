@extends('dashboard::master')

@section('title') پیام ها @endsection
@section('broadcast-email') active @endsection
@section('broadcast-email-index') active @endsection

@section('page-title')
    <div class="heading-elements">
        <a href="{{route('dashboard.broadcastEmail.create')}}" class="btn btn-info btn-with-icon btn-block">
            <div class="ht-40 justify-content-between">
                <span class="ht-58 justify-content-between pd-r-20 pd-l-20"> ایجاد پیام</span>
                <span class="icon wd-40">
                             <i class="fa fa-plus"></i>
                         </span>
            </div>
        </a>
    </div>
@endsection

@section('content')
    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'پیام ها',
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'پیام ها', 'icon' => 'ion-ios-email'])

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            @include('dashboard::partials.alert-session')

            <div class="card">
                <div class="card-header" id="heading-example">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example">
                            <i class="fa fa-chevron-down pull-left"></i>
                            <h6 class="tx-16">جستجو در لیست پیام ها</h6>
                        </a>
                    </h5>
                </div>
                <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
                    <div class="card-block">
                        {!! Form::open(['method'=>'get', 'url' => route('dashboard.broadcastEmail.index'), 'files' => false]) !!}
                            <div class="mg-x-50 mg-y-20">
                                <div class="input-group">
                                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'عنوان مورد نظر را وارد نمایید']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            جستجو <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            @if($emails->count() == 0)
                @if($hasfilter == true)
                    <h4>موردی یافت نشد</h4>
                @else
                    <h4>پیامی ایجاد نشده است</h4>
                @endif
            @else
                <div class="rounded table-responsive">
                    <table class="table mg-b-0 table-tickets table-striped">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>تاریخ ارسال</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($emails as $email)
                                <tr>
                                    <td>{{$email->id}}</td>
                                    <td>{{$email->title}}</td>
                                    <td>{{\App\Helpers\DatetimeHelper::toJalaliDate($email->created_at) .' ساعت ' .
                                        \App\Helpers\DatetimeHelper::toWithoutSecondsTime($email->created_at)}}</td>
                                    <td>
                                        <a href="{{route('dashboard.broadcastEmail.show',['emailId' => $email->id])}}">
                                            <img src="{{ asset('assets/dashboard/images/notes.png') }}" data-toggle="tooltip" data-original-title="مشاهده عملیات">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="text-center content-group-lg pt-20">
                @if($hasFilter == true)
                    {{$emails->appends($request)->links('dashboard::partials.pagination')}}
                @else
                    {{$emails->links('dashboard::partials.pagination')}}
                @endif
            </div>
        </div>
    </div>
@endsection
