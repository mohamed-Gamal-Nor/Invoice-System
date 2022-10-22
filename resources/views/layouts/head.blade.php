    <!-- PAGE TITLE HERE -->
    <title>{{ env('APP_NAME')}} \ @yield('title')</title>
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/jqvmap/css/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/skin-2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/wizard/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    @toastr_css
    @yield('css')


