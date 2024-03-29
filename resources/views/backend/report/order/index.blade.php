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

                <div class="col-md-3 p-2">
                    <button class="btn btn-primary orderPrint" id="orderPrint" style="margin-top: 37px;"><i class="fas fa-print"></i> Order Print</button>
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
    {{-- <script src="{{ asset('backend/js/printThis.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/printThis.js') }}"></script>
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
                ]
            });
        });

        /*submitable on change*/
        $(document).on('change','.submitable', function(){
            $('.ytable').DataTable().ajax.reload();
        })



        $(document).on('click','#orderPrint', function(e){

            // alert('Please select');
            // e.preventDefault(); //
            // $.ajax({
            //     url: "{{ route('order.report.print') }}",
            //     type: 'get',
            //     data: {
            //         date: $("#date").val(),
            //         status: $('#status').val(),
            //         payment_type: $('#payment_type').val()
            //     },
                // success: function(data) {
                //     $(data).printThis({
                //         debug: false,
                //         importCSS: true,
                //         importStyle: true,
                //         removeInline: false,
                //         printDelay: 500,
                //         header: null,
                //         footer: null
                //     });
                // }
            // });

            e.preventDefault(); // prevent default form submission behavior
            $.ajax({
                url: "{{ route('order.report.print') }}",
                type: 'get',
                data: {
                    date: $("#date").val(),
                    status: $('#status').val(),
                    payment_type: $('#payment_type').val()
                },
                success: function(data) {
                    // print the fetched data using the printThis() plugin
                    $(data).printThis({
                        debug: false,
                        importCSS: true,
                        importStyle: true,
                        removeInline: false,
                        printDelay: 500,
                        header: null,
                        footer: null
                    });
                },
                error: function(xhr, status, error) {
                    // handle errors if any
                    console.log("Error: " + error);
                }
            });
        });
    </script>
@endpush
