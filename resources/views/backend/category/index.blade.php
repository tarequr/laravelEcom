@extends('backend.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Category
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">
                                    @if ($category->status == '1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">InActive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm"
                                        title="Edit">
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </a>
                                    <a href="{{ route('category.destroy', $category->id) }}" class="btn btn-danger btn-sm"
                                        title="Delete" onclick="return confirm('Are you sure to delete?')">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cat_name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="cat_name"
                                placeholder="Enter category name">
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
    <script>

    </script>
@endpush
