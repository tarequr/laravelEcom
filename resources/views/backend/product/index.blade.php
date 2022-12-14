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
            <div class="table-responsive">
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
                    <tbody>

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

        $(function product(){
            var table = $('.ytable').DataTable({
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

        $('body').on('click','.deactive_featured', function(){
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
                    table.ajax.reload();
                }
            })
        });

        $('body').on('click','.active_featured', function(){
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
                    table.ajax.reload();
                }
            })
        });
    </script>
@endpush
