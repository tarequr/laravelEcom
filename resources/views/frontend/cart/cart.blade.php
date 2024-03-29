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
                            {{-- @dd($contents) --}}
                            @foreach ($contents as $data)

                            @php
                                $product = App\Models\Product::where('id', $data->id)->first();
                                $sizes  = explode(',',$product->size);
                                $colors = explode(',',$product->color);
                            @endphp
                            <li class="cart_item clearfix">
                                <div class="cart_item_image" style="height: 80px; width: 110px;">
                                    <img src="{{ asset('upload/product/'.$data->options->thumbnail) }}" alt="" >
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Name</div>
                                        <div class="cart_item_text">{{ substr($data->name, '0', '15') }}...</div>
                                    </div>
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Color</div>
                                        @if ($data->options->color != null)
                                            <div class="cart_item_text">
                                                <select class="form-control form-control-sm color" name="color" data-id="{{$data->rowId}}" id="" style="min-width: 110px;">
                                                    @foreach ($colors as $color)
                                                        <option value="{{$color}}" {{ $color == $data->options->color ? "selected" : "" }}>{{$color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Size</div>
                                        @if ($data->options->size != null)
                                            <div class="cart_item_text">
                                                <select class="form-control form-control-sm size" name="size" data-id="{{$data->rowId}}" id="" style="min-width: 110px;">
                                                    @foreach ($sizes as $size)
                                                        <option value="{{$size}}" {{ $size == $data->options->size ? "selected" : "" }}>{{$size}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_title">Quantity</div>
                                        <div class="cart_item_text">
                                            <input class="form-control form-control-sm qty" type="number" data-id="{{$data->rowId}}" min="1" name="qty" pattern="[1-9]*" value="{{ $data->qty }}" required style="width: 65px;">
                                        </div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title">Price</div>
                                        <div class="cart_item_text">{{$setting->currency}}{{ $data->price }} x {{ $data->qty }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Total</div>
                                        <div class="cart_item_text">{{$setting->currency}}{{ $data->price * $data->qty }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Action</div>
                                        <div class="cart_item_text">
                                            <a href="#" data-id="{{ $data->rowId }}" id="removeCart" class="btn btn-sm btn-danger">X</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">{{$setting->currency}}{{ Cart::total() }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ route('cart.empty') }}" class="button cart_button_clear btn-danger">Empty Cart</a>
                        <a href="{{ route('checkout') }}" class="button cart_button_checkout">CheckOut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
    <script>
        $(document).on('click','#removeCart', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: "{{ url('product-cart/remove') }}/"+id,
                type: 'get',
                success: function(data) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Cart remove successfully.',
                        position: 'topRight'
                    });
                    location.reload();
                }
            })
        });

        /* Product Qty Update*/
        $(document).on('blur','.qty', function(e){
            e.preventDefault();
            let qty = $(this).val();
            let rowId = $(this).data('id');
            // alert(rowId);
            $.ajax({
                url: "{{ url('product-cart/qtyupdate') }}/"+rowId+'/'+qty,
                type: 'get',
                success: function(data) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Product quantity update successfully.',
                        position: 'topRight'
                    });
                    location.reload();
                }
            })
        });

        /* Product Color Update*/
        $(document).on('change','.color', function(e){
            e.preventDefault();
            let color = $(this).val();
            let rowId = $(this).data('id');
            // alert(color);
            $.ajax({
                url: "{{ url('product-cart/colorupdate') }}/"+rowId+'/'+color,
                type: 'get',
                success: function(data) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Product color update successfully.',
                        position: 'topRight'
                    });
                    location.reload();
                }
            })
        });

        /* Product Size Update*/
        $(document).on('change','.size', function(e){
            e.preventDefault();
            let size = $(this).val();
            let rowId = $(this).data('id');
            // alert(size);
            $.ajax({
                url: "{{ url('product-cart/sizeupdate') }}/"+rowId+'/'+size,
                type: 'get',
                success: function(data) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Product size update successfully.',
                        position: 'topRight'
                    });
                    location.reload();
                }
            })
        });
    </script>
@endpush
