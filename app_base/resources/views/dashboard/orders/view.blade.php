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
                <h1>Manage Orders</h1>
            </div>
            <div class="border-2 border-dashed border-gray-300">
                <p class="m-2">Legend:</p>
                <div class="m-2 p-2 bg-green-100">Completed/Dispatched</div>
                <div class="m-2 p-2 bg-yellow-100">Processing/Pending</div>
                <div class="m-2 p-2 bg-red-100">Failed/Cancelled</div>
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
                <th>Order Placed</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Postcode</th>
                <th>Order Total</th>
                <th>No. of Items</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="tablecontents">
            @foreach($orders as $order)
                <tr class="row1
                    @if($order->status == 'Failed')
                    bg-red-100
@elseif($order->status == 'Cancelled')
                    bg-red-100
                    @elseif($order->status == 'Pending')
                    bg-yellow-100
                    @elseif($order->status == 'Processing')
                    bg-yellow-100
                  @elseif($order->status == 'Completed')
                    bg-green-100
                     @elseif($order->status == 'Dispatched')
                    bg-green-100
@endif
                    " data-id="{{ $order->id }}">
                    <td class="pl-3"><i class="fa fa-sort"></i> {{$order->order_no}}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->title }} {{ $order->forename }} {{ $order->surname }}</td>
                    <td>{{$order->postcode}}</td>
                    <td>&pound;{{$order->total}}</td>
                    <td>{{$order->products->sum('pivot.quantity')}}</td>
                    <td class="text-right">
                        <a href="{{ URL::to('dashboard/orders/' . $order->id . '/view') }}"><i class="fas fa-eye"></i></a>
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
