@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deleteuser').click(function(e) {
                var uid = $(this).attr('uid');
                if (confirm("Delete User?")) {
                    $.ajax({
                        url: "{{ url('/deleteuser') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            uid: uid
                        },
                        success: function(response) {
                            window.location.href = "/showuser";
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
                <h1>Users Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/adduser" class="btn btn-warning float-right display-block" style="
                            ">Add Users</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped" id="">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($users) && $users->count())
                    @foreach ($users as $user)
                        @if ($user->role_id != 1)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->first_name }}&nbsp; {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($roles as $role)
                                        @if ($role->role_id == $user->role_id)
                                            {{ $role->role_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if ($user->status == '1')
                                        <span class="btn btn-success">Active</span>
                                    @else
                                        <span class="btn btn-warning">InActive</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="/edituser/{{ $user->id }}" class="btn btn-success">Edit</a>
                                    <a href="javascript:void(0)" uid={{ $user->id }}
                                        class="btn btn-danger deleteuser">Delete</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">There is no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div>
        <ul class="pagination pagination-sm float-right">
            {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li> --}}
            <li class="page-item">{{ $users->links() }}</li>
            {{-- <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
            {{-- <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
        </ul>
    </div>
    {{-- {{ $users->links() }} --}}
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
