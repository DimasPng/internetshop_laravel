<?php

namespace App\Services\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Service
{
    public function store()
    {
        $productId = request()->input('product_id');
        $quantity = request()->input('quantity');

        $userId = Auth::id();
        $sessionId = session()->getId();

        $cart = Cart::where('product_id', $productId)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            }, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'user_id' => $userId ?: null,
                'session_id' => $userId ? null : $sessionId,
            ]);
        }

        return response()->json([
            'message' => 'Success',
        ]);
    }
}
