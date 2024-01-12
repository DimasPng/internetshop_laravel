<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{
    public function __invoke(Product $product)
    {
        foreach (json_decode($product->images) as $image) {
            Storage::disk('public')->delete($image);
        }
        $product->characteristics()->delete();
        $product->delete();
        return redirect(route('products.index'));
    }
}
