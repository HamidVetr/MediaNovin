@extends('dashboard::master')

@section('title') جزئیات تیکت @endsection
@section('tickets') active @endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="" class="breadcrumb-item">خانه</a>
            <a href="" class="breadcrumb-item">تیکت ها</a>
            <span class="breadcrumb-item active">نمایش تیکت</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <i class="icon icon ion-android-exit"></i>
        <h4 class="pd-r-10">نمایش تیکت</h4>
    </div>
    <div class="pd-t-30">
        <div class="row">
            <div class="col-md-9">
                <div class="br-section-wrapper-level">

                   <div class="panel-heading">
                       <h6 class="panel-title">41 - تبریک، برنده مزایده شده اید</h6>
                   </div>
                    <div class="panel-body">
                       <ul class="media-list chat-list content-group">
                          <li class="media">
                              <div class="media-left">
                                  <img src="assets/dashboard/images/analytics.png" alt="" class="img-circle img-md">
                              </div>
                              <div class="media-body">
                                   <div class="media-content">
                                       شما برنده مزایده شده اید. از بخش ناحیه کاربری، خریدهای من، مزایدات، می توانید نسبت به پرداخت اقدام نمایید. شما برنده مزایده شده اید. از بخش ناحیه کاربری، خریدهای من، مزایدات، می توانید نسبت به پرداخت اقدام نمایید.
                                   </div>
                                   <span class="media-annotation display-block mt-10">
                                       <i class="fa fa-calendar position-right text-muted"></i>
                                        1397/6/25 14:09
                                   </span>
                              </div>
                          </li>
                       </ul>
                    </div>


                    <div class="form-group row mg-t-20">
                        <label for="" class="col-sm-2 form-control-label">
                            متن پیام:
                            <span class="tx-danger">*</span>
                        </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                            <textarea name="" id="" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mg-t-20">
                        <div class="col-lg-12 col-md-12">
                            <form class="md-form" action="#">
                                <div class="file-field">
                                    <div class="btn btn-primary btn-md float-left">

                                            <span>
                                                <i class="fa fa-cloud-upload"></i>
                                            </span>
                                        <span class="pd-r-5">انتخاب فایل</span>
                                        <input type="file" multiple>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="یک یا چند فایل را آپلود کنید">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="br-section-wrapper-level">
                    <div class="list-group list-group-flush mg-t-20">
                         <div class="list-group-item">
                             <i class="fa fa-user"></i>
                             نام کاربری
                             : user
                         </div>
                        <div class="list-group-item">
                            <i class="fa fa-newspaper-o"></i>
                            سمت:
                            کاربر عادی
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-mobile"></i>
                            شماره تماس : 09123456781
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-cog"></i>
                            وضعیت تیکت :
                            <br>
                            <br>
                            <div class="form-group row">
                                <select data-placeholder="انتخاب کنید..." class="form-control js-example-placeholder-single" name="status"  id="e9">
                                    <option value=""></option>
                                    <option value="1">پاسخ داده شده</option>
                                    <option value="2">بسته شده</option>
                                    <option value="3">در انتظار پاسخ  </option>
                                    <option value="4">در حال بررسی</option>
                                </select>
                             </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row justify-content-center">
                                <div class="">
                                       <button class="btn btn-danger active btn-block mg-b-10" data-toggle="modal"data-target="#modaldemo5">حذف</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <h6 class="tx-danger  tx-semibold mg-b-20">آیا مایل به حذف هستید؟</h6>
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
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#e9').select2();

        $(".js-example-placeholder-single").select2({
            placeholder: "انتخاب کنید...",
            allowClear: true
        });
    </script>
@endsection
