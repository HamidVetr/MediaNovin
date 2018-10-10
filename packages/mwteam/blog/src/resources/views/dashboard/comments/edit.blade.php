@extends('dashboard::master')

@section('title') مشاهده نظر {{ $comment->name }} @endsection
@section('blog') active @endsection
@section('blog-comments-index') active @endsection

@section('top-assets')

@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.comments.index') }}" class="breadcrumb-item">نظرات</a>
            <span class="breadcrumb-item active">مشاهده نظر {{ $comment->name }}</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <i class="icon icon ion-chatbubbles"></i>
        <h4 class="pd-r-10">مشاهده نظر {{ $comment->name }}</h4>
    </div>

    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            @include('dashboard::partials.alert-error')
            @include('dashboard::partials.alert-session')
            <div class="search-advance search-advance-vendor">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::model($comment , ['method' => 'PUT', 'route' => ['dashboard.blog.comments.update', $comment->id]]) !!}
                            {!! Form::label('name', 'نام نظر دهنده', ['class' => '']) !!}
                            {!! Form::text('name', $comment->name, ['class' => 'form-control']) !!}
                            {!! Form::label('email', 'ایمیل', ['class' => '']) !!}
                            {!! Form::text('email', $comment->email, ['class' => 'form-control']) !!}
                            {!! Form::label('mobile', 'موبایل', ['class' => '']) !!}
                            {!! Form::text('mobile', $comment->mobile, ['class' => 'form-control']) !!}
                            {!! Form::label('body', 'متن نظر', ['class' => '']) !!}
                            {!! Form::textarea('body', $comment->body, ['class' => 'form-control']) !!}
                            <button type="submit" name="submit" class="btn btn-warning" value="edit">ویرایش نظر</button>
                            <button type="submit" name="submit" class="btn btn-warning" value="edit-approve">ویرایش و تایید نظر</button>
                            <button type="submit" name="submit" class="btn btn-warning" value="approve">تایید نظر</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['method'=>'POST', 'route' => ['dashboard.blog.comments.reply', $comment->id]]) !!}
                            {!! Form::label('admin-name', 'نام پاسخ دهنده', ['class' => '']) !!}
                            {!! Form::text('admin-name', $adminReply == '' ? auth()->user()->full_name : $adminReply->name, ['class' => 'form-control']) !!}
                            {!! Form::label('admin-email', 'ایمیل', ['class' => '']) !!}
                            {!! Form::text('admin-email', $adminReply == '' ? auth()->user()->email : $adminReply->email, ['class' => 'form-control']) !!}
                            {!! Form::label('admin-mobile', 'موبایل', ['class' => '']) !!}
                            {!! Form::text('admin-mobile', $adminReply == '' ? auth()->user()->mobile : $adminReply->mobile, ['class' => 'form-control']) !!}
                            {!! Form::label('admin-body', 'متن نظر', ['class' => '']) !!}
                            {!! Form::textarea('admin-body', $adminReply == '' ? null : $adminReply->body, ['class' => 'form-control']) !!}
                            <button type="submit" name="admin-submit" class="btn btn-success" value="reply">پاسخ به نظر</button>
                            <button type="submit" name="admin-submit" class="btn btn-success" value="reply-approve">پاسخ و تایید نظر</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom-assets')

@endsection