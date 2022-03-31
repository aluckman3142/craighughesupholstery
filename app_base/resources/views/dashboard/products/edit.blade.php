<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <div class="m-5">
            <h1>Edit Product {{$product->name}}</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="edit-product-form" id="edit-product-form" method="post" action="{{ URL::to('dashboard/products/'.$product->slug.'/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{  old('name', $product->name) }}">
            </div>
            <div class="form-group">
                <label for="product_code">Product Code</label>
                <input type="text" id="product_code" name="product_code" class="form-control" value="{{ old('product_code', $product->product_code) }}">
            </div>
            <div class="form-group">
                <label for="tagline">Tagline</label>
                <textarea id="tagline" name="tagline" class="form-control">{{ old('tagline', $product->tagline) }}</textarea>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>


                <div class="form-group">
                    <label for="price">Price (&pound;)</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                </div>
            <div class="form-group">
                <label for="photos">Update Images</label>
                <input type="file" name="photos[]" id="photos[]" multiple>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 mb-5">
                @foreach($product->images as $image)
                    <div>
                        <img src="{{$image->src}}" class="w-full">
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success btn-sm uppercase">Update Product</button>
        </form>
    </div>
</x-app-layout>
