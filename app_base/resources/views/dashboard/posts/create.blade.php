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
            <h1>Create New Post</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ URL::to('dashboard/posts/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="intro_text">Intro Text</label>
                <textarea id="intro_text" name="intro_text" class="form-control">{{ old('intro_text') }}</textarea>
            </div>
            <div class="form-group">
                <label for="main_text">Content</label>
                <textarea id="main_text" name="main_text" class="form-control">{{ old('main_text') }}</textarea>
            </div>
            <div class="form-group">
                <label for="published_date">Published Date</label>
                <input type="date" id="published_date" name="published_date" class="form-control" value="{{ old('published_date') }}">
            </div>
            <div class="form-group">
                <label for="published_by">Published By</label>
                <input type="text" id="published_by" name="published_by" class="form-control" value="{{ old('published_by') }}">
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" id="link" name="link" class="form-control" value="{{ old('link') }}">
            </div>
            <div class="form-group">
                <label for="photos">Images</label>
                <input type="file" name="photos[]" id="photos[]" multiple>
            </div>
            <button type="submit" class="btn btn-success btn-sm uppercase">Add Post</button>
        </form>
    </div>
</x-app-layout>
