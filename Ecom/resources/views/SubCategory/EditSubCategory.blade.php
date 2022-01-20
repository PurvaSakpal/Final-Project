@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Sub-Category') }}
                        <a href="/subcategory/showsubcategory" class="btn btn-warning float-right">Show Sub-Category</a>
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
                        <form action="{{ route('post.edit.subcategory') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subcat->id }}">
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('SubCategory Name') }}<span
                                        class="text-danger ml-2">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $subcat->name }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}<span
                                        class="text-danger ml-2">*</span></label>

                                <div class="col-md-6">
                                    <select name="category" class="form-control @error('category') is-invalid @enderror"
                                        id="category_name">
                                        <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>


                                <div class="col-md-6">
                                    {{-- <input id="name" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus> --}}
                                    <textarea name="description"
                                        class="form-control @error('description') is-invalid @enderror" id="description"
                                        cols="30" rows="7" autocomplete="description"
                                        autofocus>{{ $subcat->desription }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit SubCategory') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 offset-md-4">
                                    <p class="text-success"><span class="text-danger ml-1"><b>*</b></span> fields are
                                        required</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
