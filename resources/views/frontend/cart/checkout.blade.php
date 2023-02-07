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
            <div class="col-lg-8">
                <div class="cart_container card p-2">
                    <div class="cart_title text-center">Billing Address</div>
                        <form action="{{ route('order.place') }}" method="POST">
                            @csrf

                            <div class="form-row p-4">
                                <div class="form-group col-md-6">
                                    <label for="">Customer Name <sup class="text-danger">*</sup></label>
                                    <input type="text" name="c_name" class="form-control" value="{{ Auth::user()->name }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Customer Email <sup class="text-danger">*</sup></label>
                                    <input type="email" name="c_email" class="form-control" value="{{ Auth::user()->email }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Customer Phone <sup class="text-danger">*</sup></label>
                                    <input type="text" name="c_phone" class="form-control" value="{{ Auth::user()->phone }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Country <sup class="text-danger">*</sup></label>
                                    <input type="text" name="c_country" class="form-control" value="" required placeholder="Enter country">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Shipping Address <sup class="text-danger">*</sup></label>
                                    <input type="text" name="c_address" class="form-control" value="" required placeholder="Enter shipping address">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Zip Code</label>
                                    <input type="text" name="c_zipcode" class="form-control" value="" required placeholder="Enter zipcode">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">City</label>
                                    <input type="text" name="c_city" class="form-control" value="" required placeholder="Enter city">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Extra Phone</label>
                                    <input type="text" name="c_extra_phone" class="form-control" value="" required placeholder="Enter extra phone">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">Paypal</label>
                                    <input type="radio" name="payment_type" value="paypal">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">SSL Commerce</label>
                                    <input type="radio" name="payment_type" value="ssl_commerce">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">Hand Cash</label>
                                    <input type="radio" name="payment_type" value="hand_cash" checked>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-info">Apply Coupon</button>
                                </div>
                            </div>
                        </form>

                    <!-- Order Total -->
                    {{-- <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">{{$setting->currency}}{{ Cart::total() }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ route('cart.empty') }}" class="button cart_button_clear btn-danger">Empty Cart</a>
                        <a href="{{ route('checkout') }}" class="button cart_button_checkout">CheckOut</a>
                    </div> --}}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="pl-4 pt-2">
                        <p style="color: black;">Sub Total: <span style="float: right; padding-right: 5px;">{{ Cart::subtotal() }} {{$setting->currency}}</span></p>
                        @if (Session::has('coupon'))
                        <p style="color: black;">Coupon: ({{Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="badge badge-danger">X</a> <span style="float: right; padding-right: 5px;">{{Session::get('coupon')['discount'] }} {{$setting->currency}}</span></p>
                        @endif
                        <p style="color: black;">Tax: <span style="float: right; padding-right: 5px;">0.00 %</span></p>
                        <p style="color: black;">Shipping: <span style="float: right; padding-right: 5px;">0.00 {{$setting->currency}}</span></p>
                        <p style="color: black;"><b>Total: <span style="float: right; padding-right: 5px;">{{ Session::has('coupon') ? Session::get('coupon')['after_discount'] : Cart::total() }} {{$setting->currency}}</span></b></p>
                    </div>

                    @if (!Session::has('coupon'))
                        <form action="{{ route('apply.coupon') }}" method="POST">
                            @csrf

                            <div class="p-4">
                                <div class="form-group">
                                    <label for="">Coupon Apply</label>
                                    <input type="text" name="coupon" class="form-control" placeholder="Enter coupon code" required autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Apply Coupon</button>
                                </div>
                            </div>
                        </form>
                    @endif
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
