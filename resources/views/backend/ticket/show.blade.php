@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="pl-3 pr-3">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9 mb-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <h4><strong>Show Ticket</strong></h4>
                                <div class="card p-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ asset('upload/ticket/'.$ticket->image) }}" target="_blank">
                                                <img src="{{ asset('upload/ticket/'.$ticket->image) }}" alt="" style="width: 120px; height: 80px;">
                                            </a>
                                        </div>
                                        <div class="col-md-9">
                                            <h3>Your ticket details.</h3>
                                            <span><strong>User:</strong> {{ $ticket->user->name }}</span><br>
                                            <span><strong>Subject:</strong> {{ $ticket->subject }}</span><br>
                                            <span><strong>Service:</strong> {{ $ticket->service }}</span><br>
                                            <span><strong>Priority:</strong> {{ $ticket->priority }}</span><br>
                                            <span><strong>Message:</strong> {{ $ticket->message }}</span><br>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Reply Ticket Message</div>
                                            <div class="card-body">
                                                <form class="user" method="POST" action="{{ route('ticket.reply') }}" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                                    <div class="form-group">
                                                        <label class="col-form-label">Message</label>
                                                        <textarea name="message" id="" class="form-control" cols="30" rows="5" required placeholder="Type here..."></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Image</label>
                                                        <input type="file" class="form-control dropify image" name="image" id="image" data-height="150" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">All Replies</div>
                                            <div class="card-body" style="height: 500px; overflow-y: scroll;">
                                                <div class="card mt-1">
                                                    <div class="card-header">
                                                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                                    </div>
                                                    <div class="card-body">
                                                        <blockquote class="blockquote mb-0">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                                        </blockquote>
                                                    </div>
                                                </div>

                                                <div class="card mt-1 ml-4">
                                                    <div class="card-header">
                                                        <span style="float: right"><i class="fa fa-user"></i> Admin</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <blockquote class="blockquote mb-0">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
