@extends('backend.master')

@section('title')
    Create PDF
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-9 mb-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">SEO Setting</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('setting.seo.update',$seo_setting->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" value="{{ $seo_setting->meta_title }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Meta Author</label>
                                            <input type="text" name="meta_author" class="form-control" value="{{ $seo_setting->meta_author }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Meta Tag</label>
                                            <input type="text" name="meta_tag" class="form-control" value="{{ $seo_setting->meta_tag }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Meta Keyword</label>
                                            <input type="text" name="meta_keyword" class="form-control" value="{{ $seo_setting->meta_keyword }}">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Meta Description</label>
                                            <textarea class="form-control" name="meta_description" rows="3">{{ $seo_setting->meta_description }}</textarea>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <b>Other's Options</b>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Google Verification</label>
                                            <input type="text" name="google_verification" class="form-control" value="{{ $seo_setting->google_verification }}">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label">Alexa Verification</label>
                                            <input type="text" name="alexa_verification" class="form-control" value="{{ $seo_setting->alexa_verification }}">
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Google Analytics</label>
                                            <textarea class="form-control" name="google_analytics" rows="3">{{ $seo_setting->google_analytics }}</textarea>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Google Adsense</label>
                                            <textarea class="form-control" name="google_adsense" rows="3">{{ $seo_setting->google_adsense }}</textarea>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <button type="submit" class="btn btn-primary">Save</button>
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
