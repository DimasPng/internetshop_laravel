<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RemoveImageController extends Controller
{
    public function __invoke(Request $request, Product $product)
    {

        $imageId = $request->input('imageId');

        $images = json_decode($product->images);

        $imagesPath = $images[$imageId];

        unset($images[$imageId]);

        $product->images = json_encode(array_values($images));
        $product->save();

        Storage::disk('public')->delete($imagesPath);

        return response()->json([
            'success' => true
        ]);
    }
}
