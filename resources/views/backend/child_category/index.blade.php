@extends('backend.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Child Category
            </a>
            <div class="table-responsive">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Sub Category</th>
                            <th class="text-center">Child Category</th>
                            {{-- <th class="text-center">Status</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('childcategory.store') }}" id="addForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category" class="col-form-label">Category / Sub Category:</label>
                            <select class="form-control select2" name="subcategory_id" id="category" required>
                                <option value="">Please select</option>
                                @foreach ($categories as $category)
                                    @php
                                        $subCategories = App\Models\SubCategory::where('category_id',$category->id)->get();
                                    @endphp
                                    <option value="" disabled>{{ $category->name }}</option>

                                        @foreach ($subCategories as $subCategor)
                                        <option value="{{ $subCategor->id }}"> ~~~~~ {{ $subCategor->subcategory_name }}</option>
                                        @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="childcategory_name" class="col-form-label">Child Category:</label>
                            <input type="text" class="form-control" name="childcategory_name" id="childcategory_name"
                                placeholder="Enter child category name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     // $('#myform').validate({
        //     //     rules: {
        //     //         name: {
        //     //             required: true
        //     //         }
        //     //     }
        //     // });

        //     $('body').on('click','.edit', function(){
        //         let subcat_id = $(this).data('id');
        //         $.get("subcategory/"+subcat_id+"/edit", function(data){
        //             $('.modal_body').html(data);
        //         });
        //     });
        // });

        $(function childCategory(){
            var table = $('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('childcategory.index') }}",
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'name', name:'name'},
                    {data:'subcategory_name', name:'subcategory_name'},
                    {data:'childcategory_name', name:'childcategory_name'},
                    {data:'action', name:'action',orderable:true,searchable:true},
                ]
            });
        });
    </script>
@endpush
