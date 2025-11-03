<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Twilio\Rest\Client;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.menu'])->orderBy('created_at', 'desc')->get();
        return view('order', compact('orders'));
    }

    public function deleteorder($id)
    {
        Order::find($id)?->delete();
        return back()->with('success', 'Order deleted successfully');
    }

    public function track()
    {
        $userId = session('user_id');
        $orders = Order::with('items.menu')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('track-orders', compact('orders'));
    }

    public function trackDetails($id)
    {
        $userId = session('user_id');
        $order = Order::with('items.menu')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
        return view('track-order-details', compact('order'));
    }

    public function fetchCustomerOrders()
{
    $userId = session('user_id');

    $orders = Order::with('items.menu')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($orders);
}



}
