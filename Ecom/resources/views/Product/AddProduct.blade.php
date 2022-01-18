@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Product') }}
                        <a href="/products/showproducts" class="btn btn-warning float-right">Show Products</a>

                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{route('post.add.product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="row justify-content-center"> --}}
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }} <i class="text text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="prodname" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="subcat" class="col-md-4 col-form-label text-md-end">{{ __(' Sub-Category Type ') }} <i class="text text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <select class="form-control @error('subcat') is-invalid @enderror" id="subcat" name="subcat">
                                            <!-- foreach render types  -->
                                            <option default>-- Select -- </option>
                                        @foreach ($subcategory as $subcat)
                                            <option value="{{$subcat->id}}">{{$subcat->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('subcat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="color" class="col-md-4 col-form-label text-md-end">{{ __('Product Colour') }} <i class="text text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}"  autocomplete="color" autofocus>

                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Product Quantity') }} <i class="text text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}"  autocomplete="quantity" autofocus>

                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Product Price') }} <i class="text text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="description" class="col-md-4 form-label text-md-end">{{ __('Product Description ') }} <i class="text text-danger"></i></label>
                                    <div class="col-md-8">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" rows="4"></textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 form-label text-md-end">{{ __('File upload')}} <i class="text text-danger">*</i></label>
                                    <div class="col-md-8">
                                    <input type="file" name="image[]" class="form-control file-upload-info @error('image') is-invalid @enderror" multiple>
                                    @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Add Product') }}
                                        </button>
                                    </div>
                                </div>
                            {{-- </div> --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
var i = 0;
var j = 0;
$("#add-btn").click(function(){
++i;
++j;
$("#dynamicAddRemove").append('<tr><td><input type="text" name="attr['+i+'][name]" placeholder="Enter Name" class="form-control @error(`attr..name`) is-invalid @enderror" /></td><td><input type="text" name="attr['+j+'][value]" placeholder="Enter Value" class="form-control @error(`attr..value`) is-invalid @enderror" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){
$(this).parents('tr').remove();
});
</script>
@endsection