@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Shopping Cart</title>
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Craig Hughes Shopping Cart</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
                <nav class="flex flex-wrap items-center justify-between px-2 py-3">
                    <div class=" px-4 mx-auto flex flex-wrap items-center justify-between">
                        <div class="w-full relative flex justify-between md:w-auto md:static md:block md:justify-start">
                            <ul>
                                @guest
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('register')}}">REGISTER</a>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('login')}}">LOGIN</a>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('cart.index')}}">CART @if (Cart::count() > 0)<div class="bg-yellow-200 rounded-full h-4 w-4 text-black text-center text-xs ml-2">{{Cart::count()}}</div>@endif</a>
                                    </li>
                                @else
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('my-account')}}">MY ACCOUNT</a>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
                                        </form>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('cart.index')}}">CART @if (Cart::count() > 0)<div class="bg-yellow-200 rounded-full h-4 w-4 text-black text-center text-xs ml-2">{{Cart::count()}}</div>@endif</a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <div class="grid grid-cols-1 ">
                <div>
                    @if ($message = Session::get('success_message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                @foreach($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                                @endforeach
                            </div>
                        @endif
                        @if (Cart::count() > 0)
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ Cart::count() }} Item(s) in Shopping Cart</h2>

                            @foreach(Cart::content() as $item)
                    <div class="w-full border-bottom border-gray-200 inline-block p-2">
                        <div class="w-1/6 float-left inline-block">
                            <a href="{{route('shop.product', $item->model->slug)}}">
                            <img src="{{$item->model->images[0]->src}}" class="w-full">
                            </a>
                        </div>
                        <div class="w-5/12 float-left inline-block pl-4">
                            <a href="{{route('shop.product', $item->model->slug)}}"><p class="font-bold">{{$item->model->name}}</p></a>
                            <p class="text-gray-500 uppercase">SKU: {{$item->model->product_code}}</p>
                            <p class="text-gray-500">{{$item->model->tagline}}</p>
                        </div>
                        <div class="w-1/6 float-left inline-block text-right px-4">
                            <form name="remove-product-from-cart-form" id="remove-product-from-cart-form" action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:bg-white text-md mt-3 py-2 px-4 bg-gray-200 font-thin text-black">Remove</button>
                            </form>
                            <form name="switch-product-to-save-for-later-form" id="switch-product-to-save-for-later-form" action="{{route('cart.switchToSaveForLater', $item->rowId)}}" method="POST">
                                @csrf
                                <button type="submit" class="hover:bg-white text-md mt-3 py-2 px-4 bg-gray-200 font-thin text-black">Save For Later</button>
                            </form>
                        </div>
                        <div class="w-1/12 float-left inline-block">
                            <input data-id="{{ $item->rowId }}" type="number" class="quantity w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="quantity" name="quantity" min="1" max="10" value="{{$item->qty}}">
                        </div>
                        <div class="w-1/6 float-left inline-block text-right">
                            <p>&pound;{{$item->total}}</p>
                        </div>
                    </div>
                            @endforeach

                        @else
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font mb-4">No Items in Shopping Cart</h2>
                            <a href="{{route('shop.index')}}" class="hover:bg-white text-md py-2 px-4 bg-gray-200 font-thin text-black my-10">Continue Shopping</a>
                        @endif

                        <div class="w-full inline-block p-4 bg-gray-200 mt-4">
                            <div class="grid grid-cols-2 gap-2">
                                <div><p>Subtotal</p></div>
                                <div><p class="text-right">&pound;{{Cart::subtotal()}}</p></div>
                                <div><p>Shipping</p></div>
                                <div><p class="text-right">FREE</p></div>
                                <div><p class="font-bold">Total</p></div>
                                <div><p class="font-bold text-right">&pound;{{Cart::total()}}</p></div>
                            </div>
                        </div>
                        <div class="w-full inline-block py-2 mt-4">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <a href="{{route('shop.index')}}">
                                        <button class="hover:bg-white text-md pt-3 pb-2 px-4 bg-gray-200 font-thin text-black float-left">Continue Shopping</button>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('checkout.index')}}">
                                        <button class="hover:bg-white text-md pt-3 pb-2 px-4 bg-green-200 font-thin text-black float-right">Proceed To Checkout</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (Cart::instance('saveForLater')->count() > 0)
                    <h2 class="text-gray-900 text-lg mb-1 mt-8 font-medium title-font">{{ Cart::instance('saveForLater')->count() }} Item(s) Saved for Later</h2>
                            @foreach(Cart::instance('saveForLater')->content() as $item)
                                <div class="w-full border-bottom border-gray-200 inline-block p-2">
                                    <div class="w-1/6 float-left inline-block">
                                        <a href="{{route('shop.product', $item->model->slug)}}">
                                            <img src="{{$item->model->images[0]->src}}" class="w-full">
                                        </a>
                                    </div>
                                    <div class="w-5/12 float-left inline-block pl-4">
                                        <a href="{{route('shop.product', $item->model->slug)}}"><p>{{$item->model->name}}</p></a>
                                        <p class="text-gray-500 uppercase">{{$item->model->tagline}}</p>
                                    </div>
                                    <div class="w-1/6 float-left inline-block text-right px-4">
                                        <form name="remove-product-from-save-for-later-form" id="remove-product-from-save-for-later-form" action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hover:bg-white text-md mt-3 py-2 px-4 bg-gray-200 font-thin text-black">Remove</button>
                                        </form>
                                        <form name="switch-product-to-cart-form" id="switch-product-to-cart-form" action="{{route('cart.moveToCart', $item->rowId)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="hover:bg-white text-md mt-3 py-2 px-4 bg-gray-200 font-thin text-black">Move To Cart</button>
                                        </form>
                                    </div>
                                    <div class="w-1/12 float-left inline-block">
                                        <input type="number" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="quantity" name="quantity" min="1" max="10" value="1">
                                    </div>
                                    <div class="w-1/6 float-left inline-block text-right">
                                        <p>&pound;{{$item->price}}</p>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font mb-4">You have no Items Saved For Later.</h2>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div class="bg-gray-500 py-5 text-center text-white">
        <div class="container my-5 mx-auto max-w-screen-lg">
            <h1 class="text-2xl font-thin mx-2">Shipping Available to the UK Only</h1>
            <div class="w-1/6 h-1 bg-gray-300 mb-4 mt-3 mx-auto"></div>
            <div class="grid grid-cols-1 gap-8 text-md  mx-2">
                <div>
                    <p class="py-3">
                        Due to feathers being prohibited in some countries we are unable to ship feather scatter cushions. If you would like just a cushion case or fibre fill cushion then please contact us via the contact form for costs.
                    </p>
                </div>
            </div>
        </div>
    </div>
@append

@section('extra-js')
    <script>
    (function(){
        const classname = document.querySelectorAll('.quantity')

        Array.from(classname).forEach(function (element){
          element.addEventListener('change', function (){
            const id = element.getAttribute('data-id')
            axios.patch(`/cart/${id}`, {
              quantity: this.value
            })
            .then(function (response) {
              //console.log(response);
              window.location.href = '{{ route('cart.index') }}'
            })
            .catch(function (error) {
              //console.log(error);
              window.location.href = '{{ route('cart.index') }}'
            });
          })
        })
    })();
    </script>
@append
