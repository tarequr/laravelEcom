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
                        <div>
                            <form action="{{ route('write.review.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter shipping name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter shipping email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter shipping phone">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter shipping address">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="city" placeholder="City">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="zipcode">Zip Code</label>
                                        <input type="text" class="form-control" name="zipcode" placeholder="Zip Code">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="card-body">
                        <h4>Change Your Password.</h4>
                        <br>
                        <div>
                            <form action="{{ route('customer.password.update') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Enter old password">

                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter new password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Re-type password">

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
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
