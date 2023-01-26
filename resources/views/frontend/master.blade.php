<!DOCTYPE html>
<html lang="en">
<head>
<title>OneTech</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/slick-1.8.0/slick.css') }}">
@stack('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/responsive.css') }}">
<link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

</head>

<body>

<div class="super_container">
	<!-- Header -->
	<header class="header">
		<!-- Top Bar -->
        @include('frontend.partials.topbar')
		<!-- Header Main -->
        @include('frontend.partials.header')
		<!-- Main Navigation -->
        @include('frontend.partials.home_nav')
		<!-- Menu -->
        @include('frontend.partials.menu')
	</header>

	@yield('content')

	<!-- Footer -->
	@include('frontend.partials.footer')
	<!-- Copyright -->
    @include('frontend.partials.copyright')

</div>

<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('js/iziToast.js') }}"></script>

@include('vendor.lara-izitoast.toast')

<script>
    function cart(){
        $.ajax({
            type : 'get',
            url: "{{ route('all.cart') }}",
            // url: "{{ url('all-cart') }}",
            success: function(data) {
                console.log(data);
                $('.cart_qty').empty();
                $('.cat_total').empty();

                $('.cart_qty').append(data.cat_qty);
                $('.cat_total').append(data.cat_total);
            }
        })
    }

    $(document).ready(function() {
        cart();
    });
</script>

@stack('js')

</body>

</html>
