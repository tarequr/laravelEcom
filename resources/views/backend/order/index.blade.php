@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 p-2">
                    <label class="col-form-label">Payment Type</label>
                    <select name="payment_type" id="payment_type" class="form-control submitable">
                        <option value="">All payment type</option>
                        <option value="hand_cash">Hand Cash</option>
                        <option value="aamarpay">Aamarpay</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>

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
                            <th class="text-center">Subtotal ({{ $setting->currency }})</th>
                            <th class="text-center">Total ({{ $setting->currency }})</th>
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

    <!-- Show Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel"><strong>Order Details</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="show_modal_body">

                </div>
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
                ajax: {
                    "url" : "{{ route('order.index') }}",
                    "data" : function(e) {
                        e.payment_type = $("#payment_type").val();
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

        /*submitable on change*/
        $(document).on('change','.submitable', function(){
            $('.ytable').DataTable().ajax.reload();
        })

        $('body').on('click','.edit', function(){
            let id = $(this).data('id');
            $.get("order/"+id+"/edit", function(data){
                console.log(data);
                $('.modal_body').html(data);
            });
        });

        $('body').on('click','.show', function(){
            let id = $(this).data('id');
            $.get("order/"+id+"/details", function(data){
                console.log(data);
                $('.show_modal_body').html(data);
            });
        });
    </script>
@endpush
