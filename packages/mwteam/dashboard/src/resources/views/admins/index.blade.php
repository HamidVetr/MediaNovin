@extends('dashboard::master')

@section('title') لیست مدیران @endsection
@section('admins') active @endsection
@section('admins-index') active @endsection

@section('top-assets')
    <link href="{{ asset('assets/dashboard/css/toggles-full.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if(session()->has('success'))
        @include('dashboard::partials.alert-success',['messages' => [session()->get('success')]])
    @endif

    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{route('dashboard.home')}}" class="breadcrumb-item">خانه</a>
            <span class="breadcrumb-item active">مدیران سایت</span>
        </nav>
    </div>

    <div class="br-pagetitle row">

        <div class="col-lg-6">
             <div class="title-add">
                <i class="icon icon ion-android-exit"></i>
                <h4 class="pd-r-10">مدیران سایت</h4>
             </div>
        </div>
        <div class="col-lg-6">
             <div class="heading-elements pd-l-20">
                 <a href="{{route('dashboard.admins.create')}}" class="btn btn-info btn-with-icon btn-block">
                     <div class="ht-40 justify-content-between">
                        <span class="ht-58 justify-content-between pd-r-20 pd-l-20">افزودن مدیر</span>
                         <span class="icon wd-40">
                             <i class="fa  fa-bars"></i>
                         </span>
                     </div>
                 </a>
             </div>
        </div>
    </div>

    <div class="pd-t-30">
        <div class="br-section-wrapper">
            <form method="" id="">
              <div class="row">
                  <div class=" col-lg-4 col-md-6">
                         <div id="datatable1_filter" class="dataTables_filter">
                             <label for="">
                              <input type="search" name="search"  placeholder="جستجو ">
                             </label>
                             <button type="submit" class="btn btn-info">جستجو</button>
                          </div>
                     </div>
                  </div>

            </form>
            <div class="rounded table-responsive">
                <table class="table mg-b-0 table-mananger">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>نام کاربری</th>
                        <th>ایمیل</th>
                        <th>سطح دسترسی</th>
                        <th class="text-left">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <th>{{$admin->id}}</th>
                                <th>{{$admin->first_name .' '. $admin->last_name}}</th>
                                <td>{{$admin->username}}</td>
                                <td>{{$admin->email}}</td>
                                <td>
                                    <a href="{{route('dashboard.admins.showPermissions', ['adminId' => $admin->id])}}">
                                        <img src="{{asset('assets/dashboard/images/admin.png')}}" alt="" width="30">
                                    </a>
                                </td>
                                <td>
                                    <ul class="img-edit">
                                        <li class="pd-l-10">
                                            <form id="form-status" method="post" action="{{is_null($admin->deleted_at) ?
                                                route('dashboard.admins.deactive' , ['adminId' => $admin->id]):
                                                route('dashboard.admins.active' , ['adminId' => $admin->id])}}">

                                                {{csrf_field()}}
                                            </form>
                                            @if(is_null($admin->deleted_at))
                                                <a href="javascript:{}" onclick="document.getElementById('form-status').submit();">
                                                    <span class="font-ban">
                                                        <i class="fa fa-minus-circle" data-toggle="tooltip" title="غیر فعال کردن"></i>
                                                    </span>
                                                </a>
                                            @else
                                            @endif
                                        </li>
                                        <li>
                                            <a href="{{route('dashboard.admins.edit' , ['adminId' => $admin->id])}}">
                                                <span class="font-edit">
                                                    <i class="fa  fa-pencil-square" data-toggle="tooltip" title="ویرایش اطلاعات"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center content-group-lg pt-20">
                @if($hasFilter == true)
                    {{$admins->appends($request)->links('dashboard::partials.pagination')}}
                @else
                    {{$admins->links('dashboard::partials.pagination')}}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('assets/dashboard/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endsection