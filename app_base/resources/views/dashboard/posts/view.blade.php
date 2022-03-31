<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <div class="m-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="col-span-2">
            <h1>Manage Posts</h1>
        <h5>Click here to <a href="{{ URL::to('dashboard/posts/create') }}"><button class="btn btn-success btn-sm uppercase">Add a Post</button></a></h5>
        </div>
            <div class="border-2 border-dashed border-gray-300">
                <p class="m-2">Legend:</p>
                <div class="m-2 p-2 bg-green-100">Enabled</div>
                <div class="m-2 p-2 bg-red-100">Disabled</div>
                </div>
        </div>
            <hr>
        @if ($message = Session::get('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
            <table id="table" class="table table-bordered">
                <thead>
                <tr>
                    <th>Published Date</th>
                    <th class="tw-1/6">Image</th>
                    <th>Title</th>
                    <th>Intro Text</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="tablecontents">
                @foreach($posts as $post)
                    <tr class="row1
                    @if($post->enabled == 0)
                        bg-red-100
                        @else
                        bg-green-100
                    @endif
                        " data-id="{{ $post->id }}">
                        <td class="pl-3"><i class="fa fa-sort"></i>{{$post->published_date}}</td>
                        <td><img src="/{{$post->images[0]->src}}" class="w-24"> </td>
                        <td>{{ $post->title }}</td>
                        <td>{{$post->intro_text}}</td>
                        <td class="text-right">
                            <a href="{{ URL::to('dashboard/posts/' . $post->slug . '/edit') }}"><i class="far fa-edit"></i></a>
                            @if($post->enabled == 0)
                                <form method="POST" name="enable-blog-post-form" id="enable-blog-post-form" class="inline-block" action="{{route('dashboard.posts.enable', [$post->slug])}}">
                                    @csrf
                                    <button type="submit"><i class="far fa-check-circle" style="color: #007bff;"></i></button>
                                </form>
                            @else
                                <form method="POST" name="disable-blog-post-form" id="disable-blog-post-form" class="inline-block" action="{{route('dashboard.posts.disable', [$post->slug])}}"
                                      onsubmit="return confirm('Are you sure you want to disable this post?');"
                                >
                                    @csrf
                                    <button type="submit"><i class="fas fa-ban" style="color: #007bff;"></i></button>
                                </form>
                            @endif
                            <form method="POST" name="delete-blog-post-form" id="delete-blog-post-form" class="inline-block" action="{{route('dashboard.posts.destroy', [$post->slug])}}"
                                  onsubmit="return confirm('Are you sure you want to delete this post?');"
                            >
                                @method('delete')
                                @csrf
                                <button type="submit"><i class="far fa-trash-alt" style="color: #007bff;"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript">
    $(function () {
      $("#table").DataTable();
    </script>
</x-app-layout>
