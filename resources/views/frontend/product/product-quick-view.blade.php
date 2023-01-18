<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="">
                <img src="{{ asset('upload/product/'.$product->thumbnail) }}" alt="" height="100%" width="100%">
            </div>
        </div>

        @php
            $sizes  = explode(',',$product->size);
            $colors = explode(',',$product->color);
        @endphp

        <div class="col-lg-8">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->category->name }} > {{ $product->subCategories->subcategory_name }}</p>
            <p>Brand: {{ $product->brand->brnad_name }}</p>
            <p>Stock:
                @if ($product->stock_quantity < 1)
                    <span class="badge badge-danger">Stock Out</span>
                @else
                    <span class="badge badge-success">Stock Available</span>
                @endif
            </p>
            <div class="">Price:
                @if ($product->discount_price == null)
                <div class="product_price" style="margin-top: 20px !important;">{{$setting->currency}}{{$product->selling_price}}</div>
                @else
                <div class="product_price" style="margin-top: 20px !important;"><del class="text-danger" style="font-size: 17px;">{{$setting->currency}}{{$product->selling_price}}</del> {{$setting->currency}}{{$product->discount_price}}</div>
                @endif
            </div><br>

            <div class="order_info d-flex flex-row">
                <form action="{{ route('add.to.cart.quickview') }}" method="POST" id="add_to_cart_form">
                    @csrf

                    <input type="hidden" name="id" value="{{ $product->id }}">
                    @if ($product->discount_price == null)
                        <input type="hidden" name="price" value="{{ $product->selling_price }}">
                    @else
                        <input type="hidden" name="price" value="{{ $product->discount_price }}">
                    @endif

                    <div class="form-group">
                        <input type="number" min="1" max="100" value="1" name="qty" class="form-control-sm" style="margin-left: 10px;" placeholder="Qty">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5">
                                <label for="size" class="ml-2">Size</label>
                                <select class="custom-select form-control-sm" name="size" id="size" style="min-width: 120px;">
                                    @foreach ($sizes as $size)
                                        <option value="{{$size}}">{{$size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5">
                                <label for="color" class="ml-2">Color</label>
                                <select class="custom-select form-control-sm" name="color" id="color" style="min-width: 120px;">
                                    @foreach ($colors as $color)
                                        <option value="{{$color}}">{{$color}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button_container">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                @if ($product->stock_quantity < 1)
                                    <span class="btn btn-danger" style="margin-left: 10px;">Stock Out</span>
                                @else
                                    <button class="btn btn-sm btn-outline-info" type="submit" style="margin-left: 10px;">
                                        <span class="loading d-none">...</span> Add to cart
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
                }
            });
        });

</script>
