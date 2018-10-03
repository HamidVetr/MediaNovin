<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('meta')
    <title>{{env('APP_NAME')}} | @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/bracket.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/them.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/ionicons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/bootstrap.rtl.css') }}">

    @yield('top-assets')
</head>
<body>
    <div class="br-logo"><a href="#"><span>[</span> مدیا <i> نوین </i> <span>]</span></a></div>

    @include('dashboard::partials.sidebar')
    @include('dashboard::partials.header')

    <div class="br-mainpanel">
        <div class="br-pagebody">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bracket.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrapValidator.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/uniform.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>

    @yield('bottom-assets')
</body>
</html>