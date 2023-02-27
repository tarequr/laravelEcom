@extends('backend.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="#" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Category
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Blog Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blog_categories as $key => $blog_category)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $blog_category->name }}</td>
                                <td class="text-center">
                                    @if ($blog_category->status == '1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">InActive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-success btn-sm edit" title="Edit" data-toggle="modal" data-target="#editModal" data-id="{{ $blog_category->id }}">
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </a>

                                    <button type="button" onclick="deleteData({{ $blog_category->id }})" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $blog_category->id }}" method="POST" action="{{ route('blog-category.destroy',$blog_category->id) }}" style="display: none;">
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
                <form method="POST" action="{{ route('blog-category.store') }}" id="myform">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cat_name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="cat_name" placeholder="Enter blog category name" required>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
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
                <form method="POST" action="{{ route('category.update',1) }}" class="formData" id="myform">
                    @csrf

                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="category_name"
                                placeholder="Enter category name" required>
                            <input type="hidden"  name="category_id" id="category_id">
                        </div>

                        <div class="form-group">
                            <label for="icon" class="col-form-label">Icon: (<code>Class Name</code>)</label>
                            <input type="text" class="form-control" name="icon" id="category_icon" placeholder="Enter category icon" required>
                        </div>

                        <div class="form-group">
                            <label for="home_page" class="col-form-label">Home Page:</label>
                            <select name="home_page" id="home_page" class="form-control home_page" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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
                let id = $(this).data('id');
                $.get("category/"+id+"/edit", function(data){
                    // console.log(data);
                    $('#category_name').val(data.name);
                    $('#category_icon').val(data.icon);
                    // if (data.home_page == 1) {
                    //     $('.home_page option[value="1"]').attr('selected', true)
                    // } else if (data.home_page == 0){
                    //     $('.home_page option[value="0"]').attr('selected', true)
                    // }
                    $('#category_id').val(data.id);
                });
            });
        });
    </script>
@endpush
