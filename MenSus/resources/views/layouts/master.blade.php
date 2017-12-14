<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
        @yield('styles')
    </head>
    <body>
    @yield('header')
    <div class="border-bottom"></div>
    <div class="logo-wrapper">
        <div class="leftshadow"><img src="/src/img/logo-wrap-left.jpg"/></div>
        <div class="logo">
            <h1>mensus</h1>
        </div>
        <div class="rightshadow"><img src="/src/img/logo-wrap-right.jpg"/></div>
    </div>
    <div class="container">
        <div class="page-wrapper">
            <div class="pageleft"><img src="/src/img/banner-wrap-left.jpg" /></div>
            <div class="primary-content">
                <div class="panel">
                    @yield('content')
                </div>
            </div>
            <div class="pageright"><img src="/src/img/banner-wrap-right.jpg" /></div>
        </div>
    </div>
    @include('includes.footer')
    </body>
</html>