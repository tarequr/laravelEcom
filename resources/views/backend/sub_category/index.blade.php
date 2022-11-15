@extends('backend.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Sub Category
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Sub Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_categories as $key => $subcategory)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $subcategory->category->name }}</td>
                                <td class="text-center">{{ $subcategory->subcategory_name }}</td>
                                <td class="text-center">
                                    @if ($subcategory->status == '1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">InActive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- {{ route('category.edit', $category->id) }} --}}
                                    <a href="#" class="btn btn-success btn-sm edit" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{ $subcategory->id }}">
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </a>

                                    <button type="button" onclick="deleteData({{ $subcategory->id }})" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $subcategory->id }}" method="POST" action="{{ route('subcategory.destroy',$subcategory->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
                <form method="POST" action="{{ route('subcategory.store') }}" id="myform">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category" class="col-form-label">Category:</label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="">please select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subcategory_name" class="col-form-label">Sub Category:</label>
                            <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                                placeholder="Enter sub category name" required>
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
        $(document).ready(function() {
            // $('#myform').validate({
            //     rules: {
            //         name: {
            //             required: true
            //         }
            //     }
            // });

            $('body').on('click','.edit', function(){
                let subcat_id = $(this).data('id');
                $.get("subcategory/"+subcat_id+"/edit", function(data){
                    $('.modal_body').html(data);
                });
            });
        });
    </script>
@endpush
