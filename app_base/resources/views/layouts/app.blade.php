<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Craig Hughes Upholstery Dashboard</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
                <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
                    <div @click.away="open = false" class="flex flex-col w-full md:w-64 text-white bg-gray-800 flex-shrink-0" x-data="{ open: false }">
                        <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
                            <img src="/img/CraigHughesUpholstery-Logo.png" width="200px">
                            <button class="rounded-lg md:hidden rounded-lg" @click="open = !open">
                                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
                            <a class="@if(request()->route()->uri == 'dashboard') bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/menu-items','dashboard/menu-items/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200" href="{{ route('dashboard.menu-items') }}">Menu Items</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/posts','dashboard/posts/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200" href="{{ route('dashboard.posts') }}">Posts</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/categories','dashboard/categories/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200" href="{{ route('dashboard.categories') }}">Categories</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/category-images','dashboard/category-images/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 " href="{{ route('dashboard.category-images') }}">Category Images</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/before-after','dashboard/before-after/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 " href="{{ route('dashboard.before-after') }}">Before &amp; After Images</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/sliders','dashboard/sliders/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 " href="{{ route('dashboard.sliders') }}">Slideshow</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/testimonials','dashboard/testimonials/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 " href="{{ route('dashboard.testimonials') }}">Testimonials</a>
                            <a class="@if(in_array(request()->route()->uri, ['dashboard/accommodation-images','dashboard/accommodation-images/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 " href="{{ route('dashboard.accommodation-images') }}">Accommodation Images</a>
                            <a class="@if(in_array(request()->route()->uri, [ 'dashboard/fabric-links','dashboard/fabric-links/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 e" href="{{ route('dashboard.fabric-links') }}">Fabric Links</a>
                            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="@if(in_array(request()->route()->uri, [ 'dashboard/enquiries','dashboard/upholstery-enquiries'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left rounded-lg md:block hover:text-gray-900 hover:bg-gray-200">
                                    <span>Enquiries</span>
                                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class=" text-black absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg" style="z-index: 100;">
                                    <div class="px-2 py-2 bg-white rounded-md shadow">
                                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900" href="{{ route('dashboard.enquiries') }}">General Enquiries</a>
                                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900" href="{{ route('dashboard.upholstery-enquiries') }}">Upholstery Classes</a>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <a class="@if(in_array(request()->route()->uri, [ 'dashboard/products','dashboard/products/create'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 e" href="{{ route('dashboard.products') }}">Products</a>
                            <a class="@if(in_array(request()->route()->uri, [ 'dashboard/orders'])) bg-gray-200 text-gray-900 @else bg-transparent text-white @endif block px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-gray-900 hover:bg-gray-200 e" href="{{ route('dashboard.orders') }}">Orders</a>
                            <hr/>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="block px-4 py-2 mt-2 text-sm font-semibold text-white bg-transparent rounded-lg hover:text-gray-900">
                                        <div>{{ Auth::user()->name }}<svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg</div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </nav>
                    </div>
                    <!-- Page Content -->
                    <main class="w-full">
                        {{ $slot }}
                    </main>
                </div>

        </div>
    </body>
</html>
