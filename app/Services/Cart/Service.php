<?php

namespace App\Services\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Service
{
    public function store($request, $data)
    {
        try {
            $productId = $data['productId'];
            $quantity = $data['quantity'];

            //$userId = Auth::id();
            $sessionId = $request->session()->getId();

            if ($cart = Cart::where(['session_id' => $sessionId, 'product_id' => $productId])->first()) {
                $cart->quantity += $quantity;
                $cart->save();
            } else {
                $cart = Cart::create([
                    'product_id' => $productId,
                    'quantity' => 1,
                    'user_id' => null,
                    'session_id' => $sessionId,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
            ]);
        }
    }
}
