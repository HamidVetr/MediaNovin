@extends('dashboard::master')

@section('title') ارسال ایمیل @endsection
@section('blog') active @endsection
@section('blog-articles-index') active @endsection

@section('top-assets')

@endsection

@section('content')
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="{{ route('dashboard.home') }}" class="breadcrumb-item">خانه</a>
            <a href="{{ route('dashboard.blog.articles.index') }}" class="breadcrumb-item">ایمیل</a>
            <span class="breadcrumb-item active">جزئیات ایمیل</span>
        </nav>
    </div>
    <div class="br-pagetitle">
        <h4 class="pd-r-10">
            <i class="icon ion-ios-email"></i>
            جزئیات ایمیل
        </h4>
    </div>
    <div class="pd-t-30">
        <div class="br-section-wrapper-level">
            <form>
                <fieldset>
                  <div class="form-group">
                      <div class="col-lg-12">
                          <h6>عنوان ایمیل ارسال شده</h6>
                      </div>
                  </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <p> jsdhfuifsdf dfhsuidf shdfh sdfsd          FTGYDRTYRTMYER ETY WH W EHH AEEJKLEHFJSl .sdfhjhsfjlksndfksdf</p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <span class="tx-12">تاریخ 1397/7/17 ساعت: 10:46:23</span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection

@section('bottom-assets')

@endsection