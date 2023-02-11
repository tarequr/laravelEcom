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
                        New Ticket
                        <a href="{{ route('open.ticket') }}" style="float: right;" class="btn btn-sm btn-primary">All Tickets</a>
                    </div>

                    <div class="card-body">
                        <strong>Submit your ticket we will reply</strong>
                        <br>
                        <div>
                            <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Enter subject" required>

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="service">Service</label>
                                        <select class="form-control" name="service" id="service" style="min-width: 220px; margin-left: 0px !important;" required>
                                            <option value="">Select service</option>
                                            <option value="Technical">Technical</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Affiliate">Affiliate</option>
                                            <option value="Return">Return</option>
                                            <option value="Refund">Refund</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="priority">Priority</label>
                                        <select class="form-control" name="priority" id="priority" style="min-width: 220px; margin-left: 0px !important;" required>
                                            <option value="">Select priority</option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Heigh">Heigh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Type here..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('frontend/js/contact_custom.js') }}"></script>
@endpush
