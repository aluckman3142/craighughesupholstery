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
            <h1>Manage Categories</h1>
        <h5>Click here to <a href="{{ URL::to('dashboard/categories/create') }}"><button class="btn btn-success btn-sm uppercase">Add a Category</button></a></h5>
            <h5>Drag and Drop the table rows and <button class="btn btn-success btn-sm uppercase" onclick="window.location.reload()">Refresh</button> to update the Category Order.</h5>
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
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach
            <table id="table" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="w-1/6">Thumbnail</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="tablecontents">
                @foreach($categories as $category)
                    <tr class="row1
                    @if($category->enabled == 0)
                        bg-red-100
                        @else
                        bg-green-100
                    @endif
                        " data-id="{{ $category->id }}">
                        <td class="pl-3"><i class="fa fa-sort"></i>{{$category->sort_order}}</td>
                        <td><img src="{{$category->image_path}}" class="w-full"> </td>
                        <td>{{ $category->title }}</td>
                        <td>{{$category->short_desc}}</td>
                        <td class="text-right">
                            <a href="{{ URL::to('dashboard/categories/' . $category->slug . '/edit') }}"><i class="far fa-edit"></i></a>
                            @if($category->enabled == 0)
                                <form method="POST" name="enable-category-form" id="enable-category-form" class="inline-block" action="{{route('dashboard.categories.enable', [$category->slug])}}">
                                    @csrf
                                    <button type="submit"><i class="far fa-check-circle" style="color: #007bff;"></i></button>
                                </form>
                            @else
                                <form method="POST" name="disable-category-form" id="disable-category-form" class="inline-block" action="{{route('dashboard.categories.disable', [$category->slug])}}"
                                      onsubmit="return confirm('Are you sure you want to disable this category?');"
                                >
                                    @csrf
                                    <button type="submit"><i class="fas fa-ban" style="color: #007bff;"></i></button>
                                </form>
                            @endif
                            <form method="POST" name="delete-category-form" id="delete-category-form" class="inline-block" action="{{route('dashboard.categories.destroy', [$category->slug])}}"
                                  onsubmit="return confirm('Are you sure you want to delete this category?');"
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

      $( "#tablecontents" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
          sendOrderToServer();
        }
      });

      function sendOrderToServer() {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('tr.row1').each(function(index,element) {
          order.push({
            id: $(this).attr('data-id'),
            position: index+1
          });
        });

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{ url('dashboard/categories/sort') }}",
          data: {
            order: order,
            _token: token
          },
          success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
          }
        });
      }
    });
    </script>
</x-app-layout>
