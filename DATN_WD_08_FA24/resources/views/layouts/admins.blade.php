<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="au theme template" />
    <meta name="author" content="" />
    <meta name="keywords" content="au theme template" />

    <!-- Title Page-->
    <title>@yield('title')</title>
    {{-- CSS --}}
    {{-- @include('admins.blocks.css') --}}

    <!-- Fontfaces CSS-->
    <link href="{{ asset('assets/admins/css/font-face.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('assets/admins/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all" />
    <link href="{{ asset('assets/admins/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all" />
    <link href="{{ asset('assets/admins/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all" />

    <!-- Bootstrap CSS-->
    <link href="{{ asset('assets/admins/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all" />

    <!-- Vendor CSS-->
    <link href="{{ asset('assets/admins/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('assets/admins/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet" media="all" />
    <link href="{{ asset('assets/admins/vendor/wow/animate.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('assets/admins/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet"
        media="all" />
    <link href="{{ asset('assets/admins/vendor/slick/slick.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('assets/admins/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('assets/admins/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"
        media="all" />

    <!-- Main CSS-->
    <link href="{{ asset('assets/admins/css/theme.css') }}" rel="stylesheet" media="all" />
    @yield('css')
</head>

<body class="animsition">
    <div class="page-wrapper">
        {{-- HEADER --}}
        @include('admins.blocks.header')
        {{-- CONTENT --}}
        @yield('content')
    </div>
    {{-- Script --}}
    <!-- Jquery JS-->
    <script src="{{ asset('assets/admins/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('assets/admins/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('assets/admins/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admins/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('assets/admins/js/main.js') }}"></script>
    {{-- Icon JS --}}
    <script src="https://kit.fontawesome.com/2e8884d211.js" crossorigin="anonymous"></script>
    @yield('js')
    {{-- FOOTER --}}
    @include('admins.blocks.footer')
</body>

</html>
<!-- end document-->
