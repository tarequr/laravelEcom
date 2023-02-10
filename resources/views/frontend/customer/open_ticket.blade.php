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
                        All Tickets
                        <a href="{{ route('new.ticket') }}" style="float: right;" class="btn btn-sm btn-primary"> Open Ticket</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Service</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ date('d-M-Y', strtotime($ticket->date)) }}</td>
                                <td>{{ $ticket->service }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    @if ($ticket->status == 0)
                                        <span class="badge badge-danger">Pending</span>
                                    @elseif ($ticket->status == 1)
                                        <span class="badge badge-success">Replied</span>
                                    @elseif ($ticket->status == 2)
                                        <span class="badge badge-muted">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-info" title="Order Details">
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
