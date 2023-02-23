{{-- <form method="" action="#" id="addForm" enctype="multipart/form-data"> --}}

    <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-4">
                <span><b>Name:</b> {{ $order->c_name }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Email:</b> {{ $order->c_email }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Phone:</b> {{ $order->c_phone }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Country:</b> {{ $order->c_country }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>City:</b> {{ $order->c_city }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Zipcode:</b> {{ $order->c_zipcode }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>OrderID:</b> {{ $order->order_id }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Subtotal:</b> {{ $order->subtotal }} {{ $setting->currency }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Total:</b> {{ $order->total }} {{ $setting->currency }}</span>
            </div>
            <div class="form-group col-md-4">
                <span><b>Order Status:</b>
                    @if ($order->status == 0)
                        <span class="badge badge-danger">Order Pending</span>
                    @elseif ($order->status == 1)
                        <span class="badge badge-info">Order Received</span>
                    @elseif ($order->status == 2)
                        <span class="badge badge-primary">Order Shipping</span>
                    @elseif ($order->status == 3)
                        <span class="badge badge-success">Order Done</span>
                    @elseif ($order->status == 4)
                        <span class="badge badge-warning">Order Return</span>
                    @elseif ($order->status == 5)
                        <span class="badge badge-danger">Order Cancle</span>
                    @endif
                </span>
            </div>
        </div>
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">SL</th>
                    <th class="text-center">Product</th>
                    <th class="text-center">Size</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Qty*Price</th>
                    <th class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($order_details as $order_detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order_detail->product_name }}</td>
                        <td>{{ $order_detail->size }}</td>
                        <td>{{ $order_detail->color }}</td>
                        <td>{{ $order_detail->quantity }} * {{ $order_detail->single_price }} {{ $setting->currency }}</td>
                        <td>{{ $order_detail->subtotal_price }} {{ $setting->currency }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
{{-- </form> --}}

