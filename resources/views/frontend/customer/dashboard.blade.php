@extends('frontend.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_responsive.css') }}">
@endpush

@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        <img class="card-img-top"
                            src="https://thumbs.dreamstime.com/b/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg"
                            alt="" style="height: 200px; width: 200px;">
                        <ul class="list-group list-group-flush">
                            <a href="#" class="text-muted">
                                <li class="list-group-item">
                                    <i class="fas fa-home"></i>
                                    Dashboard
                                </li>
                            </a>

                            <a href="#" class="text-muted">
                                <li class="list-group-item">
                                    <i class="fas fa-heart"></i>
                                    Wishlist
                                </li>
                            </a>

                            <a href="#" class="text-muted">
                                <li class="list-group-item">
                                    <i class="fas fa-file-alt"></i>
                                    My Order
                                </li>
                            </a>

                            <a href="#" class="text-muted">
                                <li class="list-group-item">
                                    <i class="fas fa-edit"></i>
                                    Setting
                                </li>
                            </a>

                            <a href="#" class="text-muted">
                                <li class="list-group-item">
                                    <i class="fab fa-telegram-plane"></i>
                                    Open Ticket
                                </li>
                            </a>

                            <a href="#" class="text-muted">
                                <li class="list-group-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </li>
                            </a>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                        <a href="#" style="float: right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5>My Total Order</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">16</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5>My Total Order</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">16</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5>My Total Order</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">16</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5>My Total Order</h5>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">16</h6>
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
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
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
