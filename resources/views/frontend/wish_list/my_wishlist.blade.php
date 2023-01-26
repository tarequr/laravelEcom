<!-- Single Product -->
@extends('frontend.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">
@endpush

@section('content')
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($wishLists as $data)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image" style="height: 80px; width: 110px;">
                                    <img src="{{ asset('upload/product/'.$data->product->thumbnail) }}" alt="" >
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{ $data->product->name }}</div>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_text">{{ date('d-M-Y',strtotime($data->created_at)) }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_text">
                                            <a href="{{ route('cart.empty') }}" class="button cart_button_clear btn-danger">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ url('/') }}" class="button cart_button_checkout">Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endpush
