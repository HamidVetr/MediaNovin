@extends('dashboard::master')

@section('title') تعیین سطح دسترسی @endsection
@section('admins') active @endsection

@section('content')
    @if($errors->any())
        @include('dashboard::partials.alert-error',['messages' => $errors->all()])
    @endif

    @if(session()->has('success'))
        @include('dashboard::partials.alert-success',['messages' => [session()->get('success')]])
    @endif

    @include('dashboard::partials.breadcrumb', ['breadcrumbs' => [
        [
         'title' => 'لیست مدیران',
         'url' => route('dashboard.admins.index'),
        ],
        [
         'title' => 'تعیین سطح دسترسی',
         'url' => null,
        ],
    ]])

    @include('dashboard::partials.page-title', ['title' => 'تعیین سطح دسترسی'])

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <p class="br-section-text">تعیین سطح دسترسی
                <code>{{$admin->username}}</code>
            </p>

        <div class="table-responsive">


            {!! Form::model($permissions , ['method'=>'PUT', 'url' => route('dashboard.admins.updatePermissions',['adminId' => $admin->id]), 'files' => false]) !!}
                <ul class="notype">
                    @foreach($permissions['0'] as $permission)
                        <li>
                            {!! Form::checkbox('main-permissions[]', $permission['id'], $permission['value']) !!}
                            {!! Form::label('main-permissions[]', $permission['fa_title']) !!}

                            @if(isset($permissions[$permission['en_title']]))
                                <ul>
                                    @foreach($permissions[$permission['en_title']] as $subPermission)
                                        <li>
                                            {!! Form::checkbox('sub-permissions['.$permission['id'].'][]', $subPermission['id'], $subPermission['value']) !!}
                                            {!! Form::label('sub-permissions['.$permission['id'].'][]', $subPermission['fa_title']) !!}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="form-layout-footer mg-t-30 text-center">
                    {!! Form::submit('ذخیره تغییرات', ['class' => 'btn btn-info']) !!}
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