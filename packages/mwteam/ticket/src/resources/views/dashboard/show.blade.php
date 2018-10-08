@extends('dashboard::master')

@section('title') جزئیات تیکت @endsection
@section('tickets') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    @if($errors->any())
        @include('dashboard::partials.alert-error',['messages' => $errors->all()])
    @endif

    @if(session()->has('success'))
        @include('dashboard::partials.alert-success',['messages' => [session()->get('success')]])
    @endif

    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'لیست تیکت ها',
         'url' => route('dashboard.tickets.index'),
        ],
        [
         'title' => 'تیکت شماره '. $ticket->id,
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'تیکت شماره '. $ticket->id, 'icon' => 'ion-email'])

    <div class="pd-t-30">
        <div class="row">
            <div class="col-md-9">
                <div class="br-section-wrapper-level">

                   <div class="panel-heading">
                       <h6 class="panel-title">{{$ticket->id .' - '. $ticket->title}}</h6>
                   </div>
                    <div class="">
                        <ul class="media-list chat-list content-group">
                            @foreach($ticket->messages as $message)
                                @if($message->sender == $ticket->userWithTrashed->id)
                                    <li class="media reversed">
                                        <div class="media-body">
                                            <div class="media-content">
                                                {{$message->message}}
                                            </div>
                                            <span class="media-annotation display-block">
                                                <i class="fa fa-calendar position-right text-muted"></i>
                                                {{\App\Helpers\DatetimeHelper::toWithoutSecondsTime($message->updated_at)}}
                                                {{\App\Helpers\DatetimeHelper::toJalaliDate($message->updated_at)}}

                                                @can('ticketsDelete',\Mwteam\Ticket\App\Models\Ticket::class)
                                                    <a href="" data-toggle="modal" data-target="#modal-delete-message-{{$message->id}}">
                                                        <i class="fa fa-trash position-right text-muted"></i>
                                                    </a>

                                                    {!! Form::open(['method'=>'DELETE', 'url' => route('dashboard.tickets.destroyMessage',['ticketId' => $ticket->id, 'messageId' => $message->id]), 'files' => false, 'style' => 'display:inline-block;']) !!}
                                                    <div id="modal-delete-message-{{$message->id}}" class="modal fade">
                                                  <div class="modal-dialog modal-lg" role="document">
                                                      <div class="modal-content tx-size-sm">
                                                          <div class="modal-body tx-center pd-y-20 pd-x-20">
                                                              <a href="" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </a>
                                                              <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                                                              <h6 class="tx-black  tx-semibold mg-b-20">پیام حذف شود؟</h6>
                                                              <p class="pd-x-100"></p>
                                                              <button type="submit" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">تایید</button>
                                                              <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">انصراف</button>
                                                          </div><!-- modal-body -->
                                                      </div><!-- modal-content -->
                                                  </div><!-- modal-dialog -->
                                                </div><!-- modal -->
                                                    {!! Form::close() !!}
                                                @endcan

                                                @if(!is_null($message->file))
                                                    <a href="{{route('dashboard.tickets.file',['ticketId' => $ticket->id, 'fileName' => $message->file])}}">
                                                        <i class="fa fa-download position-right text-muted"></i>
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="media-right">
                                            <img src="{{ \App\Models\User::getAvatar($message->senderWithTrashed) }} " alt="" class="img-circle img-md">
                                        </div>
                                    </li>
                                @else
                                    <li class="media">
                                        <div class="media-left">
                                            <img src="{{ \App\Models\User::getAvatar($message->senderWithTrashed) }} " alt="" class="img-circle img-md">
                                        </div>

                                        <div class="media-body">
                                            <div class="media-content">
                                                <h6>{{$message->senderWithTrashed->username}}:</h6>
                                                {{$message->message}}
                                            </div>
                                            <span class="media-annotation display-block">
                                                <i class="fa fa-calendar position-right text-muted"></i>
                                                {{\App\Helpers\DatetimeHelper::toWithoutSecondsTime($message->updated_at)}}
                                                {{\App\Helpers\DatetimeHelper::toJalaliDate($message->updated_at)}}

                                                @can('ticketsDelete',\Mwteam\Ticket\App\Models\Ticket::class)
                                                    <a href="" data-toggle="modal" data-target="#modal-delete-message-{{$message->id}}">
                                                        <i class="fa fa-trash position-right text-muted"></i>
                                                    </a>

                                                    {!! Form::open(['method'=>'DELETE', 'url' => route('dashboard.tickets.destroyMessage',['ticketId' => $ticket->id, 'messageId' => $message->id]), 'files' => false, 'style' => 'display:inline-block;']) !!}
                                                    <div id="modal-delete-message-{{$message->id}}" class="modal fade">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content tx-size-sm">
                                                                <div class="modal-body tx-center pd-y-20 pd-x-20">
                                                                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </a>
                                                                    <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                                                                    <h6 class="tx-black  tx-semibold mg-b-20">پیام حذف شود؟</h6>
                                                                    <p class="pd-x-100"></p>
                                                                    <button type="submit" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">تایید</button>
                                                                    <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">انصراف</button>
                                                                </div><!-- modal-body -->
                                                            </div><!-- modal-content -->
                                                        </div><!-- modal-dialog -->
                                                    </div><!-- modal -->
                                                    {!! Form::close() !!}
                                                @endcan

                                                @if(!is_null($message->file))
                                                    <a href="{{route('dashboard.tickets.file',['ticketId' => $ticket->id, 'fileName' => $message->file])}}">
                                                        <i class="fa fa-download position-right text-muted"></i>
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                    </li>
                                @endif

                            @endforeach
                       </ul>
                    </div>

                    @if(!$ticket->isClosed())
                        @can('ticketsSend',\Mwteam\Ticket\App\Models\Ticket::class)
                            {!! Form::open(['method'=>'PUT', 'url' => route('dashboard.tickets.reply',['ticketId' => $ticket->id]), 'files' => true, 'id' => 'form-ticket-reply']) !!}
                                <div class="form-group row mg-t-20">
                                    <span class="tx-danger">*</span>
                                    {!! Form::label(null, 'متن پیام :', ['class' => 'col-sm-2 form-control-label']) !!}
                                    <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                                        {!! Form::textarea('message',null,['cols' => 30, 'rows' => 6, 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row mg-t-20">
                                    {!! Form::label(null, 'انتخاب فایل :', ['class' => 'col-sm-2 form-control-label']) !!}

                                    <div class="col-lg-12 col-md-10">
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
                                    {!! Form::submit('ارسال پیام', ['class'=>'btn btn-info btn-block mg-b-10']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endcan
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="br-section-wrapper-level">
                    <div class="list-group list-group-flush mg-t-20">
                         <div class="list-group-item">
                             <i class="fa fa-user"></i>
                             {{'نام کاربری: '. $ticket->userWithTrashed->username}}
                         </div>
                        <div class="list-group-item">
                            <i class="fa fa-newspaper-o"></i>
                            {{'سمت: '. (isset(\App\Models\User::roles()[$ticket->userWithTrashed->role]) ? \App\Models\User::roles()[$ticket->userWithTrashed->role] : '')}}
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-mobile"></i>
                            {{'شماره تماس: '. $ticket->userWithTrashed->mobile}}
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-cog"></i>
                            <span>وضعیت تیکت :</span>
                            <br>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    {!! Form::select('status',\Mwteam\Ticket\App\Models\Ticket::statuses(), $ticket->status, ['class' => 'form-control', 'id' => 'status-select']) !!}
                                </div>
                            </div>
                        </div>
                        @can('ticketsDelete',\Mwteam\Ticket\App\Models\Ticket::class)
                            <div class="list-group-item">
                                <div class="row justify-content-center">
                                    <div class="">
                                        <button class="btn btn-danger active btn-block mg-b-10" data-toggle="modal" data-target="#modal-delete-ticket">حذف</button>
                                        {!! Form::open(['method'=>'DELETE', 'url' => route('dashboard.tickets.destroy', ['ticketId' => $ticket->id]), 'files' => false]) !!}
                                            <div id="modal-delete-ticket" class="modal fade">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content tx-size-sm">
                                                        <div class="modal-body tx-center pd-y-20 pd-x-20">
                                                            <a href="" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </a>
                                                            <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                                                            <h6 class="tx-black  tx-semibold mg-b-20">تیکت حذف شود؟</h6>
                                                            <p class="pd-x-100"></p>
                                                            <button type="submit" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">تایید</button>
                                                            <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">انصراف</button>
                                                        </div><!-- modal-body -->
                                                    </div><!-- modal-content -->
                                                </div><!-- modal-dialog -->
                                            </div><!-- modal -->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();

        $('#form-ticket-reply').bootstrapValidator({
            excluded: ':disabled',
            fields: {
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
                            type: "{{\App\Helpers\PackageHelper::getConfig('ticket.validation.file.js.type')}}",
                            maxSize: parseInt("{{\App\Helpers\PackageHelper::getConfig('ticket.validation.file.js.maxSize')}}"),
                            message: "{{\App\Helpers\PackageHelper::getConfig('ticket.validation.file.js.message')}}"
                        }
                    }
                },
            }
        });

        $('#status-select').on('change',function () {
            $.ajax({
                url: "{{route('dashboard.tickets.status', ['ticketId' => $ticket->id])}}",
                method: "post",
                data:{status: $('#status-select').val()},
                success: function (result) {
                    if(result['status'] == true){
                        notify('success','وضعیت تیکت تغییر یافت.');
                    }else{
                        notify();
                    }
                },
                error: function (xmlHttpRequest) {
                    $('#searchresult').html(temp);

                    if(xmlHttpRequest.readyState != 0 || xmlHttpRequest.status != 0){
                        notify();
                    }
                }
            });
        });
    </script>
    <script>
        var height = 0;
        $('.chat-list li').each(function(i, value){
            height += parseInt($(this).height());
        });

        height += '';

        $('.chat-list').animate({scrollTop: height});
    </script>
@endsection
