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

	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>

	<!-- Bootstrap -->
	<link href="{{ asset('assets/client/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Icon Fonts -->
	<link href="{{ asset('assets/client/css/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

	<!-- Owl Carousel Assets -->
	<link href="{{ asset('assets/client/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/client/vendor/owl-carousel/owl.theme.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/client/vendor/owl-carousel/owl.transitions.css') }}" rel="stylesheet">
	
	<!-- bxslider -->
	<link href="{{ asset('assets/client/vendor/bxslider/jquery.bxslider.css') }}" rel="stylesheet">
	<!-- flexslider -->
	<link rel="stylesheet" href="{{ asset('assets/client/vendor/flexslider/flexslider.css') }}" media="screen">

	<!-- Theme -->
	<link href="{{ asset('assets/client/css/theme-animate.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/client/css/theme-elements.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/client/css/theme-blog.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/client/css/theme-shop.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/client/css/theme.css') }}" rel="stylesheet">

	<!-- Style Switcher-->
	<link rel="stylesheet" href="{{ asset('assets/client/style-switcher/css/style-switcher.css') }}">
	<link href="{{ asset('assets/client/css/colors/cyan/style.html') }}" rel="stylesheet" id="layoutstyle">

	<!-- Theme Responsive-->
	<link href="{{ asset('assets/client/css/theme-responsive.css') }}" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div id="page">
		<header>
			@include('client.layouts.components.header')
			@include('client.layouts.components.navbar')
		</header>
		
		<!-- Begin Main -->
		@yield('content')
		<!-- End Main -->
		
		@include('client.layouts.components.footer')
	</div>

    @include('client.layouts.components.quickview')

	@include('client.layouts.components.search')
	
	@include('client.layouts.components.styleswitcher')
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{ asset('assets/client/vendor/jquery.min.js') }}"></script> 
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="{{ asset('assets/client/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/client/bootstrap/js/bootstrap-hover-dropdown.min.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/owl-carousel/owl.carousel.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/modernizr.custom.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/jquery.stellar.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/masonry.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/jquery.pricefilter.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/bxslider/jquery.bxslider.min.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/mediaelement-and-player.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/client/vendor/flexslider/jquery.flexslider-min.js') }}"></script>
	
	<!-- Theme Initializer -->
	<script src="{{ asset('assets/client/js/theme.plugins.js') }}"></script>
	<script src="{{ asset('assets/client/js/theme.js') }}"></script>
	
	<!-- Style Switcher -->
	<script type="text/javascript" src="{{ asset('assets/client/style-switcher/js/switcher.js') }}"></script>
	
</body>
</html>