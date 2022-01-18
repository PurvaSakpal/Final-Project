@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
    <h1 class="mb-3">Contact Form Details</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" id="successMessage">{{Session::get('success')}}</div>
    @endif
    <table class="table table-success table-striped" id="mytable">
        <thead>
          <tr>
            <th scope="col">Sr No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($contactus as $contact)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$contact->name}}</td>
                   <td>{{$contact->emai}}</td>
                   <td>{{$contact->subject}}</td>
                   <td>{{$contact->message}}</td>
                   <td>
                       <a href="javascript:void(0)" class="btn btn-primary deleteuser">Reply</a>
                   </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
