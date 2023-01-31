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
                        <h4>Your Default Shipping Credentials.</h4>
                        <br>
                        <br>
                        <div>
                            <form action="{{ route('write.review.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="write_review">Write Review</label>
                                    <textarea name="review" class="form-control @error('review') is-invalid @enderror" id="write_review" cols="30" rows="5" placeholder="Type here..." required></textarea>

                                    @error('review')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="details">Rating</label>
                                    <select class="form-control @error('rating') is-invalid @enderror" name="rating" id="" style="min-width: 120px; margin-left: 0px !important;" required>
                                        <option value="">Select Your Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5" selected>5 Star</option>
                                    </select>

                                    @error('rating')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
