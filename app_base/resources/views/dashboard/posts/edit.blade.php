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
            <h1>Edit Post {{$post->title}}</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="edit-blog-post-form" id="add-blog-post-form" method="post" action="{{ URL::to('dashboard/posts/'.$post->slug.'/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{  old('title', $post->title) }}">
            </div>
            <div class="form-group">
                <label for="intro_text">Intro Text</label>
                <textarea id="intro_text" name="intro_text" class="form-control">{{ old('intro_text', $post->intro_text) }}</textarea>
            </div>
            <div class="form-group">
                <label for="main_text">Content</label>
                <textarea id="main_text" name="main_text" class="form-control">{{ old('main_text', $post->main_text) }}</textarea>
            </div>
            <div class="form-group">
                <label for="published_date">Published Date</label>
                <input type="date" id="published_date" name="published_date" class="form-control" value="{{ old('published_date', $post->published_date) }}">
            </div>
            <div class="form-group">
                <label for="published_by">Published By</label>
                <input type="text" id="published_by" name="published_by" class="form-control" value="{{ old('published_by', $post->published_by) }}">
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" id="link" name="link" class="form-control" value="{{ old('link', $post->link) }}">
            </div>
            <div class="form-group">
                <label for="image">Update Images</label>
                <input type="file" name="photos[]" id="photos[]" multiple>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 mb-5">
                @foreach($post->images as $image)
                    <div>
                        <img src="/{{$image->src}}" class="w-full">
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success btn-sm uppercase">Update Post</button>
        </form>
    </div>
</x-app-layout>
