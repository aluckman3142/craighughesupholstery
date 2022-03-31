@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Fabrics</title>
@append
@section('middle-content')
    <div class="w-full bg-fabrics bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Fabrics</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">

            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div>
                    <p class="text-lg text-center py-3">
                        We have 100's of stunning fabrics available from a range of top quality suppliers.
                        Our suppliers include:
                    </p>
                </div>
                <div class="text-center">
                    @foreach($fabricLinks as $fabricLink)
                    <div class="mb-4">
                    <h4 class="font-thin text-2xl text-center pb-2">{{ $fabricLink->title }}</h4>
                    <a href="{{ $fabricLink->link }}" target="_blank">
                   <div class="border-1 border-gray-500 p-4 w-full md:w-1/3 mx-auto rounded-full hover:bg-red-500 hover:text-white">
                       {{ $fabricLink->link }}
                   </div>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@append
