@extends('dashboard::master')

@section('title') تیکت ها @endsection
@section('tickets') active @endsection
@section('tickets-index') active @endsection

@section('page-title')
    @can('tickets-send',\Mwteam\Ticket\App\Models\Ticket::class)
        <div class="heading-elements pd-l-20">
            <a href="{{route('dashboard.tickets.create')}}" class="btn btn-info btn-with-icon btn-block">
                <div class="ht-40 justify-content-between">
                    <span class="ht-58 justify-content-between pd-r-20 pd-l-20">ارسال تیکت جدید</span>
                    <span class="icon wd-40">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
            </a>
        </div>
    @endcan
@endsection

@section('content')
    @if(session()->has('success'))
        @include('dashboard::partials.alert-success',['messages' => [session()->get('success')]])
    @endif

    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'تیکت ها',
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'لیست تیکت ها'])

    <div class="pd-t-30">
           <div class="br-section-wrapper-level">
               <div class="search-advance search-advance-vendor">
                   <button type="button" class="bg-teal-400 searchbtn searchbtn-store btn-icon btn-rounded"  data-toggle="tooltip" title="جستجو پیشرفته"><img src="{{ asset('/assets/dashboard/images/search.svg') }}" width="18"></button>
                   <div id="searchboxpage" class="searchboxpage-vendor">
                       <br><br>
                        {!! Form::open(['method'=>'get', 'url' => route('dashboard.tickets.index'), 'files' => false]) !!}
                           <div class="row">
                               <div class="col-md-2 col-xs-6">
                                   <div class="text-right">شناسه سفارش</div>
                                   <input type="text" class="form-control">
                               </div>

                               <div class="col-md-2 col-xs-6">
                                   <div class="text-right">کاربر</div>
                                   <input type="text" class="form-control">
                               </div>

                               <div class="col-md-2 col-xs-6">
                                   <div class="text-right">وضعیت</div>
                                   <select class="form-control select-store">
                                       <option>همه</option>
                                       <option>تکمیل شده</option>
                                       <option>تکمیل نشده</option>
                                   </select>
                               </div>

                               <div class="col-md-3 col-xs-6">
                                   <div class="text-right">از تاریخ</div>
                                   <input type="text" class="form-control persianDatePricker text-left" name="from-date"  id="from-date" value>
                               </div>

                               <div class="col-md-3 col-xs-6">
                                   <div class="text-right">تا تاریخ</div>
                                   <input type="text" class="form-control persianDatePricker text-left" name="to-date"  id="to-date" value>
                               </div>
                           </div>
                           <div class="row justify-content-center">
                               <div class="col-sm-5 col-md-2">
                                   <div class="btn-demo">
                                       <button type="submit" class="btn btn-oblong btn-teal active btn-block mg-b-30 mg-t-30"> جستجو</button>
                                   </div>
                               </div>
                           </div>
                       {!! Form::close() !!}
                   </div>

                   <div class="rounded table-responsive">
                        <table class="table mg-b-0 table-tickets">
                            <thead>
                                <tr>
                                    <th>شماره تیکت</th>
                                    <th>عنوان</th>
                                    <th>نام کاربری</th>
                                    <th>سمت</th>
                                    <th>به روز شده</th>
                                    <th>وضعیت</th>
                                    <th>جزئیات</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{$ticket->id}}</td>
                                        <td>{{$ticket->title}}</td>
                                        <td>
                                            <a href="">{{$ticket->userWithTrashed->username}}</a>
                                        </td>
                                        <td>
                                            @switch($ticket->userWithTrashed->role)
                                                @case('admin')
                                                    <span>مدیر</span>
                                                    @break
                                                @case('user')
                                                    <span>کاربر</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            {{\App\Helpers\DatetimeHelper::toWithoutSecondsTime($ticket->updated_at)}}
                                            {{\App\Helpers\DatetimeHelper::toJalaliDate($ticket->updated_at)}}
                                        </td>
                                        <td>
                                            <span class="btn pd-5
                                                @switch($ticket->status)
                                                    @case('in-queue')
                                                        {{'btn-warning'}}
                                                        @break
                                                    @case('in-progress')
                                                        {{'btn-info'}}
                                                        @break
                                                    @case('answered')
                                                        {{'btn-success'}}
                                                        @break
                                                    @case('closed')
                                                        {{'btn-primary'}}
                                                        @break
                                                @endswitch
                                            ">
                                                {{isset(\Mwteam\Ticket\App\Models\Ticket::statuses()[$ticket->status]) ?
                                                \Mwteam\Ticket\App\Models\Ticket::statuses()[$ticket->status] : ''}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{route('dashboard.tickets.show',['ticketId' => $ticket->id])}}">
                                                <img src="{{ asset('/assets/dashboard/images/analytics.png') }}" alt="">
                                            </a>
                                        </td>
                                        <td>

                                            @can('ticketsDelete',\Mwteam\Ticket\App\Models\Ticket::class)
                                                {!! Form::open(['method'=>'DELETE', 'url' => route('dashboard.tickets.destroy', ['ticketId' => $ticket->id]), 'files' => false]) !!}
                                                    <a href="" data-toggle="modal" data-target="#modal-delete-ticket">
                                                            <span class="trash-ticket">
                                                                <i class="fa fa-trash-o" data-toggle="tooltip" title="حذف تیکت"></i>
                                                            </span>
                                                    </a>

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
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   </div>

                   <div class="text-center content-group-lg pt-20">
                       @if($hasFilter == true)
                           {{$tickets->appends($request)->links('dashboard::partials.pagination')}}
                       @else
                           {{$tickets->links('dashboard::partials.pagination')}}
                       @endif
                   </div>
               </div>
           </div>
       </div>
    <div id="modaldemo5" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="icon icon ion-ios-trash tx-50 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h6 class="tx-danger  tx-semibold mg-b-20">آیا مایلید تیکت مورد نظر خود را حذف کنید؟</h6>
                    <p class="pd-x-100"></p>
                    <button type="button" class="btn btn-danger tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                      حذف</button>
                    <button type="button" class="btn btn-secondary tx-12 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                     انصراف</button>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@section('bottom-assets')
    <script src="{{ asset('assets/dashbord/js/persian-datepicker-0.4.5.js') }}"></script>
    <script src="{{ asset('assets/dashbord/js/pwt-date.js') }}"></script>
    <script type="text/javascript">
        $('.searchbtn').click(function(){
            $('#searchboxpage').stop().slideToggle();
        });

        $(".persianDatePricker").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue :{
                enabled: false
            }
        });

        $('#from-date').val('');

        $('#to-date').val('');
    </script>
@endsection
