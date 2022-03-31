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
        <div class="grid grid-cols-1 gap-4">
            <div>
            <h1>Upholstery Class Enquiries</h1>
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
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Days Required</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="tablecontents">
                @foreach($enquiries as $enquiry)
                    <tr class="row1
                        @if ($enquiry->status == 'unread'){
                        font-bold
                        }
                        @endif
                        " data-id="{{ $enquiry->id }}">
                        <td class="pl-3"><i class="fa fa-sort"></i>{{$enquiry->id}}</td>
                        <td>{{ $enquiry->name }} </td>
                        <td>{{ $enquiry->subject }}</td>
                        <td>{{ $enquiry->days_required }}</td>
                        <td>{{ $enquiry->created_at }}</td>
                        <td>{{$enquiry->status}}</td>
                        <td class="text-right">
                            <a href="{{ URL::to('dashboard/upholstery-enquiries/' . $enquiry->id) }}"><i class="far fa-eye"></i></a>
                            <form method="POST" name="delete-upholstery-enquiry-form" id="delete-upholstery-enquiry-form" class="inline-block" action="{{route('dashboard.upholstery-enquiries.destroy', [$enquiry->id])}}"
                                  onsubmit="return confirm('Are you sure you want to delete this enquiry?');"
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
      $("#table").DataTable({
        "order": [[ 4, "desc" ]]
      });
    });
    </script>
</x-app-layout>
