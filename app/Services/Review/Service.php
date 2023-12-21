<?php

namespace App\Services\Review;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Str;
use function Laravel\Prompts\error;

class Service
{
    public function store($request, $data)
    {
        try {

            $user = User::firstOrCreate(['email' => $data['email']],
                [
                    'name' => $data['author_name'],
                    'email' => $data['email'],
                    'password' => bcrypt(Str::random(7))
                ]);

            $product = Product::find($data['product_id']);
            if (!$product) {
                return response()->json(['error' => 'Товар не найден'], 404);
            }

            $data['user_id'] = $user->id;
            $data['rating'] = $request->input('rating') ? 1 : 0;
            $data['recommend'] = $request->input('recommend') ? 1 : 0;

            Review::create($data);

            return response()->json(['status'=>'ok'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
