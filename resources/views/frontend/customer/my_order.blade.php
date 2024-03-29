@extends('frontend.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_responsive.css') }}">
@endpush

@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('frontend.customer.customer_sidebar')
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Order
                    </div>
                </div>
                <br>
                <h4>My Order</h4>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ date('d-M-Y', strtotime($order->date)) }}</td>
                                <td>{{ ucwords(str_replace("_"," ",$order->payment_type)) }}</td>
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
                                <td>
                                    <a href="{{ route('view.order',$order->id) }}" class="btn btn-sm btn-info" title="Order Details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('frontend/js/contact_custom.js') }}"></script>
@endpush
