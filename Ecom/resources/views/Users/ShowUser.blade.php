@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.deleteuser').click(function(e){
            var uid=$(this).attr('uid');
            if(confirm("Delete User?")){
                $.ajax({
                    url:"{{url('/deleteuser')}}",
                    method:'post',
                    data:{_token:'{{ csrf_token()}}',uid:uid},
                    success:function(response){
                        alert(response)
                        window.location.href="/showuser";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 3000);
    })
</script>
<div class="container">
    <a href="/adduser" class="btn btn-warning">Add Users</a>
    <h1>Users Here</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" id="successMessage">{{Session::get('success')}}</div>
    @endif
    <table class="table table-success table-striped" id="mytable">
        <thead>
          <tr>
            <th scope="col">Sr No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$user->first_name}}&nbsp; {{$user->last_name}}</td>
                   <td>{{$user->email}}</td>
                   <td>
                       @foreach ($roles as $role)
                           @if ($role->role_id == $user->role_id)
                               {{$role->role_name}}
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
                       <a href="/edituser/{{$user->id}}" class="btn btn-success">Edit</a>
                       <a href="javascript:void(0)" uid={{$user->id}} class="btn btn-danger deleteuser">Delete</a>
                   </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
