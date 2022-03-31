<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <body>
    <div class="m-5">
            <h1>Edit Category {{$category->title}}</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="edit-category-form" id="edit-category-form" method="post" action="{{ URL::to('dashboard/categories/'.$category->slug.'/update') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{  old('title', $category->title) }}">
            </div>
            <div class="form-group">
                <label for="short_desc">Short Description</label>
                <textarea id="short_desc" name="short_desc" class="form-control">{{ old('short_desc', $category->short_desc) }}</textarea>
            </div>
            <div class="form-group">
                <label for="long_desc">Long Description</label>
                <textarea id="long_desc" name="long_desc" class="form-control">{{ old('long_desc', $category->long_desc) }}</textarea>
            </div>
            <div class="form-group">
                <label for="button_text">Button Text</label>
                <input type="text" id="button_text" name="button_text" class="form-control" value="{{ old('button_text', $category->button_text) }}">
            </div>
            <div class="form-group">
                <label for="button_path">Button Path</label>
                <input type="text" id="button_path" name="button_path" class="form-control" value="{{ old('button_path', $category->button_path) }}">
            </div>
            <div class="hidden">
                <label for="image_name">Image Name</label>
                <input type="text" id="image_name" name="image_name" class="hidden" value="{{ old('image_name') }}">
            </div>

            <div class="form-group">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                <label for="upload">Image</label>
                <input type="file" id="upload">
                    </div>
                    <div>
                        <div id="image-preview" class="float-right">
                        @if (old('image_name'))
                            <img src="/img/sections/{{ old('image_name') }}" />
                        @else
                            <img src="{{$category->image_path}}" />
                        @endif
                        </div>
                    </div>
                    </div>

            </div>
            <button type="submit" class="btn btn-success btn-sm uppercase">Update Category</button>
        </form>

    </div>


    <div id="imageModel" class="modal fade bd-example-modal-xl" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
        <div id="cropie-demo" style="width:250px"></div>
        <button class="btn btn-success upload-result">Upload Image</button>

                </div></div></div>
    </div>

    <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $uploadCrop = $('#cropie-demo').croppie({
      enableExif: true,
      viewport: {
        width: 470,
        height: 225,
        type: 'square'
      },
      boundary: {
        width: 550,
        height: 300
      }
    });


    $('#upload').on('change', function() {
      $('#imageModel').modal('show');
      var reader = new FileReader();
      reader.onload = function(e) {
        setTimeout(function(){
          $uploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function() {
            console.log('jQuery bind complete');
          });
        }, 200);
      }
      reader.readAsDataURL(this.files[0]);
    });


    $('.upload-result').on('click', function(ev) {
      $('#imageModel').modal('hide');
      $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(resp) {
        $.ajax({
          url: "{{ route('dashboard.categories.crop') }}",
          type: "POST",
          data: {
            "image": resp
          },
          success: function(data) {
            html = '<img src="' + resp + '" />';
            $("#image-preview").html(html);
            $("#image_name").val(data['name']);
          }
        });
      });
    });

    </script>

</x-app-layout>
