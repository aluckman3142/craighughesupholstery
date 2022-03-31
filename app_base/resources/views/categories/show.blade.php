@extends('layouts.frontend')
@section('middle-content')
    <div class="w-full bg-cover bg-center" style="background-image: url({{$category->image_path}})">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">{{$category->title}}</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-10 mx-auto max-w-screen-lg">
            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div class="text-center">
                    <p class="py-3">
                    {!! nl2br($category->long_desc) !!}
                    </p>
</div>
</div>
</div>
        @if ($category->slug == 'before-after')
            <before-after-component :categories="{{json_encode($items)}}"></before-after-component>

        @else
            <vue-cool-lightbox :items="{{json_encode($items)}}"></vue-cool-lightbox>
        @endif
</section>
@append
