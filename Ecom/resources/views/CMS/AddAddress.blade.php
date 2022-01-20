@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Address') }}</div>
                    <div class="card-body">
                        <form action="{{ route('add.post.address') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address1" class="col-md-4 col-form-label text-md-end">{{ __('Address 1') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <textarea name="address1" class="form-control @error('address1') is-invalid @enderror"
                                        id="address1" cols="30" rows="6" autocomplete="address1"
                                        autofocus>{{ old('address1') }}</textarea>
                                    @error('address1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address2"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address 2') }}</label>
                                <div class="col-md-6">
                                    <textarea name="address2" class="form-control @error('address2') is-invalid @enderror"
                                        id="address2" cols="30" rows="6" autocomplete="address2"
                                        autofocus>{{ old('address2') }}</textarea>
                                    @error('address2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="state" class="col-md-4 col-form-label text-md-end">{{ __('State') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="state" name="state"
                                        class="form-control @error('state') is-invalid @enderror"
                                        value="{{ old('state') }}" autocomplete="state" autofocus>
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="country" name="country"
                                        class="form-control @error('country') is-invalid @enderror"
                                        value="{{ old('country') }}" autocomplete="country" autofocus>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="mobile" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        value="{{ old('mobile') }}" autocomplete="mobile" autofocus>
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="fax" class="col-md-4 col-form-label text-md-end">{{ __('Fax') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="fax" name="fax"
                                        class="form-control @error('fax') is-invalid @enderror" value="{{ old('fax') }}"
                                        autocomplete="fax" autofocus>
                                    @error('fax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Address') }}
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
