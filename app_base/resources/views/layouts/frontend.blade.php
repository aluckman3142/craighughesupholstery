<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('title')
    <style>
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: red;
            color: white;
            cursor: pointer;
            padding: 10px;
            border-radius: 4px;
        }

        #myBtn:hover {
            background-color: #555;
        }
    </style>
    @yield('extra-headers')
</head>

<body>
<div id="app" v-cloak>
    <div>
        <div>
            <button onclick="topFunction()" id="myBtn" title="Back to top"><i class="far fa-arrow-alt-circle-up"></i> Back To Top</button>
            <section>
                <navbar :menu-items="{{json_encode($menuItems)}}"></navbar>
            </section>

            @yield('middle-content')

            <section>
                <div class="w-full bg-black border-top-1 border-white">
                    <div class="container py-10 px-10 mx-auto max-w-screen-xl">
                        <div class="w-full">
                            <img
                                class="fade-in mr-5"
                                src="{{ asset('img/CraigHughesUpholstery-Logo.png') }}"
                                alt="Craig Hughes Upholstery"
                                width="200"
                            />
                        </div>
                        <div class="w-full">
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mt-10">
                                <div>
                                    <ul class="list-disc list-inside text-white">
                                        @foreach ($menuItems as $menuItem)
                                            <li>
                                                <a href="{{ $menuItem['url_path'] }}">
                                                    {{ $menuItem['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{route('privacy-policy')}}">
                                                Privacy Policy
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('returns-policy')}}">
                                                Returns Policy
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-white col-span-2">
                                    <h2 class="uppercase mb-2 text-lg font-bold">Craig Hughes Upholstery</h2>
                                    <p class="mb-2">20 Grove Road,<br/>
                                        Colwyn Bay,<br/>
                                        North Wales<br/>
                                        LL29 8ER</p>
                                    <p class="mb-2">
                                        <i class="fas fa-phone-alt"></i> 01492 532 362
                                    </p>
                                    <p class="mb-2">
                                        <i class="far fa-envelope"></i>
                                        <a href="mailto:enquiries@craighughesupholstery.co.uk">
                                            enquiries@craighughesupholstery.co.uk
                                        </a>
                                    </p>
                                    <p>
                                        <a href="https://www.facebook.com/craighughesupholstery" target="_blank">
                                            <i class="fab fa-facebook-square text-2xl pr-2"></i>
                                        </a>
                                        <a href="https://twitter.com/CraigHughes666" target="_blank">
                                            <i class="fab fa-twitter text-2xl pr-2"></i>
                                        </a>
                                        <a href="https://www.instagram.com/craighughesupholstery/" target="_blank">
                                            <i class="fab fa-instagram text-2xl pr-2"></i>
                                        </a>
                                        <a href="https://www.pinterest.co.uk/craighughesupho/" target="_blank">
                                            <i class="fab fa-pinterest text-2xl pr-2"></i>
                                        </a>
                                        <a href="https://uk.linkedin.com/in/craig-hughes-1b317869" target="_blank">
                                            <i class="fab fa-linkedin text-2xl pr-2"></i>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-span-2">
                                    <iframe
                                        width="100%"
                                        height="200"
                                        style="border:0"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAwdiIICvheJf0g1rr5fAhe0VwEOjrCI9k&q=Craig+Hughes+Upholstery">
                                    </iframe>
                                </div>
                                <div class="text-white">
                                    <p class="mb-2 text-md font-bold">Open to the public by appointment ONLY</p>
                                    <p class="text-sm font-thin mb-2"> Some images made available with the kind permission of</p>
                                    <img class="mb-2" src="{{ asset('img/DrewPritchard-Logo.png') }}" alt="In association with Drew Pritchard" width="200">
                                    <p class="text-sm font-bold"> In association with:</p>
                                    <a href="" target="_blank" class="text-sm font-thin mb-2"> www.drewpritchard.co.uk</a>
                                    <a href="" target="_blank" class="text-sm font-thin mb-2">ruth-tappin.co.uk</a>
                                    <a href="" target="_blank" class="text-sm font-thin mb-2"> www.nevmorrisblacksmith.co.uk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
@yield('stripe-js')
@yield('extra-js')
</body>
</html>
