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

            <!-- Images -->
            <div class="col-lg-1 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{ asset('frontend/images/single_4.jpg') }}"><img src="{{ asset('frontend/images/single_4.jpg') }}" alt=""></li>
                    <li data-image="{{ asset('frontend/images/single_2.jpg') }}"><img src="{{ asset('frontend/images/single_2.jpg') }}" alt=""></li>
                    <li data-image="{{ asset('frontend/images/single_3.jpg') }}"><img src="{{ asset('frontend/images/single_3.jpg') }}" alt=""></li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-4 order-lg-2 order-1">
                <div class="image_selected"><img src="{{ asset('frontend/images/single_4.jpg') }}" alt=""></div>
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
                                    <div class="col-lg-6">
                                        <label for="">Size:</label>
                                        <select class="form-control form-control-sm" name="size" id="">
                                            <option value="">A</option>
                                            <option value="">B</option>
                                            <option value="">C</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Color:</label>
                                        <select class="form-control form-control-sm" name="size" id="">
                                            <option value="">A</option>
                                            <option value="">B</option>
                                            <option value="">C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix" style="z-index: 1000;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
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
@endsection

@push('js')
{{-- <script src="{{ asset('frontend/js/custom.js') }}"></script> --}}
<script src="{{ asset('frontend/js/product_custom.js') }}"></script>
@endpush
