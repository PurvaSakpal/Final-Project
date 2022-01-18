@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.deleteproduct').click(function(e){
            var pid=$(this).attr('pid');
            if(confirm("Delete product?")){
                $.ajax({
                    url:"{{url('/products/deleteproduct')}}",
                    method:'post',
                    data:{_token:'{{ csrf_token()}}',pid:pid},
                    success:function(response){
                        alert(response)
                        window.location.href="/products/showproducts";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
    })
</script>
<div class="container">
    <a href="/products/addproduct" class="btn btn-warning">Add Product</a>
    <h1>Products</h1>
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if (Session::has('errors'))
        <div class="alert alert-success">{{Session::get('errors')}}</div>
    @endif
    <table class="table table-success table-striped" id="mytable">
        <thead>
          <tr>
            <th scope="col">Sr No.</th>
            <th scope="col">Product Name</th>
            <th scope="col">Sub-Category</th>
            <th scope="col">Color</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$product->name}}</td>
                   <td>
                    @foreach ($subcategory as $subcat)
                        @if ($subcat->id == $product->sub_category_id)
                            {{$subcat->name}}
                        @endif
                    @endforeach
                    </td>
                   <td>
                    @foreach ($assoc as $ass)
                    @if ($ass->product_id == $product->id)
                        {{$ass->color}}
                    @endif
                @endforeach
                    </td>
                   <td>{{$product->price}}</td>
                   <td>{{$product->quantity}}</td>
                   <td>{{$product->description}}</td>
                   <td>
                       <a href="/products/editproduct/{{$product->id}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                       <a href="javascript:void(0)" pid={{$product->id}} class="btn btn-danger deleteproduct"><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
