@extends('backend.master')

@section('title')
    Create PDF
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <a href="#" class="btn btn-primary float-right btn-sm">
                    <i class="fa fa-list"></i>
                    Manage PDF</a>
            </div>
        </div>
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add PDF!</h1>
                                    </div>
                                    <form class="user" method="POST" action="#"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title"
                                                    class="form-control @error('title') is-invalid @enderror">

                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="description" rows="3"></textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">PDF</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="file_name" id="file_name"
                                                    class="form-control @error('file_name') is-invalid @enderror">

                                                @error('file_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select name="status" id=""
                                                    class="form-control @error('status') is-invalid @enderror">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>

                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <input type="submit" name="btn"
                                                    class="btn btn-primary btn-user btn-block" value="Save">
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
    </div>
@endsection
