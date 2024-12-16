<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="">
    <meta name="keywords" content="au theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title Page-->
    <title>Admin Obito</title>

    @include('admin.layouts.components.link')

    @yield('css')
    <style>
    .custom-toast {
        position: fixed;
        top: 80px;
        right: 20px;
        background-color: #4caf50;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        font-size: 16px;
        opacity: 1;
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .custom-toast.hide {
        opacity: 0;
        transform: translateY(20px);
    }
    </style>
</head>

<body class="animsition" data-role="admin" data-user-id="{{ auth()->id() }}">

    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        @include('admin.layouts.components.sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">

            <!-- HEADER DESKTOP-->
            @include('admin.layouts.components.header')

            @include('admin.layouts.components.sidebar-right')
            <!-- END HEADER DESKTOP-->

            @include('admin.layouts.components.breadcrumb')

            <section class="pt-4" style="padding-bottom: 2.5rem;">
                <div class="section__content section__content--p30">
                    @yield('content')
                </div>
            </section>

            {{-- @include('admin.layouts.components.footer') --}}

        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toast = document.getElementById('customToast');
            if (toast) {
                setTimeout(function() {
                    toast.classList.add('hide');
                }, 3000);

                setTimeout(function() {
                    toast.remove();
                }, 3500);
            }
        });
    </script>
    @include('admin.layouts.components.js')
    @yield('js')
</body>

</html>
