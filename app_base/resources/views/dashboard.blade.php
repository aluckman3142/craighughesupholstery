<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                    Welcome to the Craig Hughes Uphostery Dashboard
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    Here you can manage your online orders, customer enquiries, upholstery class requests and category
                    content/photos. You can also configure menu items and homepage slides. Choose a menu option or click
                    below to get started.</p>
            </div>
            <div class="flex flex-wrap -m-4 text-center">
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <a href="{{ URL::to('dashboard/orders/') }}">
                        <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                            <i class="fas fa-shopping-cart text-4xl pb-4"></i>
                            <h2 class="title-font font-medium text-3xl text-gray-900">{{$orders}}</h2>
                            <p class="leading-relaxed">New Orders</p>
                        </div>
                    </a>
                </div>

                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <a href="{{ URL::to('dashboard/enquiries/') }}">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <i class="far fa-envelope text-4xl pb-4"></i>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{$enquiries}}</h2>
                        <p class="leading-relaxed">New Enquiries</p>
                    </div>
                    </a>
                </div>

                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <a href="{{ URL::to('dashboard/upholstery-enquiries/') }}">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-4xl pb-4"></i>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{$upholsteryEnquiries}}</h2>
                        <p class="leading-relaxed">New Class Enquiries</p>
                    </div>
                    </a>
                </div>
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <a href="{{ URL::to('dashboard/categories/') }}">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <i class="fas fa-couch text-4xl pb-4"></i>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{$categories}}</h2>
                        <p class="leading-relaxed">Active Categories</p>
                    </div>
                    </a>
                </div>
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <a href="{{ URL::to('dashboard/sliders/') }}">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <i class="far fa-images text-4xl pb-4"></i>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{$slides}}</h2>
                        <p class="leading-relaxed">Active Slides</p>
                    </div>
                    </a>
                </div>
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <a href="{{ URL::to('dashboard/posts/') }}">
                        <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                            <i class="far fa-newspaper text-4xl pb-4"></i>
                            <h2 class="title-font font-medium text-3xl text-gray-900">{{$posts}}</h2>
                            <p class="leading-relaxed">Active Posts</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
