@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deletebanner').click(function(e) {
                var bid = $(this).attr('bid');
                if (confirm("Delete Banner?")) {
                    $.ajax({
                        url: "{{ url('/banner/deletebanner') }}",
                        method: 'patch',
                        data: {
                            _token: '{{ csrf_token() }}',
                            bid: bid
                        },
                        success: function(response) {
                            window.location.href = "/banner/showbanner";
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    })
                }
            })
            setTimeout(function() {
                $('#successMessage').fadeOut('fast');
            }, 3000);
        })
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>Banners Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/banner/addbanner" class="btn btn-warning float-right display-block" style="
                    ">Add Banner</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($banners) && $banners->count())
                    @foreach ($banners as $banner)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $banner->heading }}</td>
                            <td>{{ $banner->description }}</td>
                            <td><img src="{{ asset('/BannerImages/' . $banner->image) }}" alt="Banner Image" width="150px"
                                    height="150px">
                            </td>
                            <td><a href="/banner/editbanner/{{ $banner->id }}" class="btn btn-success">Edit</a>
                                <a href="javascript:void(0)" bid="{{ $banner->id }}"
                                    class="btn btn-danger deletebanner">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">There is no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="p-4">
            {{ $banners->links() }}
        </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
