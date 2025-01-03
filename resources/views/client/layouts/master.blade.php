<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from pixelgeeklab.com/html/flatize/index-white.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Sep 2024 04:13:38 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Flatize - Shop HTML5 Responsive Template">
    <meta name="author" content="pixelgeeklab.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Obito - @yield('title')</title>

    @include('client.layouts.components.link')

    @yield('css')
</head>

<body data-role="user" data-user-id="{{ auth()->id() }}" >
    <div id="page">
        <header>
            <div id="top" class="header-view">
    
            </div>
                        
            @include('client.layouts.components.navbar')
        </header>

        @include('client.layouts.components.beginlogin')

        <!-- Begin Main -->
        <div role="main" class="main">
            @yield('content')
        </div>
        <!-- End Main -->

        @include('client.layouts.components.footer')
    </div>

    @include('client.layouts.components.quickview')

    @include('client.layouts.components.search')

    @include('client.layouts.components.chatbox')

    @include('client.layouts.components.js')

    @yield('js')
</body>

</html>
