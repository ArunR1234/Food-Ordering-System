<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public function checkout()
    {
        $userId = Session::get('user_id');
        $cartItems = Cart::with('menu')->where('user_id', $userId)->get();
        $total = $cartItems->sum(fn($item) => $item->menu->price * $item->quantity);
        if ($cartItems->isEmpty()) {
             return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
        return view('checkout', compact('cartItems', 'total'));
    }



    public function complete(Request $request)
    {
        $userId = Session::get('user_id');
        $cartItems = Cart::with('menu')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending',

        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item->menu_id,
                'quantity' => $item->quantity,
                'price' => $item->menu->price,
            ]);
        }

        Cart::where('user_id', $userId)->delete();

        return redirect()->route('menu')->with('success', 'Order placed successfully!');
    }
}


