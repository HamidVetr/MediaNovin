@extends('dashboard::master')

@section('title') ارسال ایمیل @endsection
@section('blog') active @endsection
@section('blog-articles-index') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.articles.index') }}" class="breadcrumb-item">ایمیل</a>
            <span class="breadcrumb-item active">ارسال ایمیل به کاربران</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-email"></i>
            ارسال ایمیل
        </h4>
    </div>
    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <form action="" id="send">
                 <div class="row">
                     <div class="col-xl-12">
                         <div class="form-group row mg-t-20">
                             <span class="tx-danger">*</span>
                             <label for="" class="col-sm-2 form-control-label">نام کاربر:</label>
                             <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                 <select name="select" class="'form-control select2" id="e9" data-placeholder="انتخاب کنید...">
                                     <option value=""></option>
                                     <option value="1">همه کاربران</option>
                                     <option value="2">حسنی</option>
                                     <option value="3">erter</option>
                                 </select>
                             </div>
                         </div>
                         <div class="form-group row mg-t-20">
                             <span class="tx-danger">*</span>
                             <label for="" class="col-sm-2 form-control-label">متن پیام:</label>
                             <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                 <textarea name="text" id=""  rows="6" class="form-control"></textarea>
                             </div>
                         </div>
                         <div class="row justify-content-center">
                             <div class="btn-demo">
                                 <button class="btn btn-info btn-block mg-b-10">ارسال ایمیل</button>
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
        $('#send').bootstrapValidator({
            fields: {
               select: {
                    validators: {
                        notEmpty: {
                            message: 'نام کاربر را انتخاب کنید'
                        }
                    }
                },
                text: {
                    validators: {
                        notEmpty: {
                            message: ' متن پیام را وارد کنید'
                        }
                    }
                }
            }
        });
    </script>
@endsection