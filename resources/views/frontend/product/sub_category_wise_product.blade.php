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
			<h2 class="home_title">{{ $sub_category->subcategory_name }}</h2>
		</div>
	</div>




	<!-- Shop -->
	<div class="shop">
		<div class="container">
            <!-- Brands -->
            <div class="row mb-5">
                <div class="col">
                    <div class="brands_slider_container">
                        <!-- Brands Slider -->
                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($branddds as $brand)
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ $brand->brand_logo }}" alt="{{ $brand->brnad_name }}" title="{{ $brand->brnad_name }}" height="50" width="40">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>

			<div class="row">
				<div class="col-lg-3">
					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Child Categories</div>
                            @foreach ($child_categories as $child_category)
                                <ul class="sidebar_categories">
                                    <li><a href="{{ route('child.category.product',$child_category->id) }}">{{ $child_category->childcategory_name }}</a></li>
                                </ul>
                            @endforeach
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-9">

					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid">
							<div class="product_grid_border"></div>

							<!-- Product Item -->
                            @foreach($products as $product)
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('upload/product/'.$product->thumbnail) }}" alt="" style="width: 115px; height: 115px;">
                                    </div>
                                    <div class="product_content">
                                        @if ($product->discount_price == null)
                                            <div class="product_price">{{$setting->currency}}{{$product->selling_price}}</div>
                                        @else
                                            <div class="product_price">{{$setting->currency}}{{$product->discount_price}}<span class="text-danger">{{$setting->currency}}{{$product->selling_price}}</span></div>
                                        @endif
                                        <div class="product_name"><div><a href="{{ route('single.product',$product->slug) }}" tabindex="0">{{ $product->name }}</a></div></div>
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

                                    <ul class="product_marks">
                                        <li class="product_mark product_new quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">
                                            <i class="fas fa-eye"></i>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							{!! $products->links() !!}
						</div>

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
<script src="{{ asset('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/shop_custom.js') }}"></script>

<script>
    $(document).on('click','.quick_view', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ url('product-quick-view') }}/"+id,
            type: 'get',
            success: function(data) {
                $('#modal_body').html(data);
            }
        })
    });

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

    // $('.loader').ready(function(){
    //     setTimeout(() => {
    //         $('.product_view').removeClass('');
    //         $('.loader').css('display', 'none');
    //     }, 500);
    // });

    $('body').on('submit',"#add_to_cart_form", function(e){
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var url = $(this).attr('action');
            var request = $(this).serialize();

            $.ajax({
                url: url,
                type: 'post',
                async: false,
                data: request,
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Add To Cart Successfully.',
                        position: 'topRight'
                    });

                    $("#add_to_cart_form")[0].reset();
                    $('.loading').addClass('d-none');
                    cart(); //add to cart show data
                }
            });
        });

</script>
@endpush
