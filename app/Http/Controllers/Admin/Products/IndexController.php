<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $products = Product::paginate(20);
        return view('admin.products.index', compact('products', 'categories'));
    }
}
