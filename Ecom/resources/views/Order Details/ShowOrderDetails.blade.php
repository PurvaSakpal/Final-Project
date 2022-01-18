@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <h1>Orders</h1>
    <table class="table table-success table-striped" id="mytable">
        <thead>
          <tr>
            <th scope="col">Sr No.</th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Mobile No</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @foreach ($user->useraddress as $useradd)

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$useradd->email}}</td>
                    <td>{{$useradd->first_name}}&nbsp;{{$useradd->last_name}}</td>
                    <td>{{$useradd->mobile_no}}</td>
                    <td>{{$useradd->address1}}</td>
                    <td>
                        <a href="/order/orderinfo/{{$useradd->id}}" class="btn btn-warning">View</a>
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
