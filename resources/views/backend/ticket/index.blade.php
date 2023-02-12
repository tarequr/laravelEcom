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
            <div class="table-responsive">
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
                processing:true,
                serverSide:true,
                ajax:"{{ route('ticket.index') }}",
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
    </script>
@endpush
