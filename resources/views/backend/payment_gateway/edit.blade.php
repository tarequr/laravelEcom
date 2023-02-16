@extends('backend.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9 mb-5">
                <div class="row">
                    <div class="card col-lg-4 p-2">
                        <div class="card-header bg-primary text-light">SMTP Setting</div>
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype="multipart/form-data">
                                @csrf

                                @method('PUT')

                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Store ID</label>
                                        <input type="text" name="store_id" class="form-control" value="{{ $aamarpay->store_id }}" placeholder="Enter Store ID">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Signature KEY</label>
                                        <input type="text" name="signature_key" class="form-control" value="{{ $aamarpay->signature_key }}" placeholder="Enter Signature KEY">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-lg-4 p-2">
                        <div class="card-header bg-primary text-light">SMTP Setting</div>
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype="multipart/form-data">
                                @csrf

                                @method('PUT')

                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Store ID</label>
                                        <input type="text" name="store_id" class="form-control" value="{{ $aamarpay->store_id }}" placeholder="Enter Store ID">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Signature KEY</label>
                                        <input type="text" name="signature_key" class="form-control" value="{{ $aamarpay->signature_key }}" placeholder="Enter Signature KEY">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-lg-4 p-2">
                        <div class="card-header bg-primary text-light">SMTP Setting</div>
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype="multipart/form-data">
                                @csrf

                                @method('PUT')

                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Store ID</label>
                                        <input type="text" name="store_id" class="form-control" value="{{ $aamarpay->store_id }}" placeholder="Enter Store ID">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Signature KEY</label>
                                        <input type="text" name="signature_key" class="form-control" value="{{ $aamarpay->signature_key }}" placeholder="Enter Signature KEY">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
