<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">

                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">
                        @foreach ($brands as $brand)
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
    </div>
</div>
