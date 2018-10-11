@extends('dashboard::master')

@section('title') جزئیات پیام @endsection
@section('broadcast-email') active @endsection
@section('broadcast-email-index') active @endsection

@section('top-assets')

@endsection

@section('content')
    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'پیام ها',
         'url' => route('dashboard.broadcastEmail.index'),
        ],
        [
         'title' => 'جزئیات پیام',
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'جزئیات پیام', 'icon' => 'ion-ios-email'])

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <fieldset>
                <div class="form-group">
                    <div class="col-lg-12">
                        <h6>{{$email->title}}</h6>
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <div class="col-lg-12">
                        <p>{{$email->content}}</p>
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <div class="col-lg-12">
                        <span class="tx-12">{{'تاریخ '.\App\Helpers\DatetimeHelper::toJalaliDate($email->created_at).
                        ' ساعت: '. \App\Helpers\DatetimeHelper::toWithoutSecondsTime($email->created_at)}}</span>
                    </div>
                </div>
            </fieldset>

            <br><br>
            <h4>کاربران:</h4>
            <br>
            @if(is_null($users))
                <p>همه کاربران</p>
            @else
                <ul>
                    @foreach($users as $user)
                        <li>&lt; {{$user->username}} &lt;  {{$user->email}} </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection

@section('bottom-assets')

@endsection