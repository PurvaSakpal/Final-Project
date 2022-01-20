{{-- <!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
</head>
<body>
This is the custom 404 error page.
<div>
@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
</body>
</html> --}}
@extends('layouts.app')

@section('content')

    <div class="conontainer">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">{{ __('Error') }}</div>

                <div class="card-body">
                    <h1>Something went wrong</h1>
                    <b class="text-center">404 Error</b>

                </div>
            </div>
        </div>
    </div>
@endsection
