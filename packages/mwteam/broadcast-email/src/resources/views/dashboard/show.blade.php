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
            {{--<fieldset>--}}
                {{--<div class="form-group">--}}
                    {{--<div class="col-lg-12">--}}
                        {{--<h6>{{$email->title}}</h6>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<br>--}}
                {{--<br>--}}
                {{--<div class="form-group">--}}
                    {{--<div class="col-lg-12">--}}
                        {{--<p>{{$email->content}}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<br>--}}
                {{--<br>--}}
                {{--<div class="form-group">--}}
                    {{--<div class="col-lg-12">--}}
                        {{--<span class="tx-12">{{'تاریخ '.\App\Helpers\DatetimeHelper::toJalaliDate($email->created_at).--}}
                        {{--' ساعت: '. \App\Helpers\DatetimeHelper::toWithoutSecondsTime($email->created_at)}}</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</fieldset>--}}

            {{--<br><br>--}}
            {{--<h4>کاربران:</h4>--}}
            {{--<br>--}}
            {{--@if(is_null($users))--}}
                {{--<p>همه کاربران</p>--}}
            {{--@else--}}
                {{--<ul>--}}
                    {{--@foreach($users as $user)--}}
                        {{--<li>&lt; {{$user->username}} &lt;  {{$user->email}} </li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--@endif--}}

            <div class="panel-body showMail">
                <div class="row newleave rtlfloat">
                    <div class="col-md-9 col-sm-12 col-xs-12 rightside">
                         <div class="msg">
                              <header>
                                  <h4 class="uk-comment-title">
                                      علی حسنی
                                  </h4>
                                  <div class="uk-comment-meta">
                                      سه شنبه، 10 مهر 1397 ساعت 16:05
                                  </div>
                              </header>
                             <div class="matnmsg">
                                 باعرض سلام و خسته نباشید


                                 روال ویروس یابی و ویروس کشی سایت های وردپرسی به شرح زیر است:


                                 1- اسکن خودکار توسط سرور (آدرس سایت را برای آقای بی نیاز ارسال نمایید تا این روال انجام شود)


                                 2- جایگزینی هسته ی وردپرس ، حذف افزونه ی duplicator و پاک سازی wp-config.php را انجام دهید.


                                 3- پس از تکمیل مرحله ی اول و دوم ، توسط فایل ضمیمه شده الگوهای زیر را جستجو و فایل های یافت شده را مشاهده و  پاک نمایید.
                             </div>
                         </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <ul class="msgdetail">
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="fa fa-calendar-check-o"></i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">
                                        تاریخ ارسال
                                    </span>
                                    <span class="uk-text-small uk-text-muted">
سه شنبه، 10 مهر 1397 ساعت 16:05
                                    </span>
                                </div>
                            </li>
                            <li class="groupmsg no-border">
                                <div class="md-list-addon-element">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">لیست کاربران

                                        <div class="form-group form-animate-text">
                                             <select name="" id="select111" class="form-text">
                                                 <option value="" selected>sjdbnjsdhf</option>
                                                 <option value="">DFKGNDJFG</option>
                                                 <option value="">dkjfhdfgdfg</option>
                                             </select>
                                        </div>
						              </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom-assets')

@endsection