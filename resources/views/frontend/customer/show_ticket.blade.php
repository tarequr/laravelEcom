@extends('frontend.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_responsive.css') }}">
@endpush

@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('frontend.customer.customer_sidebar')
            </div>

            <div class="col-md-8">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ asset('upload/ticket/'.$ticket->image) }}" target="_blank">
                                <img src="{{ asset('upload/ticket/'.$ticket->image) }}" alt="" style="width: 120px; height: 80px;">
                            </a>
                        </div>
                        <div class="col-md-9">
                            <h3>Your ticket details.</h3>
                            <span><strong>Subject:</strong> {{ $ticket->subject }}</span><br>
                            <span><strong>Service:</strong> {{ $ticket->service }}</span><br>
                            <span><strong>Priority:</strong> {{ $ticket->priority }}</span><br>
                            <span><strong>Message:</strong> {{ $ticket->message }}</span><br>
                        </div>
                    </div>
                </div>

                @php
                    $ticket_repleis = App\Models\TicketReply::where('ticket_id',$ticket->id)->orderBy('id','desc')->get();
                @endphp

                <div class="card p-2 mt-2">
                    <strong>All Reply Message</strong><br>
                    <div class="card-body" style="height: 450px; overflow-y: scroll;">
                        @isset($ticket_repleis)
                            @foreach ($ticket_repleis as $ticket_reply)
                                @if ($ticket_reply->user_id != 1)
                                    <div class="card mt-1">
                                        <div class="card-header bg-primary">
                                            <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                            <p>{{ $ticket_reply->message }}</p>
                                            <footer class="blockquote-footer">{{ date('d-M-Y', strtotime($ticket_reply->reply_date)) }}</footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                @else
                                    <div class="card mt-1 ml-4">
                                        <div class="card-header bg-success">
                                            <span style="float: right"><i class="fa fa-user"></i> Admin</span>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                            <p>{{ $ticket_reply->message }}</p>
                                            <footer class="blockquote-footer">{{ date('d-M-Y', strtotime($ticket_reply->reply_date)) }}</footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endisset
                    </div>
                </div>

                <div class="card">
                    <div class="card-body mt-2">
                        <strong>Reply Message.</strong><br>
                        <div>
                            <form action="{{ route('customer.reply.ticket') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Type here..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('frontend/js/contact_custom.js') }}"></script>
@endpush
