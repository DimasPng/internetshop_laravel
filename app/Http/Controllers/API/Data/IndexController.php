<?php

namespace App\Http\Controllers\API\Data;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Data\DataResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $products = Product::all();

        return new DataResource([
           'categories' => CategoryResource::collection($categories),
           'products' => ProductResource::collection($products),
        ]);

    }
}
