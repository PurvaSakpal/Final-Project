@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.deletecat').click(function(e){
            var cid=$(this).attr('cid');
            if(confirm("Delete Category?")){
                $.ajax({
                    url:"{{url('/category/deletecategory')}}",
                    method:'post',
                    data:{_token:'{{ csrf_token()}}',cid:cid},
                    success:function(response){
                        window.location.href="/category/showcategory";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
    })
</script>
<div class="container">
    <a href="/category/addcategory" class="btn btn-warning">Add Category</a>
    <h1>Categories</h1>
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <table class="table table-success table-striped" id="mytable">
        <thead>
          <tr>
            <th scope="col">Sr No.</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($category as $cat)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$cat->name}}</td>
                   <td>{{$cat->description}}</td>
                   <td>
                       <a href="/category/editcategory/{{$cat->id}}" class="btn btn-success">Edit</a>
                       <a href="javascript:void(0)" cid={{$cat->id}} class="btn btn-danger deletecat">Delete</a>
                   </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
