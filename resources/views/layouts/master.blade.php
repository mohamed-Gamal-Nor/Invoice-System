<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Edumin - Bootstrap Admin Dashboard" />
    <meta property="og:title" content="Edumin - Bootstrap Admin Dashboard" />
    <meta property="og:description" content="Edumin - Bootstrap Admin Dashboard" />
    <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}" />
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.head')
</head>
<body>

<!--*******************Preloader start********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************Preloader end********************-->

<!--**********************************Main wrapper start***********************************-->
<div id="main-wrapper">

    <!--**********************************Nav header start***********************************-->
    <div class="nav-header">
        <a href="index.html" class="brand-logo">
            <img class="logo-abbr" src="{{asset('assets/images/logo-white.png')}}" alt="">
            <img class="logo-compact" src="{{asset('assets/images/logo-text-white.png')}}" alt="">
            <img class="brand-title" src="{{asset('assets/images/logo-text-white.png')}}" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--********************************** Nav header end***********************************-->
    <!--**********************************Header start***********************************-->
    @include('layouts.main-headerbar')
    <!--**********************************Header end ti-comment-alt***********************************-->
    <!--**********************************Sidebar start***********************************-->
    @include('layouts.main-sidebar')
    <!--**********************************Sidebar end ***********************************-->
    <!--**********************************Content body start***********************************-->
    @yield('content')

    <!--**********************************Content body end***********************************-->

    <!--**********************************Footer start***********************************-->
    @include('layouts.footer')
    <!--**********************************Footer end***********************************-->
</div>
    <!--**********************************Main wrapper end***********************************-->
    <!--**********************************Scripts***********************************-->
    @include('layouts.footer-scripts')
</body>
</html>
