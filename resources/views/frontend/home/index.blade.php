@extends('frontend.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/main_styles.css') }}">
    <style>
        .checked{
            color: gold;
        }
    </style>
@endpush

@section('content')
    <!-- Banner -->
	<div class="banner">
		<div class="banner_background" style="background-image:url({{ asset('frontend/images/banner_background.jpg') }})"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="{{ asset('upload/product/'.$banner_product->thumbnail) }}" alt=""></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text">{{ $banner_product->name }}</h1>
                        @if ($banner_product->discount_price == null)
						<div class="banner_price">{{$setting->currency}}{{$banner_product->selling_price}}</div>
                        @else
                        <div class="banner_price"><span>{{$setting->currency}}{{$banner_product->selling_price}}</span>{{$setting->currency}}{{$banner_product->discount_price}}</div>
                        @endif
						<div class="banner_product_name">{{$banner_product->brand->brnad_name}}</div>
						<div class="button banner_button"><a href="{{ route('single.product',$banner_product->slug) }}">Shop Now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

    @php
        $today = date('Y-m-d');
        $campaign_end = date('Y-m-d', strtotime($campaign->end_date));
        $campaign_start = date('Y-m-d', strtotime($campaign->start_date));
    @endphp

    @isset($campaign)
        @if ($today >= $campaign_start && $today <= $campaign_end)
            <div class="characteristics">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <h5 class="text-center">{{ $campaign->title }}</h5>
                            <a href="{{ route('frontend.campaign.product',$campaign->id) }}">
                                <img src="{{ asset('upload/campaign/'.$campaign->image) }}" alt="" style="width: 100%; height: 80px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endisset

	<!-- Characteristics -->

	<div class="characteristics">
		<div class="container">
			<div class="row">
                @foreach ($brands as $brand)
                    <div class="col-lg-1 col-md-6 char_col" style="border: 1px solid grey; padding: 5px;">
                        <div class="brands_item">
                            <a href="{{ route('brand.wise.product',$brand->id) }}">
                                <img src="{{ $brand->brand_logo }}" alt="{{ $brand->brnad_name }}" title="{{ $brand->brnad_name }}" height="100%" width="100%">
                            </a>
                        </div>
                    </div>
                @endforeach

				<!-- Char. Item -->
				{{-- <div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('frontend/images/char_1.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('frontend/images/char_2.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('frontend/images/char_3.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('frontend/images/char_4.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div> --}}
			</div>
		</div>
	</div>

	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

					<!-- Deals -->

					<div class="deals">
						<div class="deals_title">Deals of the Week</div>
						<div class="deals_slider_container">

							<!-- Deals Slider -->
							<div class="owl-carousel owl-theme deals_slider">

                                @foreach ($toady_deals as $toady_deal)
								<!-- Deals Item -->
								<div class="owl-item deals_item">
									<div class="deals_image"><img src="{{ asset('upload/product/'.$toady_deal->thumbnail) }}" alt=""></div>
									<div class="deals_content">
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_category"><a href="#">{{ $toady_deal->subCategories->subcategory_name }}</a></div>
                                            @if ($toady_deal->discount_price == NULL)
                                                <div class="deals_item_price_a ml-auto text-danger">{{$setting->currency}}{{$toady_deal->selling_price}}</div>
                                            @else
                                                <div class="deals_item_price_a ml-auto text-danger">{{$setting->currency}}{{$toady_deal->discount_price}}</div>
                                            @endif
										</div>
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_name"><a href="">{{ substr($toady_deal->name,'0','20') }}</a></div>
										</div>
										<div class="available">
											<div class="available_line d-flex flex-row justify-content-start">
												<div class="available_title">Available: <span>{{ $toady_deal->stock_quantity }}</span></div>
												<div class="sold_title ml-auto">Already sold: <span>28</span></div>
											</div>
											<div class="available_bar"><span style="width:17%"></span></div>
										</div>
										<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
											<div class="deals_timer_title_container">
												<div class="deals_timer_title">Hurry Up</div>
												<div class="deals_timer_subtitle">Offer ends in:</div>
											</div>
											<div class="deals_timer_content ml-auto">
												<div class="deals_timer_box clearfix" data-target-time="">
													<div class="deals_timer_unit">
														<div id="deals_timer1_hr" class="deals_timer_hr"></div>
														<span>hours</span>
													</div>
													<div class="deals_timer_unit">
														<div id="deals_timer1_min" class="deals_timer_min"></div>
														<span>mins</span>
													</div>
													<div class="deals_timer_unit">
														<div id="deals_timer1_sec" class="deals_timer_sec"></div>
														<span>secs</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                                @endforeach

							</div>

						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>

					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Featured</li>
									<li>Most Popular</li>
									<li>Best Rated</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Featured Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">

									<!-- Slider Item -->
                                    @if (!empty($featureds))
                                        @foreach ($featureds as $featured)
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    <img src="{{ asset('upload/product/'.$featured->thumbnail) }}" alt="" style="width: 115px; height: 115px;">
                                                </div>
                                                <div class="product_content">
                                                    @if ($featured->discount_price == NULL)
                                                        <div class="product_price discount">{{$setting->currency}}{{$featured->selling_price}}</div>
                                                    @else
                                                        <div class="product_price discount">{{$setting->currency}}{{$featured->discount_price}}<span>{{$setting->currency}}{{$featured->selling_price}}</span></div>
                                                    @endif

                                                    <div class="product_name"><div><a href="{{ route('single.product',$featured->slug) }}">{{ substr($featured->name,'0','20') }}</a></div></div>
                                                    <div class="product_extras">
                                                        <div class="mt-1">
                                                            <span class="badge badge-success p-1 quick_view" id="{{ $featured->id }}" data-toggle="modal" data-target="#exampleModalCenter">Quick View</span>
                                                        </div>



                                                        {{-- <div class="product_color">
                                                            <input type="radio" checked name="product_color" style="background:#b19c83">
                                                            <input type="radio" name="product_color" style="background:#000000">
                                                            <input type="radio" name="product_color" style="background:#999999">
                                                        </div> --}}
                                                        <button class="product_cart_button quick_view" id="{{ $featured->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                    </div>
                                                </div>

                                                @auth
                                                    @php
                                                        $findData = App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $featured->id)->first();
                                                    @endphp
                                                    <a href="{{ route('add.wishlist',$featured->id) }}">
                                                        <div class="product_fav {{ $findData ? 'active' : '' }}"><i class="fas fa-heart"></i></div>
                                                    </a>
                                                @else
                                                    <a href="{{ route('customer.login') }}">
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    </a>
                                                @endauth

                                                <ul class="product_marks">
                                                    <li class="product_mark product_discount" style="background-color: blueviolet !important">new</li>
                                                    <li class="product_mark product_new">new</li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

									<!-- Slider Item -->
                                    @if (!empty($popular_products))
                                    @foreach ($popular_products as $popularProduct)
									<div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('upload/product/'.$popularProduct->thumbnail) }}" alt="" style="width: 115px; height: 115px;">
                                            </div>
                                            <div class="product_content">
                                                @if ($popularProduct->discount_price == NULL)
                                                    <div class="product_price discount">{{$setting->currency}}{{$popularProduct->selling_price}}</div>
                                                @else
                                                    <div class="product_price discount">{{$setting->currency}}{{$popularProduct->discount_price}}<span>{{$setting->currency}}{{$popularProduct->selling_price}}</span></div>
                                                @endif
                                                <div class="product_name"><div><a href="{{ route('single.product',$popularProduct->slug) }}">{{ substr($popularProduct->name,'0','20') }}</a></div></div>
                                                <div class="product_extras">
                                                    <div class="mt-1">
                                                        <span class="badge badge-success p-1 quick_view" id="{{ $popularProduct->id }}" data-toggle="modal" data-target="#exampleModalCenter">Quick View</span>
                                                    </div>
                                                    {{-- <div class="product_color">
                                                        <input type="radio" checked name="product_color" style="background:#b19c83">
                                                        <input type="radio" name="product_color" style="background:#000000">
                                                        <input type="radio" name="product_color" style="background:#999999">
                                                    </div> --}}
                                                    <button class="product_cart_button quick_view" id="{{ $popularProduct->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                </div>
                                            </div>

                                            @auth
                                                @php
                                                    $findData = App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $popularProduct->id)->first();
                                                @endphp
                                                <a href="{{ route('add.wishlist',$popularProduct->id) }}">
                                                    <div class="product_fav {{ $findData ? 'active' : '' }}"><i class="fas fa-heart"></i></div>
                                                </a>
                                            @else
                                                <a href="{{ route('customer.login') }}">
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </a>
                                            @endauth

                                            <ul class="product_marks">
                                                <li class="product_mark product_discount" style="background-color: blueviolet !important">new</li>
                                                <li class="product_mark product_new">new</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_1.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price discount">$225<span>$300</span></div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount">-25%</li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_2.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Apple iPod shuffle</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button active">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_3.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Sony MDRZX310W</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_4.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price discount">$225<span>$300</span></div>
												<div class="product_name"><div><a href="product.html">LUNA Smartphone</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount">-25%</li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_5.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$225</div>
												<div class="product_name"><div><a href="product.html">Canon STM Kit...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_6.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Samsung J330F...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_7.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Lenovo IdeaPad</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount">-25%</li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_8.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$225</div>
												<div class="product_name"><div><a href="product.html">Digitus EDNET...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_1.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$225</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_2.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_3.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_4.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$225</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_5.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$225</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_6.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_7.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$379</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/featured_8.png') }}" alt=""></div>
											<div class="product_content">
												<div class="product_price">$225</div>
												<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">Add to Cart</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Popular Categories -->

	<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Popular Categories</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link"><a href="#">full catalog</a></div>
					</div>
				</div>

				<!-- Popular Categories Slider -->

				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">
                            {{-- @dd($categories) --}}
							<!-- Popular Categories Item -->
                            @foreach ($categories as $category)
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image">
                                        <i class="{{ $category->icon }}" style="display: block;
                                            width: 100%;
                                            max-height: 100%;
                                            max-width: 100%;
                                            font-size: 30px;
                                            "></i>
                                        {{-- <img src="{{ asset('frontend/images/popular_1.png') }}" alt=""> --}}
                                    </div>
									<div class="popular_category_text"><a href="{{ route('category.wise.product',$category->id) }}">{{ substr($category->name,0,15) }}...</a></div>
								</div>
							</div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Hot New Arrivals -->

    @foreach ($home_categories as $home_category)
        @php
            $products = App\Models\Product::where('category_id', $home_category->id)->orderBy('id','DESC')->get();
        @endphp

        @if (count($products) > 0)
        <div class="new_arrivals">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="tabbed_container">
                            <div class="tabs clearfix tabs-right">
                                <div class="new_arrivals_title">{{ $home_category->name }}</div>
                                <ul class="clearfix">
                                    <li><a href="#">view more</a></li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="z-index:1;">

                                    <!-- Product Panel -->
                                    <div class="product_panel panel active">
                                        <div class="arrivals_slider slider">

                                            @foreach ($products as $product)
                                            <!-- Slider Item -->
                                            <div class="arrivals_slider_item">
                                                <div class="border_active"></div>
                                                <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        {{-- <img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""> --}}
                                                        <img src="{{ asset('upload/product/'.$product->thumbnail) }}" alt="" style="width: 115px; height: 80px;">
                                                    </div>
                                                    <div class="product_content">
                                                        {{-- <div class="product_price">$225</div> --}}
                                                        @if ($product->discount_price == NULL)
                                                            <div class="product_price discount">{{$setting->currency}}{{$product->selling_price}}</div>
                                                        @else
                                                            <div class="product_price discount">{{$setting->currency}}{{$product->discount_price}}<span><del>{{$setting->currency}}{{$product->selling_price}}</del></span></div>
                                                        @endif
                                                        <div class="product_name"><div><a href="{{ route('single.product',$product->slug) }}">{{ $product->name }}</a></div></div>
                                                        <div class="product_extras">
                                                            {{-- <div class="product_color">
                                                                <input type="radio" checked name="product_color" style="background:#b19c83">
                                                                <input type="radio" name="product_color" style="background:#000000">
                                                                <input type="radio" name="product_color" style="background:#999999">
                                                            </div> --}}
                                                            <div class="mt-1">
                                                                <span class="badge badge-success p-1 quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">Quick View</span>
                                                            </div>
                                                            <button class="product_cart_button quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    @auth
                                                        @php
                                                            $findData = App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                                                        @endphp
                                                        <a href="{{ route('add.wishlist',$product->id) }}">
                                                            <div class="product_fav {{ $findData ? 'active' : '' }}"><i class="fas fa-heart"></i></div>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('customer.login') }}">
                                                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                        </a>
                                                    @endauth


                                                    {{-- <div class="product_fav"><i class="fas fa-heart"></i></div> --}}
                                                    {{-- <ul class="product_marks">
                                                        <li class="product_mark product_discount">-25%</li>
                                                        <li class="product_mark product_new">new</li>
                                                    </ul> --}}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="arrivals_slider_dots_cover"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach


	<!-- Banner -->

	<div class="banner_2">
		<div class="banner_2_background" style="background-image:url({{ asset('frontend/images/banner_2_background.jpg') }})"></div>
		<div class="banner_2_container">
			<div class="banner_2_dots"></div>
			<!-- Banner 2 Slider -->

			<div class="owl-carousel owl-theme banner_2_slider">

				<!-- Banner 2 Slider Item -->
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category">Laptops</div>
										<div class="banner_2_title">MacBook Air 13</div>
										<div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
										<div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="button banner_2_button"><a href="#">Explore</a></div>
									</div>

								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container">
										<div class="banner_2_image"><img src="{{ asset('frontend/images/banner_2_product.png') }}" alt=""></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Banner 2 Slider Item -->
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category">Laptops</div>
										<div class="banner_2_title">MacBook Air 13</div>
										<div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
										<div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="button banner_2_button"><a href="#">Explore</a></div>
									</div>

								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container">
										<div class="banner_2_image"><img src="{{ asset('frontend/images/banner_2_product.png') }}" alt=""></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Banner 2 Slider Item -->
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category">Laptops</div>
										<div class="banner_2_title">MacBook Air 13</div>
										<div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
										<div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="button banner_2_button"><a href="#">Explore</a></div>
									</div>

								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container">
										<div class="banner_2_image"><img src="{{ asset('frontend/images/banner_2_product.png') }}" alt=""></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Hot New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Hot New Arrivals</div>
							<ul class="clearfix">
								<li class="active">Featured</li>
								<li>Audio & Video</li>
								<li>Laptops & Computers</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-9" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Astro M2 Black</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_2.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Transcend T.Sonic</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button active">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_3.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Xiaomi Band 2...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_4.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Rapoo T8 White</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_5.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Philips BT6900A</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_6.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Nokia 3310(2017)...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_7.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Rapoo 7100p Gray</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_8.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Canon EF</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Gembird SPK-103</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_2.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Canon IXUS 175...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_3.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
										<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_4.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_5.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_6.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_7.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_8.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>

								<!-- Product Panel -->
								<div class="product_panel panel">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_2.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button active">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_3.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_4.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_5.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_6.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_7.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_8.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_2.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_3.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
										<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_4.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_5.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_6.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_7.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_8.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>

								<!-- Product Panel -->
								<div class="product_panel panel">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_2.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button active">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_3.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_4.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_5.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_6.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_7.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_8.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_1.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_2.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_3.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
										<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_4.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_5.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_6.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_7.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$379</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>

										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('frontend/images/new_8.jpg') }}" alt=""></div>
												<div class="product_content">
													<div class="product_price">$225</div>
													<div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button">Add to Cart</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>

							</div>

							<div class="col-lg-3">
								<div class="arrivals_single clearfix">
									<div class="d-flex flex-column align-items-center justify-content-center">
										<div class="arrivals_single_image"><img src="{{ asset('frontend/images/new_single.png') }}" alt=""></div>
										<div class="arrivals_single_content">
											<div class="arrivals_single_category"><a href="#">Smartphones</a></div>
											<div class="arrivals_single_name_container clearfix">
												<div class="arrivals_single_name"><a href="#">LUNA Smartphone</a></div>
												<div class="arrivals_single_price text-right">$379</div>
											</div>
											<div class="rating_r rating_r_4 arrivals_single_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<form action="#"><button class="arrivals_single_button">Add to Cart</button></form>
										</div>
										<div class="arrivals_single_fav product_fav active"><i class="fas fa-heart"></i></div>
										<ul class="arrivals_single_marks product_marks">
											<li class="arrivals_single_mark product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Adverts -->

	<div class="adverts">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 advert_col">

					<!-- Advert Item -->

					<div class="advert d-flex flex-row align-items-center justify-content-start">
						<div class="advert_content">
							<div class="advert_title"><a href="#">Trendy Product</a></div>
							<div class="advert_text">This year best trendy product for you.</div>
						</div>
						<div class="ml-auto"><div class="advert_image"><img src="{{ asset('frontend/images/adv_1.png') }}" alt=""></div></div>
					</div>
				</div>

				<div class="col-lg-4 advert_col">

					<!-- Advert Item -->

					<div class="advert d-flex flex-row align-items-center justify-content-start">
						<div class="advert_content">
							<div class="advert_subtitle">Trends 2018</div>
							<div class="advert_title_2"><a href="#">Sale -45%</a></div>
							<div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
						</div>
						<div class="ml-auto"><div class="advert_image"><img src="{{ asset('frontend/images/adv_2.png') }}" alt=""></div></div>
					</div>
				</div>

				<div class="col-lg-4 advert_col">

					<!-- Advert Item -->

					<div class="advert d-flex flex-row align-items-center justify-content-start">
						<div class="advert_content">
							<div class="advert_title"><a href="#">Trends 2018</a></div>
							<div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
						</div>
						<div class="ml-auto"><div class="advert_image"><img src="{{ asset('frontend/images/adv_3.png') }}" alt=""></div></div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Trends -->

	<div class="trends">
		<div class="trends_background" style="background-image:url({{ asset('frontend/images/trends_background.jpg') }})"></div>
		<div class="trends_overlay"></div>
		<div class="container">
			<div class="row">

				<!-- Trends Content -->
				<div class="col-lg-3">
					<div class="trends_container">
						<h2 class="trends_title">Trendy Product</h2>
						<div class="trends_text"><p>This year best trendy product for you.</p></div>
						<div class="trends_slider_nav">
							<div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
					</div>
				</div>

				<!-- Trends Slider -->
				<div class="col-lg-9">
					<div class="trends_slider_container">

						<!-- Trends Slider -->

						<div class="owl-carousel owl-theme trends_slider">

							<!-- Trends Slider Item -->
                            @if (!empty($trendy_products))
                                @foreach ($trendy_products as $trendy_product)
                                <div class="owl-item">
                                    <div class="trends_item is_new">
                                        <div class="trends_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{ asset('upload/product/'.$trendy_product->thumbnail) }}" alt="{{ $trendy_product->name }}">
                                        </div>
                                        <div class="trends_content">
                                            <div class="trends_category">
                                                <a href="#">{{ $trendy_product->category->name }}</a>
                                                <div class="trends_price">
                                                    @if ($trendy_product->discount_price == NULL)
                                                        {{$setting->currency}}{{$trendy_product->selling_price}}
                                                    @else
                                                        {{$setting->currency}}{{$trendy_product->discount_price}} <del class="text-danger">{{$setting->currency}}{{$trendy_product->selling_price}}<del>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="trends_info clearfix">
                                                <div class="trends_name">
                                                    <a href="{{ route('single.product',$trendy_product->slug) }}">{{ substr($trendy_product->name,'0','20') }}...</a>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="trends_marks">
                                            <li class="trends_mark trends_discount">-25%</li>
                                            {{-- <li class="trends_mark trends_new"><i class="fa fa-eye"></i></li> --}}
                                            <a href="#" class="trends_mark trends_new">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </ul>
                                        <div class="trends_fav"><i class="fas fa-heart"></i></div>
                                    </div>
                                </div>
                                @endforeach
                            @endif

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Reviews -->

	<div class="reviews">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="reviews_title_container">
						<h3 class="reviews_title">Latest Reviews</h3>
						<div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
					</div>

					<div class="reviews_slider_container">

						<!-- Reviews Slider -->
						<div class="owl-carousel owl-theme reviews_slider">

							<!-- Reviews Slider Item -->
                            @foreach ($latest_reviews as $latest_review)
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div><div class="review_image"><img src="{{ asset('upload/demo.jpg') }}" alt=""></div></div>
									<div class="review_content">
										<div class="review_name">{{ $latest_review->name }}</div>
										<div class="review_rating_container">
                                                @if ($latest_review->rating == 5)
                                                <div>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                </div>
                                                @elseif ($latest_review->rating == 4)
                                                <div>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                @elseif ($latest_review->rating == 3)
                                                <div>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                @elseif ($latest_review->rating == 2)
                                                <div>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                @elseif ($latest_review->rating == 1)
                                                <div>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                @endif
											<div class="review_time">{{ $latest_review->created_at->diffForHumans() }}</div>
										</div>
										<div class="review_text"><p style="text-align: justify">{{ substr($latest_review->review,'0','100') }}...</p></div>
									</div>
								</div>
							</div>
                            @endforeach

						</div>
						<div class="reviews_dots"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Products for you</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">

							<!-- Recently Viewed Item -->
                            @foreach ($random_products as $random_product)
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image">
                                        <img src="{{ asset('upload/product/'.$random_product->thumbnail) }}" alt="{{ $random_product->name }}">
                                    </div>
									<div class="viewed_content text-center">
                                        @if ($random_product->discount_price == NULL)
                                            <div class="viewed_price">{{$setting->currency}}{{$random_product->selling_price}}</span></div>
                                        @else
                                            <div class="viewed_price">{{$setting->currency}}{{$random_product->discount_price}}<span>{{$setting->currency}}{{$random_product->selling_price}}</span></div>
                                        @endif
										<div class="viewed_name"><a href="{{ route('single.product',$random_product->slug) }}">{{ substr($random_product->name,'0','30') }}...</a></div>
									</div>
								</div>
							</div>
                            @endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    @include('frontend.partials.top_footer')

    <!-- Modal -->
    {{-- product quick view --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script>
        // function cart(){
        //     $.ajax({
        //         type : 'get',
        //         url: "{{ route('all.cart') }}",
        //         // url: "{{ url('all-cart') }}",
        //         success: function(data) {
        //             console.log(data);
        //             $('.cart_qty').empty();
        //             $('.cat_total').empty();

        //             $('.cart_qty').append(data.cat_qty);
        //             $('.cat_total').append(data.cat_total);
        //         }
        //     })
        // }

        // $(document).ready(function() {
        //     cart();
        // });


        $(document).on('click','.quick_view', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ url('product-quick-view') }}/"+id,
                type: 'get',
                success: function(data) {
                    $('#modal_body').html(data);
                    // $('select[name="childcategory_id"]').empty();
                    // $.each(data, function(key, data){
                    //     $('select[name="childcategory_id"]').append('<option value="'+data.id+'">'+data.childcategory_name+'</option>');
                    // })
                }
            })
        });

        $('body').on('submit',".newsletter_form", function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();

            $.ajax({
                url: url,
                type: 'post',
                async: false,
                data: request,
                success: function(data){
                    if (data.status == 1) {
                        iziToast.success({
                            title: 'Success',
                            message: 'Thanks for subscribe us!.',
                            position: 'topRight'
                        });
                    } else if (data.status == 0){
                        iziToast.error({
                            title: 'Error',
                            message: 'Sorry! Email already exit.',
                            position: 'topRight'
                        });
                    }


                    $(".newsletter_form")[0].reset();
                }
            });
        });
    </script>
@endpush
