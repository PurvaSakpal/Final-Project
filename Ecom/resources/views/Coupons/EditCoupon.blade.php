@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Coupons') }}
                        <a href="/coupons/showcoupons" class="btn btn-warning float-right">Show Coupons</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('edit.post.coupon') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $coupon->id }}">
                            <div class="row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Coupon Code') }}<span
                                        class="text-danger ml-2">*</span></label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                        name="code" value="{{ $coupon->code }}" autocomplete="code" autofocus>

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Coupon Type') }}</label>

                                <div class="col-md-6">
                                    <select name="type" id="type" class="form-control @error('code') is-invalid @enderror"
                                        autocomplete="type" autofocus>
                                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : ' ' }}>Fixed
                                        </option>
                                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : ' ' }}>
                                            Percent</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="value"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Coupon Value') }}<span
                                        class="text-danger ml-2">*</span></label>


                                <div class="col-md-6">
                                    <input id="value" type="text" class="form-control @error('value') is-invalid @enderror"
                                        name="value" value="{{ $coupon->value }}" autocomplete="value" autofocus>

                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cart_value"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Cart Value') }}<span
                                        class="text-danger ml-2">*</span></label>


                                <div class="col-md-6">
                                    <input id="cart_value" type="text"
                                        class="form-control @error('cart_value') is-invalid @enderror" name="cart_value"
                                        value="{{ $coupon->cart_value }}" autocomplete="cart_value" autofocus>

                                    @error('cart_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Coupon') }}
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
