<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {
        $categories = Category::all();
        $allCharacteristics = ProductCharacteristic::all();
        $characteristics = $product->characteristics;
        return view('admin.products.edit', compact('categories', 'product', 'characteristics', 'allCharacteristics'));
    }
}
