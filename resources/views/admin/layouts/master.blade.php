<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin Obito</title>

    @include('admin.layouts.components.link')

    @yield('css')
</head>

<body class="animsition">

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

            <section class="pt-5">
                <div class="section__content section__content--p30">
                    @yield('content')
                </div>
            </section>

            @include('admin.layouts.components.footer')

        </div>
        <!-- END PAGE CONTAINER-->
    </div>

    @include('admin.layouts.components.js')

    @yield('js')
</body>

</html>
