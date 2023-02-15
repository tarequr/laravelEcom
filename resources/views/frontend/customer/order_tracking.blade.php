<!-- Single Product -->
@extends('frontend.master')

@push('css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">
@endpush

@section('content')
    <!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/shop_background.jpg') }}"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Order Tracking</h2>
		</div>
	</div>

	<!-- Shop -->
	<div class="shop">
		<div class="container">
            <!-- Brands -->
            <div class="row mb-5 justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4">
                        <form action="{{ route('check.order') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Order ID</label>
                                <input type="text" name="order_id" class="form-control" placeholder="Enter your order ID" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary">Track Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@push('js')
<script src="{{ asset('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/shop_custom.js') }}"></script>
@endpush
