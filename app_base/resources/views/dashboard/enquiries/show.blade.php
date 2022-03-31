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
            <h1>General Enquiry From {{$enquiry->name}}</h1>
                <h5><a href="{{ URL::to('dashboard/enquiries') }}"><button class="btn btn-success btn-sm uppercase">Back</button></a></h5>
            <hr>
                <p>Recieved: {{$enquiry->created_at}}</p>
            <p>Name: {{$enquiry->name}}</p>
                <p>Email: <a href="mailto:{{$enquiry->email}}?subject=Re: {{$enquiry->subject}}">{{$enquiry->email}}</a> (click to reply)</p>
                <p>Subject: {{$enquiry->subject}}</p>
                <p>Message: {{$enquiry->message}}</p>
                <p>Image: <img src="{{$enquiry->image}}"> </p>
    </div>

</x-app-layout>
