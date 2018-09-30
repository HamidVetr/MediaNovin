@extends('dashboard.master')

@section('title')
    مجوزهای مدیر
@endsection

@section('content')
    <div class="br-mainpanel">
        <div class="br-pageheader">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a href="" class="breadcrumb-item">خانه</a>
                <a href="" class="breadcrumb-item">مدیران سایت</a>
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
                <form action="" method="" id="">
                    <ul class="notype">
                        <br>
                        <li>
                            <input  type="checkbox" id="op1" name="sections" value="1">
                            <label for="op1">بخش ها</label>
                            <ul>
                                <li>
                                    <input type="checkbox" id="op11" name="categories" value="1">
                                    <label for="op11">دسته بندی ها</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="op12" name="products" value="1">
                                    <label for="op12">کالاها</label>
                                    <ul>
                                        <li>
                                            <input type="checkbox" id="op123" name="categories" value="1">
                                            <label for="op11">محصولات</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="op132" name="products" value="1">
                                            <label for="op12">پوشاک</label>

                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </form>
            </div>
         </div>
        </div>
    </div>
@endsection

@section('js-footer')
    <script type="text/javascript" src="/dashbord/js/uniform.js"></script>
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