@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Checkout</title>
@append

@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-44 pb-24">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Craig Hughes Upholstery Checkout</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
                <nav class="flex flex-wrap items-center justify-between px-2 py-3">
                    <div class=" px-4 mx-auto flex flex-wrap items-center justify-between">
                        <div class="w-full relative flex justify-between md:w-auto md:static md:block md:justify-start">
                            <ul>
                                @guest
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('register')}}">REGISTER</a>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('login')}}">LOGIN</a>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('cart.index')}}">CART @if (Cart::count() > 0)<div class="bg-yellow-200 rounded-full h-4 w-4 text-black text-center text-xs ml-2">{{Cart::count()}}</div>@endif</a>
                                    </li>
                                @else
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('my-account')}}">MY ACCOUNT</a>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
                                        </form>
                                    </li>
                                    <li class="nav-item fade-in float-left">
                                        <a class="pr-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75" href="{{ route('cart.index')}}">CART @if (Cart::count() > 0)<div class="bg-yellow-200 rounded-full h-4 w-4 text-black text-center text-xs ml-2">{{Cart::count()}}</div>@endif</a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    @if ($message = Session::get('success_message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                        @if (count($errors) > 0)
                            @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close float-right" data-dismiss="alert">×</button>
                                    <strong>{!! $error !!}</strong>
                            </div>
                            @endforeach
                        @endif
                    <form name="payment-form" id="payment-form" method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Billing Details</h2>
                        <div class="relative mb-4">
                            <label for="email" class="leading-7 text-sm text-gray-600">Email Address</label>
                            @if (auth()->user())
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required readonly>
                            @else
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                @endif
                        </div>
                        <div class="relative mb-4">
                            <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                            <select id="title" name="title" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="">Please Select...</option>
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative mb-4">
                            <label for="forname" class="leading-7 text-sm text-gray-600">First Name</label>
                            <input type="text" id="forename" name="forename" value="{{ old('forename') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                        </div>
                            <div class="relative mb-4">
                                <label for="surname" class="leading-7 text-sm text-gray-600">Last Name</label>
                                <input type="text" id="surname" name="surname" value="{{ old('surname') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                            </div>
                        </div>
                        <div class="relative mb-4">
                            <label for="address1" class="leading-7 text-sm text-gray-600">Address Line 1</label>
                            <input type="text" id="address1" name="address1" value="{{ old('address1') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                        </div>
                        <div class="relative mb-4">
                            <label for="address2" class="leading-7 text-sm text-gray-600">Address Line 2</label>
                            <input type="text" id="address2" name="address2" value="{{ old('address2') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative mb-4">
                                <label for="town" class="leading-7 text-sm text-gray-600">Town</label>
                                <input type="text" id="town" name="town" value="{{ old('town') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                            </div>
                            <div class="relative mb-4">
                                <label for="county" class="leading-7 text-sm text-gray-600">County</label>
                                <input type="text" id="county" name="county" value="{{ old('county') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative mb-4">
                                <label for="postcode" class="leading-7 text-sm text-gray-600">Postcode</label>
                                <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                            </div>
                            <div class="relative mb-4">
                                <label for="phone" class="leading-7 text-sm text-gray-600">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Payment Details</h2>
                        <div class="relative mb-4">
                            <label for="name_on_card" class="leading-7 text-sm text-gray-600">Name on Card</label>
                            <input type="text" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}"class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                        </div>
                        <div class="relative mb-4">
                            <label for="card-element" class="leading-7 text-sm text-gray-600">Card Details</label>
                            <div id="card-element" class="card-element">
                                <!-- Elements will create form elements here -->
                            </div>
                            <div id="card-errors">
                                <!-- Display error message to your customers here -->
                            </div>
                        </div>
                        <button id="btnSubmit" class="w-full hover:bg-red-500 text-md p-3 px-4 bg-green-200 font-bold text-black">Complete Order</button>
                    </form>
                </div>
                <div>
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Your Order</h2>
                    @foreach (Cart::content() as $item)
                    <div class="w-full border-bottom border-gray-200 inline-block p-2">
                        <div class="w-1/6 float-left inline-block">
                            <a href="{{route('shop.product', $item->model->slug)}}">
                            <img src="{{$item->model->images[0]->src}}" class="w-full">
                            </a>
                        </div>
                        <div class="w-2/3 float-left inline-block pl-4">
                            <a href="{{route('shop.product', $item->model->slug)}}"><p>{{$item->model->name}}</p></a>
                            <p class="text-gray-500">SKU: {{$item->model->product_code}}</p>
                            <p class="text-gray-500">{{$item->model->tagline}}</p>
                            <p>&pound;{{$item->price}}</p>
                        </div>
                        <div class="w-1/6 float-left inline-block">
                            <input type="number" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="quantity" name="quantity" min="1" max="10" readonly value="{{$item->qty}}">
                        </div>
                    </div>
                    @endforeach

                    <div class="w-full border-bottom border-gray-200 inline-block p-2">
                        <div class="grid grid-cols-2 gap-2">
                            <div><p>Subtotal</p></div>
                            <div><p class="text-right">&pound;{{Cart::subtotal()}}</p></div>
                            <div><p>Shipping</p></div>
                            <div><p class="text-right">FREE</p></div>
                            <div><p class="font-bold">Total</p></div>
                            <div><p class="font-bold text-right">&pound;{{Cart::total()}}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bg-gray-500 py-5 text-center text-white">
        <div class="container my-5 mx-auto max-w-screen-lg">
            <h1 class="text-2xl font-thin mx-2">Shipping Available to the UK Only</h1>
            <div class="w-1/6 h-1 bg-gray-300 mb-4 mt-3 mx-auto"></div>
            <div class="grid grid-cols-1 gap-8 text-md  mx-2">
                <div>
                    <p class="py-3">
                        Due to feathers being prohibited in some countries we are unable to ship feather scatter cushions. If you would like just a cushion case or fibre fill cushion then please contact us via the contact form for costs.
                    </p>
                </div>
            </div>
        </div>
    </div>
@append
@section('stripe-js')
<script src="https://js.stripe.com/v3/"></script>

<script>

const publishable_key = '{{ env('STRIPE_KEY') }}';

// Create a Stripe client.
var stripe = Stripe(publishable_key);

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
  style: style,
  hidePostalCode: true
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  document.getElementById('btnSubmit').disabled = true;

  var options = {
    name: document.getElementById('name_on_card').value,
    address_line1: document.getElementById('address1').value,
    address_line2: document.getElementById('address2').value,
    address_city: document.getElementById('town').value,
    address_state: document.getElementById('county').value,
    address_zip: document.getElementById('postcode').value,
  }

  stripe.createToken(card, options).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
      document.getElementById('btnSubmit').disabled = false;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@append
