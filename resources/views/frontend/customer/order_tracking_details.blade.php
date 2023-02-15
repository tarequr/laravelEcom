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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Customer Details</div>
                        <div class="card-body">
                            Name: {{ $order->c_name }} <br>
                            Phone: {{ $order->c_phone }} <br>
                            Order ID: {{ $order->order_id }} <br>
                            Status: @if ($order->status == 0)
                                        <span class="badge badge-danger">Order Pending</span>
                                    @elseif ($order->status == 1)
                                        <span class="badge badge-info">Order Received</span>
                                    @elseif ($order->status == 2)
                                        <span class="badge badge-primary">Order Shipping</span>
                                    @elseif ($order->status == 3)
                                        <span class="badge badge-success">Order Done</span>
                                    @elseif ($order->status == 4)
                                        <span class="badge badge-warning">Order Return</span>
                                    @elseif ($order->status == 5)
                                        <span class="badge badge-danger">Order Cancle</span>
                                    @endif
                                    <br>
                            Date: {{ date('d-M-Y', strtotime($order->date)) }} <br>
                            Subtotal: {{ $order->subtotal }}{{$setting->currency}} <br>
                            Total: {{ $order->total }}{{$setting->currency}} <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Order Details</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderd table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">SubTotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_details as $order_detail)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $order_detail->product_name }}</td>
                                            <td>{{ $order_detail->color }}</td>
                                            <td>{{ $order_detail->size }}</td>
                                            <td>{{ $order_detail->quantity }}</td>
                                            <td>{{ $order_detail->single_price }}{{$setting->currency}}</td>
                                            <td>{{ $order_detail->subtotal_price }}{{$setting->currency}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
