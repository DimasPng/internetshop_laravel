<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.show', compact('product', 'categories'));
    }
}
