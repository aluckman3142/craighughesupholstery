@extends('layouts.frontend')
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Latest Craig Hughes Upholstery News</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section>
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <p class="text-sm text-gray-500 mb-2">Published on {{$post->published_date}}</p>
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{$post->title}}
                </h1>
                <p class="font-bold mb-4">{{$post->intro_text}}</p>
                <p class="mb-8 leading-relaxed">{!! nl2br($post->main_text) !!} </p>
                <div class="flex justify-center">
                    <a href="{{$post->link}}" target="_blank">
                    <button class="bg-gray-200 font-thin text-black py-2 px-6 focus:outline-none hover:bg-black hover:text-white">Read Original Article</button>
                    </a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                @foreach ($post->images as $image)
                <img class="object-cover object-center rounded mb-4" alt="hero" src="/{{$image->src}}">
                @endforeach
            </div>
        </div>

</section>
@append
