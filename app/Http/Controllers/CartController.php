<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cart()
    {
        $userId = Session::get('user_id');

        $cartItems = Cart::with('menu')->where('user_id', $userId) ->get();

        $total = $cartItems->sum(fn($item) => $item->menu->price * $item->quantity);

        return view('cart', compact('cartItems', 'total'));
    }


    public function cartadd(Request $request, $id)
    {
        $userId = session()->get('user_id');
        $menu   = Menu::find($id);

        if (!$menu) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Item not found.'], 404);
            }
            return back()->with('error', 'Item not found.');
        }

        $cart = Cart::where('menu_id', $id)->where('user_id', $userId)->first();

        if ($cart) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Item already added to cart!']);
            }
            return redirect()->back()->with('error', 'Item already added to cart!');
        }

        Cart::create([
            'menu_id' => $id,
            'quantity' => 1,
            'user_id' => $userId,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => 'Item added to cart!']);
        }

        return back()->with('success', 'Item added to cart!');
    }


    public function cartremove($id)
    {
        $userId = session()->get('user_id');
        Cart::where('id', $id)->where('user_id', $userId)->delete();

        return redirect()->route('cart')->with('success', 'Item removed successfully!');
    }

    public function liveUpdate(Request $request)
{
    $userId = Session::get('user_id');
    $cartItem = Cart::where('id', $request->id)->where('user_id', $userId)->first();

    if ($cartItem) {
        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->back();
    }

    return response()->json(['error' => 'Item not found'], 404);
}

}
