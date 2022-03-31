@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Shop</title>
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">My Account</h1>
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
            <h2 class="text-2xl font-thin mx-2">My Orders</h2>
            <div class="w-1/6 h-1 bg-black m-2 mb-4 mt-3"></div>
            @foreach ($orders as $order)
                <div class="border-1 border-gray-400 mb-4">
                    <div class="border-bottom-1 border-gray-400 bg-gray-200 text-gray-500 p-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="grid grid-cols-4 gap-2 col-span-2">
                                <div>
                                    <span class="text-uppercase font-bold">Order Placed</span><br/>
                                    {{date('d F Y', strtotime($order->created_at))}}
                                </div>
                                <div>
                                    <span class="text-uppercase font-bold">Order Status</span><br/>
                                    {{$order->status}}
                                </div>
                                <div>
                                    <span class="text-uppercase font-bold">Total</span><br/>
                                    &pound;{{$order->total}}
                                </div>
                                <div>
                                    <span class="text-uppercase font-bold">Dispatch To</span><br/>
                                    {{$order->title}} {{$order->forename}} {{$order->surname}}
                                </div>
                            </div>
                            <div class="justify-items-end">
                                <div class="text-right">
                                    <span class="text-uppercase font-bold">Order No.</span><br/>
                                    {{$order->order_no}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($order->products as $product)
                        <div class="w-full  inline-block p-4">
                            <div class="border-bottom border-gray-200 inline-block pb-4">
                                <div class="w-1/6 float-left inline-block">
                                    <a href="{{route('shop.product', $product->slug)}}">
                                        <img src="{{$product->images[0]->src}}" class="w-full">
                                    </a>
                                </div>
                                <div class="w-1/2 float-left inline-block pl-4 pt-8">
                                    <a href="{{route('shop.product', $product->slug)}}"><p class="font-bold">{{$product->name}}</p></a>
                                    <p class="text-gray-500 uppercase">SKU: {{$product->product_code}}</p>
                                    <p class="text-gray-500">{{$product->tagline}}</p>
                                </div>
                                <div class="w-1/6 float-left inline-block text-right px-4 t-8">

                                </div>
                                <div class="w-1/12 float-left inline-block pt-10">
                                    <input data-id="{{ $product->pivot->quantity }}" type="number" class="quantity w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="quantity" name="quantity" min="1" max="10" value="{{ $product->pivot->quantity }}">
                                </div>
                                <div class="w-1/6 float-right inline-block text-right pt-12">
                                    <p class="text-right">&pound;{{$product->price * $product->pivot->quantity}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
@append
