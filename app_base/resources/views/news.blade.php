@extends('layouts.frontend')
@section('title')
    <title>Latest Craig Hughes Upholstery News</title>
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Latest Craig Hughes Upholstery News</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="text-gray-600 body-font fade-in">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                @foreach($posts as $post)
                    <div class="p-4 md:w-1/3">
                        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                            <div class="lg:h-48 md:h-36 w-full object-cover object-center" style="background-image: url('{{$post['images'][0]['src']}}')"></div>
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1 uppercase">{{$post->published_by}}</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{substr($post->title, 0, 100)}}...</h1>
                                <p class="leading-relaxed mb-3">{{substr($post->intro_text, 0, 150)}}...</p>
                                <div>
                                    <a href="/news/{{$post->slug}}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Read More
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                    <span class="float-right">{{date('d F Y', strtotime($post->published_date))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@append
