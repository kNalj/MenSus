<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
    @yield('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>