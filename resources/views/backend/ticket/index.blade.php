@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Brand
            </a> --}}
            <div class="row">
                <div class="col-md-3 p-2">
                    <label class="col-form-label">Service Type</label>
                    <select name="service" id="service" class="form-control submitable">
                        <option value="">All Service</option>
                        <option value="Technical">Technical</option>
                        <option value="Payment">Payment</option>
                        <option value="Affiliate">Affiliate</option>
                        <option value="Return">Return</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Status</label>
                    <select name="status" id="status" class="form-control submitable">
                        <option value="">All status</option>
                        <option value="0">Pending</option>
                        <option value="1">Replied</option>
                        <option value="2">Closed</option>
                    </select>
                </div>

                <div class="col-md-3 p-2">
                    <label class="col-form-label">Date</label>
                    <input type="date" class="form-control submitable" name="date" id="date">
                </div>
            </div>

            <div class="table-responsive mt-2">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Priority</th>
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
        $(function ticket(){
            var table = $('.ytable').DataTable({
                responsive: true,
                processing:true,
                serverSide:true,
                ajax: {
                    "url" : "{{ route('ticket.index') }}",
                    "data" : function(e) {
                        e.service = $("#service").val();
                        e.status = $("#status").val();
                        e.date = $("#date").val();
                    }
                },
                aoColumns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'name', name:'name'},
                    {data:'subject', name:'subject'},
                    {data:'service', name:'service'},
                    {data:'priority', name:'priority'},
                    {data:'date', name:'date'},
                    {data:'status', name:'status'},
                    {data:'action', name:'action',orderable:true,searchable:true},
                ]
            });
        });

        // $('body').on('click','.edit', function(){
        //     let id = $(this).data('id');
        //     $.get("brand/"+id+"/edit", function(data){
        //         $('.modal_body').html(data);
        //     });
        // });

        /*submitable on change*/
        $(document).on('change','.submitable', function(){
            $('.ytable').DataTable().ajax.reload();
        })
    </script>
@endpush
