<div class="header_main">
    <div class="container">
        <div class="row">

            <!-- Logo -->
            <div class="col-lg-2 col-sm-3 col-3 order-1">
                <div class="logo_container">
                    <div class="logo"><a href="{{ route('frontend.home') }}">OneTech</a></div>
                </div>
            </div>

            <!-- Search -->
            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                <div class="header_search">
                    <div class="header_search_content">
                        <div class="header_search_form_container">
                            <form action="#" class="header_search_form clearfix">
                                <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                <div class="custom_dropdown">
                                    <div class="custom_dropdown_list">
                                        <span class="custom_dropdown_placeholder clc">All Categories</span>
                                        <i class="fas fa-chevron-down"></i>
                                        <ul class="custom_list clc">
                                            <li><a class="clc" href="#">All Categories</a></li>
                                            <li><a class="clc" href="#">Computers</a></li>
                                            <li><a class="clc" href="#">Laptops</a></li>
                                            <li><a class="clc" href="#">Cameras</a></li>
                                            <li><a class="clc" href="#">Hardware</a></li>
                                            <li><a class="clc" href="#">Smartphones</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('frontend/images/search.png') }}" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                    <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                        <div class="wishlist_icon"><img src="{{ asset('frontend/images/heart.png') }}" alt=""></div>

                        @auth
                            @php
                                $wishlist = App\Models\Wishlist::where('user_id', Auth::user()->id)->count();
                            @endphp
                        @endauth

                        <div class="wishlist_content">
                            <div class="wishlist_text"><a href="{{ route('my-wishlist') }}">Wishlist</a></div>
                            <div class="wishlist_count">{{ @$wishlist ? $wishlist : '0' }}</div>
                        </div>
                    </div>

                    <!-- Cart -->
                    <div class="cart">
                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <div class="cart_icon">
                                <img src="{{ asset('frontend/images/cart.png') }}" alt="">
                                <div class="cart_count"><span class="cart_qty"></span></div>
                            </div>
                            <div class="cart_content">
                                <div class="cart_text"><a href="{{ route('my.cart') }}">Cart</a></div>
                                <div class="cart_price">{{$setting->currency}} <span class="cat_total"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
