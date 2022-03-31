<?php

namespace App\Http\Controllers;

use App\Mail\OrderCancelledMail;
use App\Mail\OrderShippedMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at')->get();

        return View::make('dashboard.orders.view')
            ->with(compact('orders'));
    }

    public function view(Order $order)
    {
        return View::make('dashboard.orders.manage')->with(compact('order'));
    }

    public function ship(Order $order){
        $order->update([
            'shipped' => 1,
            'status' => 'Dispatched',
        ]);

        Mail::send(new OrderShippedMail($order));

        Session::flash('success_message', 'Successfully shipped order!');
        return Redirect::to('dashboard/orders/'.$order->id.'/view');
    }

    public function cancel(Order $order){
        $order->update([
            'shipped' => 0,
            'status' => 'Cancelled',
        ]);

        Mail::send(new OrderCancelledMail($order));

        Session::flash('success_message', 'Successfully cancelled order!');
        return Redirect::to('dashboard/orders/'.$order->id.'/view');
    }

    public function show(Product $product)
    {
        return view('product')->with(compact('product'));
    }

}
