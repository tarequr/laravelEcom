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
                </div> --}}

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control submitable">
                </div>

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Status</label>
                    <select name="status" id="status" class="form-control submitable">
                        <option value="">All status</option>
                        <option value="0">Order Pending</option>
                        <option value="1">Order Received</option>
                        <option value="2">Order Shipping</option>
                        <option value="3">Order Done</option>
                        <option value="4">Order Return</option>
                        <option value="5">Order Cancle</option>
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
        $(function product(){
            var table = $('.ytable').DataTable({
                responsive: true,
                processing:true,
                serverSide:true,
                // ajax:"{{ route('product.index') }}",
                ajax: {
                    "url" : "{{ route('order.index') }}",
                    "data" : function(e) {
                        // e.category_id = $("#category_id").val();
                        e.date = $("#date").val();
                        e.status = $("#status").val();
                    }
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
