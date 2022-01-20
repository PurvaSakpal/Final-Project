@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Banner') }}
                        <a href="{{ route('show.banner') }}" class="btn btn-warning float-right">Show Banners</a>
                    </div>
                    <div class="card-body">
                        <form action="postaddBanner" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="heading" class="col-md-4 col-form-label text-md-end">{{ __('Heading') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="heading" name="heading"
                                        class="form-control @error('heading') is-invalid @enderror"
                                        value="{{ old('heading') }}" autocomplete="heading" autofocus>
                                    @error('heading')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea name="description"
                                        class="form-control @error('description') is-invalid @enderror" id="description"
                                        cols="30" rows="6" autocomplete="description"
                                        autofocus>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputImage3" class="col-md-4 col-form-label text-md-end">Image<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                        id="inputImage3" name="image" autocomplete="image" autofocus>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Banner') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 offset-md-4">
                                    <p class="text-success"><span class="text-danger ml-1"><b>*</b></span> fields are
                                        required</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
