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
            <h1>Manage Order {{$order->order_no}}</h1>
            <hr>
        @if ($message = Session::get('success_message'))
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

        <div class="grid md:grid-cols-2 md:grid-cols-1 gap-2">
            <div class="w-full px-4">
                <p class=" text-sm text-gray-600"><span class="font-bold">Order No:</span>  {{$order->order_no}}</p>
                <p class=" text-sm text-gray-600"><span class="font-bold">Status:</span>  {{$order->status}}</p>
            </div>
            <div class="w-full px-4">
                <p class=" text-sm text-gray-600"><span class="font-bold">Order Placed:</span>  {{$order->created_at}}</p>
            </div>
            <div class="w-full px-4">
                <div class="p-8 border border-gray-400 bg-gray-200">
                    <h4 class="mb-2 text-lg font-semibold"> Customer Information </h4>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Email Address</p>
                        <p class=" text-sm text-gray-600">{{$order->email}}</p>
                    </div>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Customer Name</p>
                        <p class=" text-sm text-gray-600">{{$order->title}} {{$order->forename}} {{$order->surname}}</p>
                    </div>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Delivery Address</p>
                        <p class=" text-sm text-gray-600">
                            {{$order->address1}}
                            @if ($order->address2)
                                , {{$order->address2}}
                            @endif
                            @if ($order->town)
                                , {{$order->town}}
                            @endif
                            @if ($order->county)
                                , {{$order->county}}
                            @endif
                            @if ($order->postcode)
                                , {{$order->postcode}}
                            @endif
                        </p>
                    </div>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Customer Phone Number</p>
                        <p class=" text-sm text-gray-600">{{$order->phone}}</p>
                    </div>
                </div>

            </div>
            <div class="w-full px-4">
                <div class="p-8 border border-gray-400 bg-gray-200">
                    <h4 class="mb-2 text-lg font-semibold"> Order Information </h4>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Subtotal</p>
                        <p class=" text-sm text-gray-600">&pound;{{$order->subtotal}}</p>
                    </div>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Tax</p>
                        <p class=" text-sm text-gray-600">&pound;{{$order->tax}}</p>
                    </div>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Total</p>
                        <p class=" text-sm text-gray-600">&pound;{{$order->tax}}</p>
                    </div>
                    <div class="relative mb-2">
                        <p class=" text-sm text-gray-600 mb-0 font-bold">Payment Type</p>
                        <p class=" text-sm text-gray-600">
                            {{$order->payment_gateway}}
                            @if ($order->error)
                                - {{$order->error}}
                            @else
                                - Successful
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 px-4">
                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Order Items</h2>
                @foreach ($order->products as $product)
                    <div class="w-full border-bottom border-gray-200 inline-block p-2">
                        <div class="w-1/6 float-left inline-block">
                            <a href="{{route('shop.product', $product->slug)}}">
                                <img src="{{$product->images[0]->src}}" class="w-full">
                            </a>
                        </div>
                        <div class="w-2/3 float-left inline-block pl-4">
                            <a href="{{route('shop.product', $product->slug)}}"><p class="font-bold">{{$product->name}}</p></a>
                            <p class="text-gray-500 uppercase">SKU: {{$product->product_code}}</p>
                            <p class="text-gray-500">{{$product->tagline}}</p>

                        </div>
                        <div class="w-1/6 float-left inline-block text-right">
                            <p>&pound;{{$product->price}}</p>
                            <p>Qty: {{$product->pivot->quantity}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-4">
                <form method="POST" name="delete-category-form" id="delete-category-form" class="inline-block" action="{{route('dashboard.orders.ship', [$order->id])}}"
                      onsubmit="return confirm('Are you sure you want to ship this order?');"
                >
                    @csrf
                    <button type="submit" class="hover:bg-white text-md p-2 px-4 bg-green-200 font-thin text-black w-full my-4">
                        Mark As Shipped
                    </button>
                </form>
            </div>
            <div class="p-4">
                <form method="POST" name="delete-category-form" id="delete-category-form" class="inline-block" action="{{route('dashboard.orders.cancel', [$order->id])}}"
                      onsubmit="return confirm('Are you sure you want to cancel this order?');"
                >
                    @csrf
                    <button type="submit" class="hover:bg-white text-md p-2 px-4 bg-red-200 font-thin text-black w-full my-4">
                        Cancel Order
                    </button>
                </form>
            </div>
            </div>
        </div>

</x-app-layout>
