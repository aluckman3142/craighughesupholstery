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
            <h1>Manage Category Images</h1>
        <h5>Click here to <a href="{{ URL::to('dashboard/category-images/create') }}"><button class="btn btn-success btn-sm uppercase">Add a Category Image</button></a></h5>

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
                    <th>#</th>
                    <th class="w-1/6">Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="tablecontents">
                @foreach($categoryImages as $categoryImage)
                    <tr class="row1
                    @if($categoryImage->enabled == 0)
                        bg-red-100
                        @else
                        bg-green-100
                    @endif
                        " data-id="{{ $categoryImage->id }}">
                        <td class="pl-3"><i class="fa fa-sort"></i>{{$categoryImage->sort_order}}</td>
                        <td><img src="{{$categoryImage->thumb}}" class="w-full"> </td>
                        <td>{{ $categoryImage->title }}</td>
                        <td>{{ $categoryImage->category->title }}</td>
                        <td>{{$categoryImage->description}}</td>
                        <td class="text-right">
                            <a href="{{ URL::to('dashboard/category-images/' . $categoryImage->id . '/edit') }}"><i class="far fa-edit"></i></a>
                            @if($categoryImage->enabled == 0)
                                <form method="POST" name="enable-category-image-form" id="enable-category-image-form" class="inline-block" action="{{route('dashboard.category-images.enable', [$categoryImage->id])}}">
                                    @csrf
                                    <button type="submit"><i class="far fa-check-circle" style="color: #007bff;"></i></button>
                                </form>
                            @else
                                <form method="POST" name="disable-category-image-form" id="disable-category-image-form" class="inline-block" action="{{route('dashboard.category-images.disable', [$categoryImage->id])}}"
                                      onsubmit="return confirm('Are you sure you want to disable this category image?');"
                                >
                                    @csrf
                                    <button type="submit"><i class="fas fa-ban" style="color: #007bff;"></i></button>
                                </form>
                            @endif
                            <form method="POST" name="delete-category-image-form" id="delete-category-image-form" class="inline-block" action="{{route('dashboard.category-images.destroy', [$categoryImage->id])}}"
                                  onsubmit="return confirm('Are you sure you want to delete this category image?');"
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
    });
    </script>
</x-app-layout>
