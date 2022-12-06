@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="#" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Pickup
            </a>
            <div class="table-responsive">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Pickup Name</th>
                            <th class="text-center">Pickup Address</th>
                            <th class="text-center">Pickup Phone</th>
                            <th class="text-center">Pickup Phone 2</th>
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
                <form method="POST" action="{{ route('pickup.store') }}" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Pickup Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter pickup name" required>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-form-label">Pickup Address:</label>
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="Enter pickup address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-form-label">Pickup Phone:</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Enter pickup phone" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_two" class="col-form-label">Pickup Phone Two:</label>
                            <input type="text" class="form-control" name="phone_two" id="phone_two"
                                placeholder="Enter pickup phone two" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="d-none loader"><i class="fas fa-spinner"></i> Loading...</span>
                            <span class="save_btn">Save</span>
                        </button>
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

        $('body').on('submit',"#addForm", function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();

            $.ajax({
                url: url,
                type: 'post',
                async: false,
                data: request,
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Pickup created successfully.',
                        position: 'topRight'
                    });

                    $("#addForm")[0].reset();
                    // $("#addModal").fadeOut();
                    $("#addModal").modal('hide');
                    table.ajax.reload();
                }
            });
        });




        $(function brand(){
            table = $('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('pickup.index') }}",
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'name', name:'name'},
                    {data:'address', name:'address'},
                    {data:'phone', name:'phone'},
                    {data:'phone_two', name:'phone_two'},
                    {data:'action', name:'action',orderable:true,searchable:true},
                ]
            });
        });

        // $('#addForm').on('submit', function(){
        //     $('.loader').removeClass('d-none');
        //     $('.save_btn').addClass('d-none');
        // });

        // $(document).ready(function() {
        //     $('body').on('click','#couponDelete', function(e){
        //         e.preventDefault();
        //         let id = $(this).data('id');
        //         // alert(id);

        //         Swal.fire({
        //             title: 'Are you sure?',
        //             text: "You won't be able to revert this!",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Yes, delete it!'
        //         }).then((result) => {
        //             console.log(id);
        //             if (result.isConfirmed) {
        //                 document.getElementById('delete-form-'+id).submit();  //custom edit.
        //                 Swal.fire(
        //                 'Deleted!',
        //                 'Your file has been deleted.',
        //                 'success'
        //                 )
        //             }
        //         });
        //     });

        //     $('body').on('submit',"#delete-form-"+id, function(e){
        //         e.preventDefault();
        //         var url = $(this).attr('action');
        //         var request = $(this).serialize();

        //         $.ajax({
        //             url: url,
        //             type: 'post',
        //             async: false,
        //             data: request,
        //             success: function(data){
        //                 iziToast.success({
        //                     title: 'Success',
        //                     message: 'Coupon created successfully.',
        //                     position: 'topRight'
        //                 });
        //                 $("#delete-form-"+id)[0].reset();
        //                 table.ajax.reload();
        //             }
        //         });
        //     });


        // });





        //show edit page
        $('body').on('click','.edit', function(){
            let id = $(this).data('id');
            $.get("pickup/"+id+"/edit", function(data){
                $('.modal_body').html(data);
            });
        });

        //update data
        $('body').on('submit',"#editForm", function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();

            $.ajax({
                url: url,
                type: 'post',
                async: false,
                data: request,
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Coupon created successfully.',
                        position: 'topRight'
                    });

                    $("#editForm")[0].reset();
                    // $("#addModal").fadeOut();
                    $("#editModal").modal('hide');
                    table.ajax.reload();
                }
            });
        });
    </script>
@endpush
