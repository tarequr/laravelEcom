@extends('backend.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-9 mb-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Website Setting</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('setting.website.update',$websiteSetting->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Currency</label>
                                            <select name="currency" id="" class="form-control">
                                                <option value="">Please select</option>
                                                <option value="৳" {{ $websiteSetting->currency == "৳" ? "selected" : "" }}>Taka ৳</option>
                                                <option value="$" {{ $websiteSetting->currency == "$" ? "selected" : "" }}>USD $</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Phone One</label>
                                            <input type="text" name="phone_one" class="form-control" value="{{ $websiteSetting->phone_one }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Phone Two</label>
                                            <input type="text" name="phone_two" class="form-control" value="{{ $websiteSetting->phone_two }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Main Email</label>
                                            <input type="text" name="main_email" class="form-control" value="{{ $websiteSetting->main_email }}">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Support Email</label>
                                            <input type="text" name="support_email" class="form-control" value="{{ $websiteSetting->support_email }}">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Address</label>
                                            <textarea class="form-control" name="address" rows="3">{{ $websiteSetting->address }}</textarea>
                                        </div>

                                        <div class="form-group col-sm-12" style="margin: 0px">
                                            <b>Logo & Favicon</b>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Logo</label>
                                            <input type="file" name="logo" class="form-control">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Favicon</label>
                                            <input type="file" name="favicon" class="form-control">
                                        </div>

                                        <div class="form-group col-sm-12" style="margin: 0px">
                                            <b>Social Media</b>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Facebook</label>
                                            <input type="text" name="facebook" class="form-control" value="{{ $websiteSetting->facebook }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Twitter</label>
                                            <input type="text" name="twitter" class="form-control" value="{{ $websiteSetting->twitter }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Instagram</label>
                                            <input type="text" name="instagram" class="form-control" value="{{ $websiteSetting->instagram }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Linkedin</label>
                                            <input type="text" name="linkedin" class="form-control" value="{{ $websiteSetting->linkedin }}">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Youtube</label>
                                            <input type="text" name="youtube" class="form-control" value="{{ $websiteSetting->youtube }}">
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
    </div>
@endsection
