@extends('dashboard::master')

@section('title') مجوزهای مدیر @endsection
@section('admins') active @endsection

@section('content')
    @if(session()->has('success'))
        @include('dashboard::partials.alert-success',['messages' => [session()->get('success')]])
    @endif

    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{route('dashboard.home')}}" class="breadcrumb-item">خانه</a>
            <a href="{{route('dashboard.admins.index')}}" class="breadcrumb-item">مدیران سایت</a>
            <span class="breadcrumb-item active">تعیین سطح دسترسی</span>
        </nav>
    </div>

    <div class="br-pagetitle">
        <i class="icon icon ion-android-exit"></i>
        <h4 class="pd-r-10">تعیین سطح دسترسی</h4>
    </div>

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <p class="br-section-text">تعیین سطح دسترسی
                <code>d d</code>
            </p>

        <div class="table-responsive">


            {!! Form::model($permissions , ['method'=>'PUT', 'route' => ['dashboard.admins.updatePermissions', 'adminId' => 3], 'files' => false]) !!}
                @foreach($permissions['0'] as $permission)
                    <div class="row mg-t-20">
                        <h3>
                            {!! Form::label($permission['en_title'], $permission['fa_title'], ['class' => 'col-sm-2 form-control-label']) !!}
                        </h3>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            {!! Form::checkbox($permission['en_title'], 1, $permission['value'], ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    @if(isset($permissions[$permission['id']]))
                        @foreach($permissions[$permission['id']] as $subPermission)
                            <div class="row mg-t-20">
                                {!! Form::label($subPermission['en_title'], $subPermission['fa_title'], ['class' => 'col-sm-2 form-control-label']) !!}

                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    {!! Form::checkbox($subPermission['en_title'], 1, $subPermission['value'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach

                <div class="form-layout-footer mg-t-30 text-center">
                    {!! Form::submit('ایجاد مدیر', ['class' => 'btn btn-info']) !!}
                </div>
            {!! Form::close() !!}
        </div>
     </div>
    </div>
@endsection

@section('bottom-assets')
    <script>
        $('li :checkbox').on('click', function () {
            var $chk = $(this),
                $li = $chk.closest('li'),
                $ul, $parent;
            if ($li.has('ul')) {
                $li.find(':checkbox').not(this).prop('checked', this.checked)
            }
            do {
                $ul = $li.parent();
                $parent = $ul.siblings(':checkbox');
                if ($chk.is(':checked')) {
                    $parent.prop('checked', $ul.has(':checkbox:checked').length != 0)
                } else {

                    $parent.prop('checked', $ul.has(':checkbox:checked').length >= 1)
                }
                $chk = $parent;
                $li = $chk.closest('li');
            } while ($ul.is(':not(.someclass)'));
        });
    </script>
@endsection