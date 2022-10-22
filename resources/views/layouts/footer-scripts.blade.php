<!--**********************************Scripts***********************************-->
    <!-- Required vendors -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/global/global.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dlabnav-init.js') }}"></script>
    <!-- Chart ChartJS plugin files -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Chart piety plugin files -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/peity/jquery.peity.min.js') }}"></script>
    <!-- Chart sparkline plugin files -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Demo scripts -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/dashboard-3.js') }}"></script>
    <!-- Svganimation scripts -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/svganimation/vivus.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/svganimation/svg.animation.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins-init/bootstrap.bundle.min.js') }}"></script>
    @toastr_js
    @toastr_render
    @yield('script')
