<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductCharacteristic;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $allCharacteristics = ProductCharacteristic::all();
        return view('admin.products.create', compact('categories', 'allCharacteristics'));
    }
}
