<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{

    public function index()
    {
        return view('cart');
    }

    public function store(Product $product)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product){
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Item is already in the cart.');
        }

        $cartItem = Cart::add($product->id, $product->name,1, $product->price);
        Cart::associate($cartItem->rowId, \App\Models\Product::class);

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
    }

    public function update(Request $request, $id)
    {
        Cart::update($id, $request->quantity);

        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    public function empty()
    {
        Cart::destroy();
        Cart::instance('saveForLater')->destroy();
    }

    public function destroy($id)
    {
        $inCart = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        $inSaved = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if ($inCart->isNotEmpty()){
            Cart::instance('default')->remove($id);
        }
        if ($inSaved->isNotEmpty()){
            Cart::instance('saveForLater')->remove($id);
        }

        return back()->with('success_message', 'Item has been removed!');
    }

    public function switchToSaveForLater($id)
    {
        $product = Cart::instance('default')->get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Item is already saved for later.');
        }

        $cartItem = Cart::instance('saveForLater')->add($product->id, $product->name,1, $product->price);
        Cart::associate($cartItem->rowId, \App\Models\Product::class);

        return redirect()->route('cart.index')->with('success_message', 'Item has been Saved for Later!');
    }

    public function moveToCart($id)
    {
        $product = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart.');
        }

        $cartItem = Cart::instance('default')->add($product->id, $product->name,1, $product->price);
        Cart::associate($cartItem->rowId, \App\Models\Product::class);

        return redirect()->route('cart.index')->with('success_message', 'Item has been Moved to your cart!');
    }
}
