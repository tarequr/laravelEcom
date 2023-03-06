@extends('backend.master')

@push('css')

@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal"
                data-target="#addModal">
                <i class="fa fa-plus-circle"></i>
                Create Brand
            </a>
            <div class="table-responsive">
                <table class="table table-bordered ytable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        @php
                            $exist = App\Models\CampaignProduct::where('product_id', $product->id)->where('campaign_id', $campaign_id)->first();
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('upload/product/'.$product->thumbnail) }}" height="50" width="70" >
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->brnad_name }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>
                                @if ($exist)
                                    <button type="button" class="btn btn-sm btn-danger" title="Exist">Exist</button>
                                @else
                                    <a href="{{ route('add.campaign.product',[$product->id,$campaign_id]) }}" class="btn btn-success btn-sm" title="Added To Campaign">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                @endif
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
