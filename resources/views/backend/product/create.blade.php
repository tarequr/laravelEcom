@extends('backend.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .dropify-message .file-icon p{
        font-size: 13px !important;
    }
</style>
@endpush

@section('content')
    <div class="pl-3 pr-3">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9 mb-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="text-center bg-primary p-2">
                                    <h1 class="h4 text-light"><b>Product Create</b></h1>
                                </div>
                                <form class="user" method="POST" action="" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mt-4">
                                        <div class="col-md-7 card">
                                            <div class="form-row">
                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Product Name</label>
                                                    <input type="text" name="meta_title" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Product Code</label>
                                                    <input type="text" name="meta_author" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Category / Sub Category</label>
                                                    <select class="form-control select2" name="subcategory_id" id="category" required>
                                                        <option value="">Please select</option>
                                                        @foreach ($categories as $category)
                                                            @php
                                                                $subCategories = App\Models\SubCategory::where('category_id',$category->id)->get();
                                                            @endphp
                                                            <option value="" disabled class="text-danger">{{ $category->name }}</option>

                                                                @foreach ($subCategories as $subCategor)
                                                                <option value="{{ $subCategor->id }}"> ~~~~~ {{ $subCategor->subcategory_name }}</option>
                                                                @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Child Category</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Brand</label>
                                                    <select name="" id="" class="form-control" required>
                                                        <option value="">Please select</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->brnad_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Pickup</label>
                                                    <select name="" id="" class="form-control" required>
                                                        <option value="">Please select</option>
                                                        @foreach ($pickups as $pickup)
                                                            <option value="{{ $pickup->id }}">{{ $pickup->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Unit</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Tags</label>
                                                    <input type="text" name="tags" class="form-control" data-role="tagsinput">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label class="col-form-label">Purchase Price</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label class="col-form-label">Selling Price</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label class="col-form-label">Discount Price</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Warehouse</label>
                                                    <select name="" id="" class="form-control" required>
                                                        <option value="">Please select</option>
                                                        @foreach ($wareHouses as $ware_house)
                                                            <option value="{{ $ware_house->brnad_name }}">{{ $ware_house->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Stock</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Color</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label class="col-form-label">Size</label>
                                                    <input type="text" name="meta_keyword" class="form-control">
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label class="col-form-label">Product Details</label>
                                                    <textarea name="" cols="30" rows="10" class="form-control" id="summernote"></textarea>
                                                </div>

                                                <div class="form-group col-md-12 mt-4">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-row card p-2">
                                                <div class="form-group col-sm-12">
                                                    <label for="brand_logo" class="col-form-label ">Main Thumbnail:</label>
                                                    <input type="file" class="form-control dropify image" name="brand_logo" id="brand_logo"
                                                        placeholder="Enter brand name" required>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label for="brand_logo" class="col-form-label "></label>
                                                    <table class="table" id="daynamic_table">
                                                        <tr>
                                                            <th colspan="2" style="border: none !important; padding: 0px;">
                                                                <span>More Image:</span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="file" class="form-control image" name="images[]" accept="image/*" required>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-success" name="add" id="add">+</button>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="status" id="status" >
                                                        <label class="custom-control-label" for="status">Featured Product</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="status" id="status1" >
                                                        <label class="custom-control-label" for="status1">Toady Deal</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="status" id="status20" >
                                                        <label class="custom-control-label" for="status20">Status</label>
                                                    </div>
                                                </div>
                                            </div>
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

            var i = 0;
            var max_fileds = 7;

            $('#add').click(function(e){
                e.preventDefault();

                if (i < max_fileds) {
                    $('#daynamic_table').append('<tr id="row'+i+'"><td><input type="file" class="form-control image" name="images[]" accept="image/*" required></td><td><button type="button" class="btn btn-sm btn-danger remove_button" id="'+i+'" name="add" >x</button></td></tr>');
                    i++
                }
            });

            $(document).on('click','.remove_button', function(e){
                e.preventDefault();
                var button_id = $(this).attr('id');
                // alert(button_id);
                $('#row'+button_id+'').remove();
                i--;
            });

            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
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
