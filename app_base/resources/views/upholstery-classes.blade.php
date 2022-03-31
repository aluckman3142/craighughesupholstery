@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Classes</title>
@append
@section('middle-content')
    <div class="w-full bg-classes-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Craig Hughes Upholstery Classes</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <h1 class="text-2xl font-thin mx-2">Bring Your Own Project Classes</h1>
            <div class="w-1/6 h-1 bg-gray-300 m-2 mb-4 mt-3"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-md mx-2">
                <div>
                    <p class="text-lg py-3">
                        Come along on our <span class="font-bold">“Bring Your Own Upholstery Project Classes”</span>
                        hosted by Craig Hughes ‘ Expert Upholsterer on Quest TV, Salvage Hunters & Salvage Hunters The
                        Restorers. We’d love to welcome you to our workshop in the seaside town of Colwyn Bay.
                    </p>
                    <p class="text-md py-3">
                        Craig will provide you with all the advice and help you need to master how to upholster.
                        He will show you modern techniques and the tools you need to give your piece of furniture, a
                        new lease of life. Whether it is an Ercol chair, an armchair, a cocktail chair or even a footstool,
                        you are guaranteed to go away with something special and a day(s) to remember.
                    </p>
                    <p class="text-md py-3">
                        Our <span class="font-bold">"bring your own project classes”</span> are small and limited to 2 people, so you will have plenty
                        of teaching time with Craig. All tools are provided on the day basic materials are included except
                        replacement foam seating and fire retardant Crib 5 wool interliner. This can be purchased on the
                        day. All you need to bring is your project and Upholstery fabric of choice, we do have small
                        amounts of Roll ends available to purchase on the day.
                    </p>
                </div>
                <div>
                    <img src="img/upholstery-classes.jpeg" class="w-full">
                </div>
                <div class="md:col-span-2">
                    <p class="text-lg py-3">
                        How To Book
                    </p>
                    <p class="text-md py-3">
                        Complete the form below with a picture of your project, a brief description
                        of your piece of furniture, rough dimensions and dates you would like to book
                        <span class="font-bold">(we can’t promise the exact dates but will try to accommodate you).</span>
                        This will help us give you an idea of fabric amounts and determine how many days will be needed
                        to complete your project for your special day(s). We will then get back to you with details
                        and dates available .
                    </p>
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close float-right" data-dismiss="alert">×</button>
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                    @if ($message = Session::get('message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close float-right" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form enctype="multipart/form-data" name="upholstery-enquiry-form" id="upholstery-enquiry-form" method="post" action="{{ URL::to('upholstery-class-enquiry/store') }}">
                        @csrf
                        @honeypot
                        <div class="relative mb-4">
                            <label for="name" class="leading-7 text-sm text-gray-600">Your Name (required)</label>
                            <input type="text" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('name') }}">
                        </div>
                        <div class="relative mb-4">
                            <label for="email" class="leading-7 text-sm text-gray-600">Your Email (required)</label>
                            <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('email') }}">
                        </div>
                        <div class="relative mb-4">
                            <label for="subject" class="leading-7 text-sm text-gray-600">Subject (required)</label>
                            <input type="text" id="subject" name="subject" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('subject') }}">
                        </div>
                        <div class="relative mb-4">
                            <label for="project_description" class="leading-7 text-sm text-gray-600">Project Description</label>
                            <textarea id="project_description" name="project_description" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('project_description') }}</textarea>
                        </div>
                        <div class="relative mb-4">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="days_required" class="leading-7 text-sm text-gray-600">Days Required (required)</label>
                                    <input type="text" id="days_required" name="days_required" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('days_required') }}">
                                </div>
                                <div>
                                    <label for="start_date" class="leading-7 text-sm text-gray-600">Start Date (required)</label>
                                    <input type="date" id="start_date" name="start_date" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('start_date') }}">
                                </div>
                                <div>
                                    <label for="end_date" class="leading-7 text-sm text-gray-600">End Date (required)</label>
                                    <input type="date" id="end_date" name="end_date" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('end_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="relative mb-4">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="width" class="leading-7 text-sm text-gray-600">Width (required)</label>
                                    <input type="text" id="width" name="width" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('width') }}">
                                </div>
                                <div>
                                    <label for="depth" class="leading-7 text-sm text-gray-600">Depth (required)</label>
                                    <input type="text" id="depth" name="depth" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('depth') }}">
                                </div>
                                <div>
                                    <label for="height" class="leading-7 text-sm text-gray-600">Height (required)</label>
                                    <input type="text" id="height" name="height" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('height') }}">
                                </div>
                            </div>
                        </div>
                        <div class="relative mb-4">
                            <label for="upload" class="leading-7 text-sm text-gray-600">Upload Image</label>
                            <input type="file" id="upload" name="upload">
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <div class="flex">
                                    <span class="pt-4">{!! captcha_img() !!}</span>
                                    <button type="button" class="hover:bg-white text-md mt-4 py-2 px-4 bg-gray-200 font-thin text-black border border-gray-300" class="reload" id="reload">
                                        ↻
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                        </div>
                        <button type="submit" class="hover:bg-white text-md mt-4 py-2 px-4 bg-gray-200 font-thin text-black border border-gray-300" >Send Enquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@append

@section('extra-js')
    <script type="text/javascript">
    $('#reload').click(function () {
      $.ajax({
        type: 'GET',
        url: 'reload-captcha-upholstery-enquiry',
        success: function (data) {
          $(".captcha span").html(data.captcha);
        }
      });
    });
    </script>
@append
