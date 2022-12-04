@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Coupon
            </a>
            <div class="table-responsive">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Coupon Code</th>
                            <th class="text-center">Coupon Amount</th>
                            <th class="text-center">Coupon Date</th>
                            <th class="text-center">Status</th>
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
                            <label for="coupon_code" class="col-form-label">Coupon Code:</label>
                            <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                                placeholder="Enter coupon code" required>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-form-label">Coupon Type:</label>
                            <select name="" id="" class="form-control" required>
                                <option value="">Please select</option>
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coupon_amount" class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" name="coupon_amount" id="coupon_amount"
                                placeholder="Enter coupon amount" required>
                        </div>

                        <div class="form-group">
                            <label for="valid_date" class="col-form-label">Valid Date:</label>
                            <input type="date" class="form-control" name="valid_date" id="valid_date" required>
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

        $(function brand(){
            table = $('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('coupon.index') }}",
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'coupon_code', name:'coupon_code'},
                    {data:'coupon_amount', name:'coupon_amount'},
                    {data:'valid_date', name:'valid_date'},
                    {data:'status', name:'status'},
                    {data:'action', name:'action',orderable:true,searchable:true},
                ]
            });
        });

        $('#addForm').on('submit', function(){
            $('.loader').removeClass('d-none');
            $('.save_btn').addClass('d-none');
        });

        // $('body').on('click','#couponDelete', function(e){
        //     e.preventDefault();
        //     let id = $(this).data('id');
        //     // alert(id);

        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         console.log(id);
        //         if (result.isConfirmed) {
        //             document.getElementById('delete-form-'+id).submit();  //custom edit.
        //             Swal.fire(
        //             'Deleted!',
        //             'Your file has been deleted.',
        //             'success'
        //             )
        //         }
        //     });
        //     // $.get("brand/"+id+"/edit", function(data){
        //     //     $('.modal_body').html(data);
        //     // });
        // });

        // $('body').on('submit',"#delete-form-"+id, function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('action');
        //     var request = $(this).serialize();

        //     $.ajax({
        //         url: url,
        //         type: 'post',
        //         data: request,
        //         success: function(data){
        //             $("#delete-form-"+id)[0].reset();
        //             table.ajax.reload();
        //         }
        //     });
        // });





        $('body').on('click','.edit', function(){
            let id = $(this).data('id');
            $.get("brand/"+id+"/edit", function(data){
                $('.modal_body').html(data);
            });
        });
    </script>
@endpush
