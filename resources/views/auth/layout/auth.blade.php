{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
</head>

<body class="animsition">
    <div class="">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
</body>
<script>
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        window.location.reload();
    }
</script> --}}


</html>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from pixelgeeklab.com/html/flatize/index-white.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Sep 2024 04:13:38 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Flatize - Shop HTML5 Responsive Template">
    <meta name="author" content="pixelgeeklab.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flatize - Shop HTML5 Responsive Template</title>
    @include('client.layouts.components.link')
    @yield('css')

</head>

<body>
    <div id="page">
        <header>
            <div id="top" class="header-view">
    
            </div>
                        
            @include('client.layouts.components.navbar')
        </header>

        <!-- Begin Main -->
        <div role="main" class="main">
            @yield('content')
        </div>
        <!-- End Main -->

        @include('client.layouts.components.footer')
    </div>

    



    @include('client.layouts.components.js')

    @yield('js')
</body>
<script>
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        window.location.reload();
    }
</script>
</html>




