<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AccountController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();

        return view('account')->with(compact('orders'));
    }
}
