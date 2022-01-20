@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deleteproduct').click(function(e) {
                var pid = $(this).attr('pid');
                if (confirm("Delete product?")) {
                    $.ajax({
                        url: "{{ url('/products/deleteproduct') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            pid: pid
                        },
                        success: function(response) {
                            window.location.href = "/products/showproducts";
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
                <h1>Products Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/products/addproduct" class="btn btn-warning float-right display-block" style="
                   ">Add Product</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('errors'))
            <div class="alert alert-success">{{ Session::get('errors') }}</div>
        @endif
        <table class="table table-striped" id="mytable">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Sub-Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($products) && $products->count())

                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @foreach ($subcategory as $subcat)
                                    @if ($subcat->id == $product->sub_category_id)
                                        {{ $subcat->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <a href="/products/showproductdetails/{{ $product->id }}" class="btn btn-primary"><i
                                        class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="/products/editproduct/{{ $product->id }}" class="btn btn-success"><i
                                        class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" pid={{ $product->id }}
                                    class="btn btn-danger deleteproduct"><i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
                            </td>
                        </tr>
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
        {{ $products->links() }}
    </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
