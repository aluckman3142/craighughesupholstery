<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="m-5">
            <h1>Create New Product</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="add-product-form" id="add-product-form" method="post" action="{{ URL::to('dashboard/products/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="product_code">Product Code</label>
                <input type="text" id="product_code" name="product_code" class="form-control" value="{{ old('product_code') }}">
            </div>
            <div class="form-group">
                <label for="tagline">Tagline</label>
                <textarea id="tagline" name="tagline" class="form-control">{{ old('tagline') }}</textarea>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
                <div class="form-group">
                    <label for="price">Price (&pound;)</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="photos">Images</label>
                <input type="file" name="photos[]" id="photos[]" multiple>
            </div>
            <button type="submit" class="btn btn-success btn-sm uppercase">Add Product</button>
        </form>
    </div>
</x-app-layout>
