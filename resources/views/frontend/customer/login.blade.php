@extends('frontend.master')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_responsive.css') }}">
@endpush

@section('content')
<!-- Contact Form -->

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1" style="margin: auto">
                <div class="card p-4 shadow-lg">
                <div class="contact_form_container">
                    <div class="contact_form_title text-center">Customer Login</div>

                    <form action="{{ route('login') }}" method="POST" id="contact_form">
                        @csrf

                        <div class="form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="email" id="" class="form-control" name="email" placeholder="Enter email" required data-error="Name is required.">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Password</label>
                            <input type="password" id="" class="form-control" name="password" placeholder="Enter password" required data-error="Name is required.">
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" class="button contact_submit_button">Login</button>
                        </div>
                    </form>

                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>
@endsection

@push('js')
<script src="{{ asset('frontend/js/contact_custom.js') }}"></script>
@endpush
