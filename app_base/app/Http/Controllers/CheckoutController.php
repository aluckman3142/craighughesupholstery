<?php

namespace App\Http\Controllers;


use App\Http\Requests\Checkout\CheckoutRequest;
use App\Mail\EnquiryMail;
use App\Mail\NewOrderMail;
use App\Mail\OrderPlacedMail;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (auth()->user() && request()->is('guest-checkout')){
            return redirect()->route('checkout.index');
        }
        return view('checkout');
    }

    public function store(CheckoutRequest $request)
    {
        try {
            $contents = Cart::instance('default')->content()->map(function ($item) {
                return $item->model->slug . ', ' . $item->qty;
            })->values()->toJson();

            $order_no = 'CHU-'.rand(100000,999999).'-'.time();

            Stripe::setApiKey(env("STRIPE_SECRET"));

            $charge = Charge::create([
                'amount' => (Cart::total()) * 100,
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Example charge',
                'receipt_email' => $request->email,
                'metadata' => [
                    'order_no' => $order_no,
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count()
                ],
            ]);

            $order = $this->addToOrdersTables($order_no, $request, null, 'Processing');

            Mail::send(new OrderPlacedMail($order));

            Mail::send(new NewOrderMail($order));

            //SUCCESSFUL
            Cart::instance('default')->destroy();

            return redirect()->route('thankyou')->with('success_message', 'Thankyou! Your payment has been accepted!');

        } catch (Exception $e) {
            $this->addToOrdersTables($order_no, $request, 'Payment Error','Failed');
            return back()->withErrors('Payment Error! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTables($order_no, $request, $error, $status)
    {
        $order = Order::create([
            'order_no' => $order_no,
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'email' => $request->email,
            'title' => $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'town' => $request->town,
            'county' => $request->county,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'name_on_card' => $request->name_on_card,
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax(),
            'shipping_cost' => 0,
            'total' => Cart::total(),
            'payment_gateway' => 'stripe',
            'status' => $status,
            'shipped' => 0,
            'error' => $error,
        ]);

        foreach (Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }
}
