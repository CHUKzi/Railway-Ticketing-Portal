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
    @include('layouts.app-head-css')
</head>

@section('body')

    <body>
    @show
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('layouts.topbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('layouts.sidebar')
                    <div class="pcoded-content">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.app-vendor-scripts')
</body>

</html>
