@extends('layouts.frontend')
@section('title')
    <title>Contact Craig Hughes Upholstery</title>
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Contact Craig Hughes Upholstery</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="fade-in">
<div class="bg-gray-500 py-5 text-center text-white">
        <div class="container my-5 mx-auto max-w-screen-lg">
            <h1 class="text-2xl font-thin mx-2">Covid-19 Update</h1>
            <div class="w-1/6 h-1 bg-gray-300 mb-4 mt-3 mx-auto"></div>
            <div class="grid grid-cols-1 gap-8 text-md  mx-2">
                <div>
                    <p class="py-3">
                        To comply with the social distancing rules we need people to email or phone to make an
                        appointment so that we can ensure your safety & ours. We will try to reply quickly but due
                        to the volume of calls /emails it is taking a little longer.
                    </p>
                    <p class="py-1 text-xl">
                        Opening Times
                    </p>
                    <p class="py-1">
                    By Appointment ONLY.
                    </p>
                    <p class="py-1">
                    Open to the public for pre-booked appointments ONLY.
                    </p>
                    <p class="py-1">
                    Please call or email to request an appointment.
                    </p>
                </div>
            </div>
        </div>
</div>
        <div class="container my-5 mx-auto max-w-screen-lg">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close float-right" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <h1 class="text-2xl font-thin mx-2">Quotations</h1>
            <div class="w-1/6 h-1 bg-gray-300 mb-4 mt-3 mx-2"></div>
            <div class="grid grid-cols-1 gap-8 text-md  mx-2">
                <div>
                    <p class="py-3">
                        We are asked daily if we can make personal visits / estimates. We wish it could be different
                        but at the moment we are unable to offer this service. We are happy to provide estimates via
                        email if you forward pictures of your furniture to us.
                    </p>
                </div>
            </div>
            <h1 class="text-2xl font-thin mx-2">Emails</h1>
            <div class="w-1/6 h-1 bg-gray-300 mb-4 mt-3 m-2"></div>
            <div class="grid grid-cols-1 gap-8 text-md  mx-2">
                <div>
                    <p class="py-3">
                        I do receive a huge amount of emails every day and I will always give each one my full attention.
                        I may not have time to get back to you personally but I really appreciate the time you have taken
                        to email me. In most cases you will receive your response from Mrs H, and not me personally.
                        Please do not be offended if we do not respond immediately we try very hard to reply as quickly
                        as possible.
                    </p>
                </div>
            </div>
            <h1 class="text-2xl font-thin mx-2">Meeting Craig</h1>
            <div class="w-1/6 h-1 bg-gray-300 mb-4 mt-3 m-2"></div>
            <div class="grid grid-cols-1 gap-8 text-md  mx-2">
                <div>
                    <p class="py-3">
                        I am occasionally asked if I can arrange days out or if it's possible to meet me at the workshop
                        to chat about the show. Mrs H is happy to arrange autographs and answer messages and questions
                        about the show.
                    </p>
                </div>
            </div>
            <div class="text-center my-5">
                <p>
                    <a href="https://www.facebook.com/craighughesupholstery" target="_blank">
                        <i class="fab fa-facebook-square text-4xl pr-4"></i>
                    </a>
                    <a href="https://twitter.com/CraigHughes666" target="_blank">
                        <i class="fab fa-twitter text-4xl pr-4"></i>
                    </a>
                    <a href="https://www.instagram.com/craighughesupholstery/" target="_blank">
                        <i class="fab fa-instagram text-4xl pr-4"></i>
                    </a>
                    <a href="https://www.pinterest.co.uk/craighughesupho/" target="_blank">
                        <i class="fab fa-pinterest text-4xl pr-4"></i>
                    </a>
                    <a href="https://uk.linkedin.com/in/craig-hughes-1b317869" target="_blank">
                        <i class="fab fa-linkedin text-4xl"></i>
                    </a>
                </p>
            </div>
        </div>

        <section class="text-gray-600 body-font relative fade-in">

            <div class="absolute inset-0 bg-gray-300">
                <iframe width="100%" height="100%" title="map" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2384.7993826358625!2d-3.7238187841635613!3d53.293128679967886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4865202db304d407%3A0xbd5ef80625849116!2sCraig%20Hughes%20Upholstery!5e0!3m2!1sen!2suk!4v1638836147272!5m2!1sen!2suk" style=""></iframe>
            </div>
            <div class="container px-5 py-24 mx-auto flex">
                <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Enquiry Form</h2>
                    <p class="leading-relaxed mb-5 text-gray-600">Please use this contact form for general enquiries, or upload a picture of your furniture for quotation purposes.</p>
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close float-right" data-dismiss="alert">×</button>
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                    <form enctype="multipart/form-data" name="enquiry-form" id="enquiry-form" method="post" action="{{ URL::to('enquiry/store') }}">
                        @csrf
                        @honeypot
                    <div class="relative mb-4">
                        <label for="name" class="leading-7 text-sm text-gray-600">Your Name (required)</label>
                        <input type="text" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                        <div class="relative mb-4">
                            <label for="email" class="leading-7 text-sm text-gray-600">Your Email (required)</label>
                            <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="subject" class="leading-7 text-sm text-gray-600">Subject (required)</label>
                            <input type="text" id="subject" name="subject" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    <div class="relative mb-4">
                        <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                        <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
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
        </section>
    </section>

@append

@section('extra-js')
    <script type="text/javascript">
    $('#reload').click(function () {
      $.ajax({
        type: 'GET',
        url: 'reload-captcha-enquiry',
        success: function (data) {
          $(".captcha span").html(data.captcha);
        }
      });
    });
    </script>
@append

