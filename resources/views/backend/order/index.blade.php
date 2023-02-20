@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-md-3 p-2">
                    <label class="col-form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control submitable">
                        <option value="">All category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control submitable">
                        <option value="">All brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brnad_name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Status</label>
                    <select name="status" id="status" class="form-control submitable">
                        <option value="">All status</option>
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    </select>
                </div>
            </div>


            <div class="table-responsive mt-2">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Payment Type</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
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

        // $('.ytable').DataTable({
        //     responsive: true,
        // });

        $(function product(){
            var table = $('.ytable').DataTable({
                responsive: true,
                processing:true,
                serverSide:true,
                // ajax:"{{ route('product.index') }}",
                ajax: {
                    "url" : "{{ route('order.index') }}",
                    // "data" : function(e) {
                    //     e.category_id = $("#category_id").val();
                    //     e.brand_id = $("#brand_id").val();
                    //     e.status = $("#status").val();
                    // }
                },
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'c_name', name:'c_name'},
                    {data:'c_email', name:'c_email'},
                    {data:'c_phone', name:'c_phone'},
                    {data:'subtotal', name:'subtotal'},
                    {data:'total', name:'total'},
                    {data:'payment_type', name:'payment_type'},
                    {data:'date', name:'date'},
                    {data:'status', name:'status'},
                    {data:'action', name:'action',orderable:true,searchable:true},
                ]
            });
        });


        //featured
        $('body').on('click','.deactive_featured', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ url('not-featured') }}/"+id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Poduct Featured Deactive Successfully.',
                        position: 'topRight'
                    });
                    $('.ytable').DataTable().ajax.reload();
                }
            })
        });

        $('body').on('click','.active_featured', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ url('active-featured') }}/"+id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Poduct Featured Active Successfully.',
                        position: 'topRight'
                    });
                    $('.ytable').DataTable().ajax.reload();
                }
            })
        });

        //toadydeal
        $('body').on('click','.deactive_toadydeal', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ url('not-toadydeal') }}/"+id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Poduct Toady Deal Deactive Successfully.',
                        position: 'topRight'
                    });
                    $('.ytable').DataTable().ajax.reload();
                }
            })
        });

        $('body').on('click','.active_toadydeal', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ url('active-toadydeal') }}/"+id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Poduct Toady Deal Active Successfully.',
                        position: 'topRight'
                    });
                    $('.ytable').DataTable().ajax.reload();
                }
            })
        });

        //status
        $('body').on('click','.deactive_status', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ url('not-status') }}/"+id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Poduct Status Deactive Successfully.',
                        position: 'topRight'
                    });
                    $('.ytable').DataTable().ajax.reload();
                }
            })
        });

        $('body').on('click','.active_status', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ url('active-status') }}/"+id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data){
                    iziToast.success({
                        title: 'Success',
                        message: 'Poduct Status Active Successfully.',
                        position: 'topRight'
                    });
                    $('.ytable').DataTable().ajax.reload();
                }
            })
        });

        /*submitable on change*/
        $(document).on('change','.submitable', function(){
            $('.ytable').DataTable().ajax.reload();
        })
    </script>
@endpush
