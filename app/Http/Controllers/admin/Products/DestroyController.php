<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'));
    }
}
