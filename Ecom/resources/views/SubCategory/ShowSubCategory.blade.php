@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delsubcat').click(function(e) {
                var scid = $(this).attr('scid');
                if (confirm("Delete Sub-Category?")) {
                    $.ajax({
                        url: "{{ url('/subcategory/deletesubcategory') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            scid: scid
                        },
                        success: function(response) {
                            window.location.href = "/subcategory/showsubcategory";
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
                <h1>Sub-Categories Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/subcategory/addsubcategory" class="btn btn-warning float-right display-block" style="
                ">Add Sub-Category</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <table class="table table-striped" id="mytable">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($subcategory) && $subcategory->count())

                    @foreach ($subcategory as $subcat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subcat->name }}</td>
                            <td>
                                @foreach ($category as $cat)
                                    @if ($cat->id == $subcat->category_id)
                                        {{ $cat->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $subcat->description }}</td>
                            <td>
                                <a href="/subcategory/editsubcategory/{{ $subcat->id }}" class="btn btn-success">Edit</a>
                                <a href="javascript:void(0)" scid={{ $subcat->id }}
                                    class="btn btn-danger delsubcat">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">There is no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
    <div>
        {{ $subcategory->links() }}
    </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
