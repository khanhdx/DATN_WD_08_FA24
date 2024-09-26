<!DOCTYPE html>
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
</script>
</html>
