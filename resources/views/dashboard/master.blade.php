<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('meta')
    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="/dashbord/css/bracket.css">
    <link rel="stylesheet" type="text/css" href="/dashbord/css/them.css">
    <link rel="stylesheet" type="text/css" href="/dashbord/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/dashbord/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="/dashbord/css/bootstrap.rtl.css">

    @yield('css')
    @yield('js-header')
</head>
<body>
    <div class="br-logo"><a href="#"><span>[</span> مدیا <i> نوین </i> <span>]</span></a></div>

    @include('dashboard.partials.sidebar')
    @include('dashboard.partials.header')

    <div class="br-mainpanel">
        <div class="br-pagebody">
            @yield('content')
        </div>
    </div>

    <script src="/dashbord/js/jquery.js"></script>
    <script src="/dashbord/js/popper.js"></script>
    <script src="/dashbord/js/bootstrap.js"></script>
    <script src="/dashbord/js/bracket.js"></script>

    @yield('js-footer')
</body>
</html>