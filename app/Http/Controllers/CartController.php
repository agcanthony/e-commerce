<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);

        return response()->json(['count' => $count]);
    }
    
    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $cart = session()->get('cart', []);
        $product = [
            'id' => $product_id,
            'description' => 'Produto ' . $product_id,
            'price' => 10.00 * $product_id
        ];

        if(isset($cart[$product_id])) {
            $cart[$product_id]['quantity']++;
        } else {
            $cart[$product_id] = [
                'product' => $product,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function view()
    {
        $cart = session()->get('cart', []);
        return view('cart.view', compact('cart'));
    }

    public function remove(Request $request)
    {
        // dd($request);
        $product_id = $request->input('product_id');
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
}
