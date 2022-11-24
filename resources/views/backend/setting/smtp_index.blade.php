@extends('backend.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-9 mb-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">SMTP Setting</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('setting.smtp.update',$smtpSetting->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Mail Mailer</label>
                                            <input type="text" name="mailer" class="form-control" value="{{ $smtpSetting->mailer }}" placeholder="Enter mail mailer Ex: smtp">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Mail Host</label>
                                            <input type="text" name="host" class="form-control" value="{{ $smtpSetting->host }}" placeholder="Enter mail host Ex: smtp.mailtrap.io">
                                        </div>

                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label">Mail Port</label>
                                            <input type="number" name="port" class="form-control" value="{{ $smtpSetting->port }}" placeholder="Enter mail port Ex: 2525">
                                        </div>

                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label">Mail Username</label>
                                            <input type="text" name="username" class="form-control" value="{{ $smtpSetting->username }}" placeholder="Enter mail username">
                                        </div>

                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label">Mail Password</label>
                                            <input type="text" name="password" class="form-control" value="{{ $smtpSetting->password }}" placeholder="Enter mail password">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
