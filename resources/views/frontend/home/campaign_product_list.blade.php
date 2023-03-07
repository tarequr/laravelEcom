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
			<h2 class="home_title">Campaign Products</h2>
		</div>
	</div>

	<!-- Shop -->
	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="shop_content">
						<div class="product_grid">
							<div class="product_grid_border"></div>

							<!-- Product Item -->
                            @foreach($campaignProducts as $campaignProduct)
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('upload/product/'.$campaignProduct->product->thumbnail) }}" alt="" style="width: 115px; height: 115px;">
                                    </div>
                                    <div class="product_content">
                                        <div class="product_price">{{$setting->currency}}{{$campaignProduct->price}}</div>
                                        <div class="product_name"><div><a href="{{ route('single.product',$campaignProduct->product->slug) }}" tabindex="0">{{ $campaignProduct->product->name }}</a></div></div>
                                    </div>

                                    @auth
                                        @php
                                            $findData = App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $campaignProduct->product->id)->first();
                                        @endphp
                                        <a href="{{ route('add.wishlist',$campaignProduct->product->id) }}">
                                            <div class="product_fav {{ $findData ? 'active' : '' }}"><i class="fas fa-heart"></i></div>
                                        </a>
                                    @else
                                        <a href="{{ route('customer.login') }}">
                                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                                        </a>
                                    @endauth

                                    <ul class="product_marks">
                                        <li class="product_mark product_new quick_view" id="{{ $campaignProduct->product->id }}" data-toggle="modal" data-target="#exampleModalCenter">
                                            <i class="fas fa-eye"></i>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
						</div>

						<!-- Shop Page Navigation -->

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
