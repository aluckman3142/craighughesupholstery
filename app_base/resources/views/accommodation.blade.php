@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Accommodation</title>
@append
@section('middle-content')
    <div class="w-full bg-accommodation-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Craig Hughes Upholstery
                    Accommodation</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div class="text-center">
                    <p class="py-3">
                        Located in Colwyn Bay next door to our Workshop.
                    </p>
                    <p class="py-3">
                        A 3 storey house comprising of 2 Double Rooms, 1 Single Room &amp; 1 twin Room
                    </p>
                    <p class="py-3">
                        Our Self Catering accommodation comes with on Site Manager. All pleasant bedrooms with shared
                        bathroom, kitchen, living room, and small back garden.
                    </p>
                    <p class="py-3">
                        Our accommodation is available to everyone.  If you need to book on our upholstery classes
                        it's perfect being next door to the workshop, ideal for customers who may need to travel distance
                        to drop off or pick up their furniture and good central location for Dealers or if you just fancy
                        a break and want to pop in & say hello! to Craig & Mrs H then that is perfectly fine just let
                        them know when booking.
                    </p>
                    <p class="py-3">
                        Prices £35.00 per person per night.
                    </p>
                </div>
            </div>
        </div>
        <vue-cool-lightbox :items="{{json_encode($items)}}"></vue-cool-lightbox>
    </section>
@append
