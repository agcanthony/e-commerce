<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $order = Order::create(['products' => json_encode($cart)]);
        session()->forget('cart');

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }
}

