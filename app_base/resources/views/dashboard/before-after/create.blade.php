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

    <div class="m-5">
            <h1>Create New Category Image</h1>
            <hr>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach

        <form name="add-before-after-form" id="add-before-after-form" method="post" action="{{ URL::to('dashboard/before-after/store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="hidden">
                <label for="before_image_name">Before Image Name</label>
                <input type="text" id="before_image_name" name="before_image_name" class="hidden" value="{{ old('before_image_name') }}">
            </div>
            <div class="hidden">
                <label for="after_image_name">After Image Name</label>
                <input type="text" id="after_image_name" name="after_image_name" class="hidden" value="{{ old('after_image_name') }}">
            </div>

            <div class="form-group">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label for="before_upload">Before Image</label>
                        <input type="file" id="before_upload" value="{{ old('before_upload') }}">
                    </div>
                    <div>
                        <div id="before-image-preview" class="float-right">
                            @if (old('before_image_name'))
                                <img src="/img/category-images/thumbs/{{ old('before_image_name') }}" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label for="after_upload">After Image</label>
                        <input type="file" id="after_upload" value="{{ old('after_upload') }}">
                    </div>
                    <div>
                        <div id="after-image-preview" class="float-right">
                            @if (old('after_image_name'))
                                <img src="/img/category-images/thumbs/{{ old('after_image_name') }}" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm uppercase">Add Before &amp; After Image</button>
        </form>

    </div>


    <div id="beforeImageModel" class="modal fade bd-example-modal-xl" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
        <div id="before-cropie-demo" style="width:250px"></div>
        <button class="btn btn-success before-upload-result">Upload Before Image</button>

                </div></div></div>
    </div>

    <div id="afterImageModel" class="modal fade bd-example-modal-xl" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="after-cropie-demo" style="width:250px"></div>
                    <button class="btn btn-success after-upload-result">Upload After Image</button>

                </div></div></div>
    </div>

    <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $beforeUploadCrop = $('#before-cropie-demo').croppie({
      enableExif: true,
      viewport: {
        width: 564,
        height: 270,
        type: 'square'
      },
      boundary: {
        width: 660,
        height: 360
      }
    });

    $afterUploadCrop = $('#after-cropie-demo').croppie({
      enableExif: true,
      viewport: {
        width: 564,
        height: 270,
        type: 'square'
      },
      boundary: {
        width: 660,
        height: 360
      }
    });


    $('#before_upload').on('change', function() {
      $('#beforeImageModel').modal('show');
        var reader = new FileReader();
        reader.onload = function(e) {
          setTimeout(function(){
          $beforeUploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function() {
            $original_image = e.target.result;
            console.log('jQuery bind complete');
          });
          }, 200);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#after_upload').on('change', function() {
      $('#afterImageModel').modal('show');
      var reader = new FileReader();
      reader.onload = function(e) {
        setTimeout(function(){
          $afterUploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function() {
            $original_image = e.target.result;
            console.log('jQuery bind complete');
          });
        }, 200);
      }
      reader.readAsDataURL(this.files[0]);
    });


    $('.before-upload-result').on('click', function(ev) {
      $('#beforeImageModel').modal('hide');
      $beforeUploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(resp) {
        $.ajax({
          url: "{{ route('dashboard.before-after.beforeCrop') }}",
          type: "POST",
          data: {
            "image": resp,
            "original": $original_image
          },
          success: function(data) {
            html = '<img src="' + resp + '" />';
            $("#before-image-preview").html(html);
            $("#before_image_name").val(data['name']);
          }
        });
      });
    });

    $('.after-upload-result').on('click', function(ev) {
      $('#afterImageModel').modal('hide');
      $afterUploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(resp) {
        $.ajax({
          url: "{{ route('dashboard.before-after.afterCrop') }}",
          type: "POST",
          data: {
            "image": resp,
            "original": $original_image
          },
          success: function(data) {
            html = '<img src="' + resp + '" />';
            $("#after-image-preview").html(html);
            $("#after_image_name").val(data['name']);
          }
        });
      });
    });

    </script>

</x-app-layout>
