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
                        <a href="{{ route('write.review') }}" style="float: right;"><i class="fas fa-pencil-alt"></i> Write
                            a review</a>
                    </div>

                    <div class="card-body">
                        <h4>Write your valuable review based on our product quality and services.</h4>
                        <br>
                        <br>
                        <div>
                            <form action="#" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="write_review">Write Review</label>
                                    <textarea name="write_review" class="form-control" id="write_review" cols="30" rows="5" placeholder="Type here..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="details">Rating</label>
                                    <select class="form-control" name="rating" id="" style="min-width: 120px;">
                                        <option value="">Select Your Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5" selected>5 Star</option>
                                    </select>
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
