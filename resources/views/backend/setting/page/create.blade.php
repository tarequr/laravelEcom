@extends('backend.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-9">
                <a href="{{ route('page.index') }}" class="btn btn-primary float-right btn-sm mb-3">
                    <i class="fa fa-list"></i>
                     View Page
                </a>
            </div>
            <div class="col-xl-11 col-lg-12 col-md-9 mb-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Page Setting</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('page.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Page Position</label>
                                            <select name="page_position" id="" class="form-control">
                                                <option value="">Please select</option>
                                                <option value="1">Line One</option>
                                                <option value="2">Line Two</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Page Name</label>
                                            <input type="text" name="page_name" class="form-control" placeholder="Enter page name">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Page Title</label>
                                            <input type="text" name="page_title" class="form-control" placeholder="Enter page title">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Page Description</label>
                                            <textarea class="form-control" id="summernote" name="page_description" rows="10"></textarea>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <button type="submit" class="btn btn-primary">Save</button>
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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Type here...',
            tabsize: 2,
            height: 120,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endpush
