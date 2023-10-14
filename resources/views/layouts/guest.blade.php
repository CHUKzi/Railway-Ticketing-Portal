<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Railway Ticketing Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Railway Ticketing Portal" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/assets/images/favicon.ico') }}">
    @include('layouts.head-css')
</head>

@section('body')

    <body themebg-pattern="theme1">
    @show

    @yield('content')

    @include('layouts.vendor-scripts')
</body>

</html>
