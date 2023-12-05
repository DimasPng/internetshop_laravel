<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $data['images'] = Storage::disk('public')->put('images', $data['images']);

        $data['is_published'] = $request->input('is_published') ? 1 : 0;

        Product::create($data);
        return redirect(route('products.index'));
    }
}
