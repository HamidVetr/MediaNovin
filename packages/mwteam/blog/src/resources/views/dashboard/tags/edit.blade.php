@extends('dashboard::master')

@section('title') ویرایش تگ @endsection
@section('blog') active @endsection
@section('blog-tags-create') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.articles.index') }}" class="breadcrumb-item">برچسب ها</a>
            <span class="breadcrumb-item active">ویرایش برچسب</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <i class="icon icon ion-android-exit"></i>
        <h4 class="pd-r-10">ویرایش برچسب</h4>
    </div>
    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <form  id="tiketsend">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                نام برچسب (فارسی) :
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control"  name="first_name">
                            </div>
                        </div>
                        <div class="form-group row mg-t-20">
                            <label for="" class="col-sm-2 form-control-label">
                                نام برچسب (انگلیسی):
                                <span class="tx-danger">*</span>
                            </label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control"  name="first_name">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn-demo">
                                <button class="btn btn-info btn-block mg-b-10">ویرایش برچسب </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $('#e9').select2();

        $(".js-example-placeholder-single").select2({
            placeholder: "انتخاب کنید...",
            allowClear: true
        });
    </script>
@endsection
