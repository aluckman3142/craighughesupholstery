<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <div class="m-5">
        <div class="grid grid-cols-1 gap-4">
            <div>
            <h1>Upholstery Class Enquiry From {{$enquiry->name}}</h1>
                <h5><a href="{{ URL::to('dashboard/upholstery-enquiries') }}"><button class="btn btn-success btn-sm uppercase">Back</button></a></h5>
            <hr>
                <p>Recieved: {{$enquiry->created_at}}</p>
            <p>Name: {{$enquiry->name}}</p>
                <p>Email: <a href="mailto:{{$enquiry->email}}?subject=Re: {{$enquiry->subject}}">{{$enquiry->email}}</a> (click to reply)</p>
                <p>Subject: {{$enquiry->subject}}</p>
                <p>Project Description: {{$enquiry->project_description}}</p>
                <p>Project Dimensions: {{$enquiry->width}}w x {{$enquiry->depth}}d x {{$enquiry->height}}h</p>
                <p>Days Required: {{$enquiry->days_required}}</p>
                <p>Requested Start Date: {{$enquiry->start_date}}</p>
                <p>Requested End Date: {{$enquiry->end_date}}</p>
                <p>Image: <img src="{{$enquiry->image}}"> </p>
    </div>

</x-app-layout>
