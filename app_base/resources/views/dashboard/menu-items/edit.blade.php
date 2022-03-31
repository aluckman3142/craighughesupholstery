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
            <h1>Edit Menu Item {{$menuItem->name}}</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="edit-menu-item-form" id="edit-menu-item-form" method="post" action="{{ URL::to('dashboard/menu-items/'.$menuItem->id.'/update') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{  old('name', $menuItem->name) }}">
            </div>
            <div class="form-group">
                <label for="url_path">Link</label>
                <input type="text" id="url_path" name="url_path" class="form-control" value="{{  old('url_path', $menuItem->url_path) }}">
            </div>

            <button type="submit" class="btn btn-success btn-sm uppercase">Update Menu Item</button>
        </form>

    </div>

</x-app-layout>