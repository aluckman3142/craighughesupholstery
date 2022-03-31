@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Homepage</title>
@append
@section('middle-content')
    <section class="fade-in">
        <slider-component :sliders="{{json_encode($sliders)}}"></slider-component>
    </section>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <h1 class="text-4xl font-thin mx-2">
                    About Craig Hughes Upholstery</h1>
            <div class="w-1/6 h-1 bg-gray-300 m-2 mb-4 mt-3"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg mx-2">
                <div>
                    <p class="font-bold py-3 pr-8">
                        Craig Hughes Upholstery has been established for over 35 years.
                    </p>
                    <p class="py-3">
                        Craig started as an apprentice in Manchester and eventually started his own business in 1984
                        in Urmston, Manchester where he became known in the area for his excellent work.
                    </p>
                    <p class="font-bold py-3 pr-8">
                        All Craig's work in Manchester was by way of recommendation and it is still the same today.
                    </p>
                    <p class="py-3 pr-8">
                        In 1998 Craig Moved his business from Manchester to Colwyn Bay, North Wales and has become well
                        known throughout the whole of North Wales, taking on work for many local Antique Dealers and
                        Interior Designers. He has a good relationship with local businesses as well as businesses all
                        over the UK.
                    </p>
                    <button class="bg-gray-200 font-thin text-black py-2 px-6 focus:outline-none hover:bg-black hover:text-white">
                        Read More...
                    </button>
                    <button class="bg-gray-200 font-thin text-black py-2 px-6 focus:outline-none hover:bg-black hover:text-white md:ml-2">
                        Visit us on YouTube
                    </button>
                </div>
                <div>
                    <p class="py-3 pr-8">
                        Craig is well known for his passion for classic cars and motorbikes and takes on some unusual
                        vehicle upholstery jobs for customers.
                    </p>
                    <p class="py-3 pr-8"> Craig is known for his original, traditional upholstery
                        and sympathetic repairs on old vehicle seats which he makes the upholstery in keeping with the
                        age and style of the vehicle.
                    </p>
                    <p class="py-3 pr-8">
                        Craig is also known as a main Restorer on the Discovery Channel's Quest TV "Salvage Hunters"
                        and a main Presenter on "Salvage Hunters The Restorers".
                    </p>
                    <p class="py-3 pr-8">He also appears as a guest Restorer
                        on "Salvage Hunters Classic Cars" restoring Drew's fascinating finds. He sometimes has to work
                        miracles with some of the old antiques but he enjoys the challenges.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="fade-in">
        <div class="w-full bg-headboard bg-cover bg-bottom">
            <div class="w-full bg-black bg-opacity-60">
                <div class="container mx-auto py-20">
                    <h1 class="text-white text-4xl font-thin mx-2 text-center">Craig Hughes Upholstery</h1>
                    <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
                    <p class="text-white italic m-2 my-4 font-bold px-20 md:px-32 lg:px-56 text-center text-lg">Craig
                        upholsters all modern and antique furniture, and he
                        produces / upholsters bespoke pieces. Craig also upholsters Classic Car seats, Motorbike seats
                        and
                        much much more.
                    </p>
                    <p class="text-white italic m-2 my-4 font-thin px-20 md:px-32 lg:px-56 text-center text-lg">Craig
                        specialises in Ekornes / Stressless furniture replacement
                        parts and repairs, and is also trained in Marks & Spencer, Next, Laura Ashley, Collins & Hayes,
                        Ercol and Parker Knoll furniture.
                    </p>
                    <p class="text-white italic m-2 my-4 font-thin px-20 md:px-32 lg:px-56 text-center text-lg">Craig is
                        one of the main foam, sundries & fabric suppliers
                        in the area and is always happy to take orders from people in need of supplies.
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="#">
                <div class="w-2/3 md:w-1/2 h-12 bg-green-500 text-white font-bold mx-auto relative -top-6 p-2 text-center text-uppercase">
                    <p class="p-1 w-10/12 w-full"><i class="fas fa-phone-alt"></i> Call now on 01492 532 362</p>
                </div>
            </a>
        </div>
    </section>
    <section class="fade-in">
        <categories-component :categories="{{json_encode($categories)}}"></categories-component>
    </section>
    <section class="fade-in">
        <testimonial-component :testimonials="{{json_encode($testimonials)}}"></testimonial-component>
    </section>
    <section class="fade-in mt-10">
        <h1 class="text-black text-3xl font-thin mx-2 text-center">Our Work</h1>
        <div class="w-1/6 h-1 bg-black m-2 mb-4 mx-auto mt-3"></div>
        <vue-cool-lightbox :items="{{json_encode($items)}}"></vue-cool-lightbox>
    </section>
    <section class="fade-in">
        <div class="w-full h-12 bg-green-500 text-white font-bold">
            <div class="container max-w-screen-lg p-2">
                <a href="{{route('contact')}}">
                    <p class="p-1 w-10/12 w-full text-center text-uppercase">
                        <i class="far fa-envelope"></i> Contact Us today to start your project
                    </p>
                </a>
            </div>
        </div>
    </section>
@append
