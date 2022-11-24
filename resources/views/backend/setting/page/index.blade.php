@extends('backend.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('page.create') }}" class="btn btn-primary float-right btn-sm mb-3">
                <i class="fa fa-plus-circle"></i>
                Create Page
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Page Position</th>
                            <th class="text-center">Page Name</th>
                            <th class="text-center">Page Title</th>
                            <th class="text-center">Page Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $page->page_position }}</td>
                                <td class="text-center">{{ $page->page_name }}</td>
                                <td class="text-center">{{ $page->page_title }}</td>
                                <td class="text-center">{{ $page->page_description }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-success btn-sm edit" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{ $page->id }}">
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </a>

                                    <button type="button" onclick="deleteData({{ $page->id }})" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $page->id }}" method="POST" action="{{ route('page.destroy',$page->id) }}" style="display: none;">
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
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script>
    </script>
@endpush
