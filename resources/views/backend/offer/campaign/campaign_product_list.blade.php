@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3>Campaign: {{ $campaign->title }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campaignProducts as $campaignProduct)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('upload/product/'.$campaignProduct->product->thumbnail) }}" height="50" width="70" >
                            </td>
                            <td>{{ $campaignProduct->product->name }}</td>
                            <td>{{ $campaignProduct->product->code }}</td>
                            <td>{{ $campaignProduct->product->selling_price }}</td>
                            <td>
                                <button type="button" onclick="deleteData({{ $campaignProduct->id }})" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                    <span>Delete</span>
                                </button>

                                <form id="delete-form-{{ $campaignProduct->id }}" method="POST" action="{{ route('campaign.product.destroy',$campaignProduct->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
