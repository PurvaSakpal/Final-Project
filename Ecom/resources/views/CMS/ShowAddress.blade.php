@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deleteadd').click(function(e) {
                var aid = $(this).attr('aid');
                if (confirm("Delete Address?")) {
                    $.ajax({
                        url: "{{ url('/cms/deleteaddress') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            aid: aid
                        },
                        success: function(response) {
                            window.location.href = "/cms/showaddress";
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
                <h1>CMS Address Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/cms/addaddress" class="btn btn-warning float-right display-block" style="
                    ">Add Address</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">State</th>
                    <th scope="col">Country</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Fax</th>
                    <th scope="col">Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($address) && $address->count())
                    @foreach ($address as $add)
                        <tr>
                            <td>{{ $add->name }}</td>
                            <td>{{ $add->address1 }},{{ $add->address2 }}</td>
                            <td>{{ $add->state }}</td>
                            <td>{{ $add->country }}</td>
                            <td>{{ $add->mobile }}</td>
                            <td>{{ $add->fax }}</td>
                            <td>{{ $add->email }}</td>
                            <td>
                                <a href="javascript:void(0)" aid="{{ $add->id }}" class="btn btn-danger deleteadd"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="8">There is no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div>
            {{ $address->links() }}
        </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
