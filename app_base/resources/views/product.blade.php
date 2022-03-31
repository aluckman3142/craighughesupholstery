@extends('layouts.frontend')
@section('title')
    <title>{{$product->name}}</title>
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">{{$product->name}}</h1>
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
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="lg:w-1/2 w-full">
                    <product-component :items="{{json_encode($product['images'])}}"></product-component>
                </div>
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$product->product_code}}</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$product->name}}</h1>
                    <p class="leading-relaxed mb-5">{!! nl2br($product->description) !!}</p>
                    <form name="add-product-to-cart-form" id="add-product-to-cart-form" action="{{route('cart.store', $product)}}" method="POST">
                        @csrf
                    <div class="flex">
                        <span class="title-font font-medium text-2xl text-gray-900">&pound;{{$product->price}}</span>
                        <button class="flex ml-auto bg-gray-200 font-thin text-black py-2 px-6 focus:outline-none hover:bg-black hover:text-white">Add To Cart</button>
                    </div>
                    </form>
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
