@extends('backend.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9 mb-5">
                <div class="row">
                    <div class="card col-lg-4 p-2">
                        <div class="card-header bg-primary text-light">Aamarpay Gateway</div>
                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('aamarpay.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $aamarpay->id }}">
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Store ID</label>
                                        <input type="text" name="store_id" class="form-control" value="{{ $aamarpay->store_id }}" placeholder="Enter Store ID" required>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Signature KEY</label>
                                        <input type="text" name="signature_key" class="form-control" value="{{ $aamarpay->signature_key }}" placeholder="Enter Signature KEY" required>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <input type="checkbox" name="status" value="1" {{ $aamarpay->status == 1 ? 'checked' : '' }} id="status">
                                        <label class="col-form-label" for="status">Live Server</label><br>
                                        <small style="font-size: 76.5%;">(If checkbox are not checked it working for sandbox only)</small>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-lg-4 p-2">
                        <div class="card-header bg-primary text-light">ShurjoPay Gateway</div>
                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('shurjopay.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $shurjopay->id }}">
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Store ID</label>
                                        <input type="text" name="store_id" class="form-control" value="{{ $shurjopay->store_id }}" placeholder="Enter Store ID">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Signature KEY</label>
                                        <input type="text" name="signature_key" class="form-control" value="{{ $shurjopay->signature_key }}" placeholder="Enter Signature KEY">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <input type="checkbox" name="status" value="1" {{ $shurjopay->status == 1 ? 'checked' : '' }} id="status2">
                                        <label class="col-form-label" for="status2">Live Server</label><br>
                                        <small style="font-size: 76.5%;">(If checkbox are not checked it working for sandbox only)</small>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-lg-4 p-2">
                        <div class="card-header bg-primary text-light">SSLCommerz Gateway</div>
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $sslcommerz->id }}">
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Store ID</label>
                                        <input type="text" name="store_id" class="form-control" value="{{ $sslcommerz->store_id }}" placeholder="Enter Store ID">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Signature KEY</label>
                                        <input type="text" name="signature_key" class="form-control" value="{{ $sslcommerz->signature_key }}" placeholder="Enter Signature KEY">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <input type="checkbox" name="status" value="1" {{ $sslcommerz->status == 1 ? 'checked' : '' }} id="status3">
                                        <label class="col-form-label" for="status3">Live Server</label><br>
                                        <small style="font-size: 76.5%;">(If checkbox are not checked it working for sandbox only)</small>
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
