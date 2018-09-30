@extends('dashboard.master')

@section('title')
    لیست مدیران
@endsection

@section('css')
    <link href="/dashbord/css/toggles-full.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a href="" class="breadcrumb-item">خانه</a>
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
                 <a href="" class="btn btn-info btn-with-icon btn-block">
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
                    <th>نام و نام خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>ایمیل</th>
                    <th>وضعیت</th>
                    <th>سطح دسترسی</th>
                    <th class="text-left">عملیات</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>bb</th>
                    <td>admin</td>
                    <td>admin@email.com</td>
                    <td>
                        <div class="toggle-wrapper">
                            <div class="toggle toggle-light info"></div>
                        </div>
                    </td>
                    <td>
                        <a href=""><img src="/dashbord/images/admin.png" alt="" width="30"></a>
                    </td>

                    <td>
                        <ul class="img-edit">
                            <li>
                                <a href=""><img src="/dashbord/images/edit.png" alt="" width="18"></a>
                            </li>
                            <li>
                                <a class="pd-r-5" href=""><img src="/dashbord/images/meassage.png" alt="" width="18"></a>
                            </li>
                        </ul>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

@endsection

@section('js-footer')
    <script src="/dashbord/js/jquery.js"></script>
    <script src="/dashbord/js/bootstrap.js"></script>
    <script src="/dashbord/js/toggles.min.js"></script>
    <script src="/dashbord/js/jquery.switchButton.js"></script>
    <script>
        $(function(){
            // Toggles
            $('.toggle').toggles({
                on: true,
                height: 26
            });
        });
    </script>
@endsection
