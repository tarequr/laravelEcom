@extends('backend.master')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Brand
            </a>
            <div class="table-responsive">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Logo</th>
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
                <form method="POST" action="{{ route('brand.store') }}" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brnad_name" class="col-form-label">Brand:</label>
                            <input type="text" class="form-control" name="brnad_name" id="brnad_name"
                                placeholder="Enter brand name" required>
                        </div>

                        <div class="form-group">
                            <label for="brand_logo" class="col-form-label ">Brand Logo:</label>
                            <input type="file" class="form-control dropify" name="brand_logo" id="brand_logo"
                                placeholder="Enter brand name" required>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
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

        $(function brand(){
            var table = $('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('brand.index') }}",
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'brnad_name', name:'brnad_name'},
                    {data:'brand_logo', name:'brand_logo', render: function(data, type, full, meta){
                        return "<img src=\""+data+"\" height=\"30\" />";
                    }},
                    {data:'action', name:'action',orderable:true,searchable:true},
                ]
            });
        });

        $('body').on('click','.edit', function(){
            let id = $(this).data('id');
            $.get("childcategory/"+id+"/edit", function(data){
                $('.modal_body').html(data);
            });
        });

        $('.dropify').dropify();
    </script>
@endpush
