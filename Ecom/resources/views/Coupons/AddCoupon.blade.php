@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Coupons') }}
                        <a href="/coupons/showcoupons" class="btn btn-warning float-right">Show Coupons</a>
                    </div>

                    <div class="card-body">
                        {{-- @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif --}}

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                                <script>
                                    $("document").ready(function() {
                                        setTimeout(function() {
                                            $("div.alert").remove();
                                        }, 2000); // 5 secs

                                    });
                                </script>
                            </div>
                        @endif
                        {{-- @if (Session::has('success'))
                <script type="text/javascript">
                    swal({
                        title:'Success!',
                        text:"{{Session::get('success')}}",
                        timer:5000,
                        type:'success'
                    }).then((value) => {
                    //location.reload();
                    }).catch(swal.noop);
                </script>
                @endif --}}

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('add.post.coupon') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Coupon Code') }}<span
                                        class="text-danger ml-2">*</span></label>


                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                        name="code" value="{{ old('code') }}" autocomplete="code" autofocus>

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Coupon Type') }}<span
                                        class="text-danger ml-2">*</span></label>

                                <div class="col-md-6">
                                    <select name="type" id="type" class="form-control @error('code') is-invalid @enderror"
                                        value="{{ old('type') }}" autocomplete="type" autofocus>
                                        <option value="">Select</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
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
                                        name="value" value="{{ old('value') }}" autocomplete="value" autofocus>

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
                                        value="{{ old('cart_value') }}" autocomplete="cart_value" autofocus>

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
                                        {{ __('Add Coupon') }}
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
