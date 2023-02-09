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
                        Dashboard
                        <a href="{{ route('write.review') }}" style="float: right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card bg-success">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center text-light">Total Order</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-center text-light">{{ count($orders) }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card">
                                        <div class="card-body bg-primary">
                                            <div class="card-title">
                                                <h5 class="text-center text-light">Complete</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-center text-light">{{ $complete_orders }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card bg-danger">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center text-light">Cancel</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-center text-light">{{ $return_orders }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card bg-warning">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center text-light">Retun</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-center text-light">{{ $cancel_orders }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Recent Order</h4>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Status</th>
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
