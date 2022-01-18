@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.delsubcat').click(function(e){
            var scid=$(this).attr('scid');
            if(confirm("Delete Sub-Category?")){
                $.ajax({
                    url:"{{url('/subcategory/deletesubcategory')}}",
                    method:'post',
                    data:{_token:'{{ csrf_token()}}',scid:scid},
                    success:function(response){
                        alert(response)
                        window.location.href="/subcategory/showsubcategory";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
    })
</script>
<div class="container">
    <a href="/subcategory/addsubcategory" class="btn btn-warning">Add Sub-Category</a>
    <h1>Sub-Categories</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <table class="table table-success table-striped" id="mytable">
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
            @foreach ($subcategory as $subcat)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$subcat->name}}</td>
                   <td>
                   @foreach ($category as $cat)
                       @if ($cat->id == $subcat->category_id)
                           {{$cat->name}}
                       @endif
                   @endforeach
                    </td>
                   <td>{{$subcat->description}}</td>
                   <td>
                       <a href="/subcategory/editsubcategory/{{$subcat->id}}" class="btn btn-success">Edit</a>
                       <a href="javascript:void(0)" scid={{$subcat->id}} class="btn btn-danger delsubcat">Delete</a>
                   </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
