@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Videos</title>
    <x-embed-styles />
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Weekly Craig Hughes Upholstery Videos</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <video-feed></video-feed>

{{--        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">--}}
{{--            @foreach($videos as $video)--}}
{{--                <div>--}}
{{--        <x-embed url="{{$video->src}}" />--}}
{{--                    <h1 class="font-bold text-lg">{{$video->title}}</h1>--}}
{{--                    <p>{{$video->description}}</p>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        </div>--}}
    </section>
@append
