
<div class="row">
    <div class="col-md-12">
        <h3><b>Lara Ecom Full Projcet</b></h3>
        <h6>All Order Details</h6>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Payment Type</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        {{-- <tr>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
            <td>hello</td>
        </tr> --}}
        @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->c_name }}</td>
                <td>{{ $order->c_email }}</td>
                <td>{{ $order->c_phone }}</td>
                <td>{{ $order->subtotal }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->payment_type }}</td>
                <td>{{ date('Y-m-d', strtotime($order->date)) }}</td>
                <td>
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
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

