@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deletebannerimg').click(function(e) {
                var bid = $(this).attr('bid');
                if (confirm("Delete Banner Image?")) {
                    $.ajax({
                        url: "{{ url('/cms/deletebannerimage') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            bid: bid
                        },
                        success: function(response) {
                            window.location.href = "/cms/showbannerimage";
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
                <h1>CMS Banner Images Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/cms/addbannerimage" class="btn btn-warning float-right display-block" style="
                    ">Add Banner Image</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($banner) && $banner->count())
                    @foreach ($banner as $bann)
                        <tr>
                            <td>
                                <img src="{{ asset('/CMSImage/' . $bann->image) }}" alt="Banner Image" width="800px"
                                    height="150px">
                            </td>
                            <td>
                                <a href="javascript:void(0)" bid="{{ $bann->id }}"
                                    class="btn btn-danger deletebannerimg"><i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
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
        <div>
            {{ $banner->links() }}
        </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
