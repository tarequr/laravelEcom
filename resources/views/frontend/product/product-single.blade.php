<!-- Single Product -->
@extends('frontend.master')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

<style>
    .checked{
        color: gold;
    }
</style>
@endpush

@section('content')
<div class="single_product">
    <div class="container">
        <div class="row">
            @php
                $images = json_decode($product->images);
            @endphp
            <!-- Images -->
            <div class="col-lg-1 order-lg-1 order-2">
                <ul class="image_list">
                    @foreach ($images as $image)
                    <li data-image="{{ asset('upload/product_images/'.$image) }}"><img src="{{ asset('upload/product_images/'.$image) }}" alt=""></li>
                    @endforeach
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-4 order-lg-2 order-1">
                <div class="image_selected"><img src="{{ asset('upload/product/'.$product->thumbnail) }}" alt="{{ $product->name }}"></div>
            </div>

            <!-- Description -->
            <div class="col-lg-4 order-3">
                <div class="product_description">
                    <div class="product_category">{{ $product->category->name }} > {{ $product->subCategories->subcategory_name }}</div>
                    <div class="product_name" style="font-size: 20px;">{{ $product->name }}</div>

                    <div class="product_category"><b> Brand: {{ $product->brand->brnad_name }}</b></div>
                    <div class="product_category"><b> Stock: {{ $product->stock_quantity }}</b></div>
                    <div class="product_category"><b> Unit: {{ $product->unit }}</b></div>

                    <div>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                    </div>

                    <div>
                        @if ($banner_product->discount_price == null)
						<div class="product_price" style="margin-top: 20px !important;">{{$setting->currency}}{{$banner_product->selling_price}}</div>
                        @else
                        <div class="product_price" style="margin-top: 20px !important;"><del class="text-danger" style="font-size: 17px;">{{$setting->currency}}{{$banner_product->selling_price}}</del> {{$setting->currency}}{{$banner_product->discount_price}}</div>
                        @endif
                    </div>
                    {{-- <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div> --}}
                    {{-- <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div> --}}
                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    @isset($product->size)
                                        @php
                                            $sizes = explode(',',$product->size);
                                        @endphp
                                    <div class="col-lg-6">
                                        <label for="">Size:</label>
                                        <select class="form-control form-control-sm" name="size" id="">
                                            @foreach ($sizes as $size)
                                                <option value="{{$size}}">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endisset

                                    @isset($product->color)
                                        @php
                                            $colors = explode(',',$product->color);
                                        @endphp
                                    <div class="col-lg-6">
                                        <label for="">Color:</label>
                                        <select class="form-control form-control-sm" name="color" id="">
                                            @foreach ($colors as $color)
                                                <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endisset
                                </div>
                            </div>

                            <div class="clearfix" style="z-index: 1000;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix ml-2">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[1-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Color -->
                                {{-- <ul class="product_color">
                                    <li>
                                        <span>Color: </span>
                                        <div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
                                        <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                        <ul class="color_list">
                                            <li><div class="color_mark" style="background: #999999;"></div></li>
                                            <li><div class="color_mark" style="background: #b19c83;"></div></li>
                                            <li><div class="color_mark" style="background: #000000;"></div></li>
                                        </ul>
                                    </li>
                                </ul> --}}

                            </div>

                            {{-- <div class="product_price">$2000</div> --}}
                            <div class="button_container">
                                <button type="button" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 order-4" style="border-left: 1px solid grey; padding-left: 10px;">
                <strong class="text-muted">Pickup Point of this product :</strong>
                <i class="fa fa-map"> {{ $product->pickupPoint->name }}</i><hr><br>
                <strong class="text-muted">Home Delivery :</strong><br>
                -> (4-8) days after the order placed. <br>
                -> Cash on Delivery Available.
                <hr><br>
                <strong class="text-muted">Product Return & Warrenty :</strong><br>
                -> 7 days after the order placed. <br>
                -> Warrenty not Available.
                <hr><br>

                @isset($product->video)
                <strong>Product Video :</strong>
                <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endisset
            </div>
        </div><br><br>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product details of {{ $product->name }}</h4>
                    </div>
                    <div class="card-body">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Rating & Reviews of {{ $product->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                Average Review of {{ $product->name }}:<br>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star"></i>
                            </div>

                            <div class="col-lg-3">
                                Total Review of This Product:<br>
                                <div>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <span> Total 52</span>
                                </div>
                                <div>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <span> Total 52</span>
                                </div>
                                <div>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span> Total 52</span>
                                </div>
                                <div>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span> Total 52</span>
                                </div>
                                <div>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span> Total 52</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="details">Write Your Review</label>
                                        <textarea name="" id="" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="details">Write Your Review</label>
                                        <select class="form-control" name="review" id="" style="width: 200px; margin-left: -2px">
                                            <option value="" disabled selected> Select Your Review</option>
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-star"></i> Submit Review</button>
                                </form>
                            </div>
                        </div>
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
                    <h3 class="viewed_title">Releted Product</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">

                        <!-- Recently Viewed Item -->
                        @foreach ($reladed_produts as $reladed_pdt)
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('upload/product/'.$reladed_pdt->thumbnail) }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    @if ($reladed_pdt->discount_price == null)
                                    <div class="viewed_price">{{$setting->currency}}{{$reladed_pdt->selling_price}}</div>
                                    @else
                                    <div class="viewed_price">{{$setting->currency}}{{$reladed_pdt->discount_price}}<span>{{$setting->currency}}{{$reladed_pdt->selling_price}}</span></div>
                                    @endif

                                    <div class="viewed_name"><a href="{{ route('single.product',$reladed_pdt->slug) }}">{{ substr($reladed_pdt->name,'0','50') }}</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount" style="background-color: blueviolet !important">new</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach

                        {{-- <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('frontend/images/view_2.jpg') }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$379</div>
                                    <div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('frontend/images/view_3.jpg') }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$225</div>
                                    <div class="viewed_name"><a href="#">Samsung J730F...</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('frontend/images/view_4.jpg') }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$379</div>
                                    <div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('frontend/images/view_5.jpg') }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$225<span>$300</span></div>
                                    <div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('frontend/images/view_6.jpg') }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$375</div>
                                    <div class="viewed_name"><a href="#">Speedlink...</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.partials.top_footer')

@endsection

@push('js')
{{-- <script src="{{ asset('frontend/js/custom.js') }}"></script> --}}
<script src="{{ asset('frontend/js/product_custom.js') }}"></script>
@endpush
