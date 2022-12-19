@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('product.create') }}" class="btn btn-primary float-right btn-sm mb-3">
                <i class="fa fa-plus-circle"></i>
                Create Product
            </a>

            <div class="row">
                <div class="col-md-3 p-2">
                    <label class="col-form-label">Category</label>
                    <select name="category_id" id="" class="form-control submitable">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Brand</label>
                    <select name="brand_id" id="" class="form-control submitable">
                        <option value="">Select brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brnad_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Status</label>
                    <select name="brand_id" id="" class="form-control submitable">
                        <option value="">Select status</option>
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
                            <th class="text-center">Thumbnail</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">SubCategory</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Featured</th>
                            <th class="text-center">Today Deal</th>
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
                ajax:"{{ route('product.index') }}",
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'thumbnail', name:'thumbnail'},
                    {data:'name', name:'name'},
                    {data:'code', name:'code'},
                    {data:'category_name', name:'category_name'},
                    {data:'subcategory_name', name:'subcategory_name'},
                    {data:'brnad_name', name:'brnad_name'},
                    {data:'featured', name:'featured'},
                    {data:'toady_deal_id', name:'toady_deal_id'},
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
