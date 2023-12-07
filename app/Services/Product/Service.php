<?php

namespace App\Services\Product;

use App\Models\Product;

class Service
{
    public function store($request, $data): void
    {
        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $paths[] = $path;
            }
        }

        $data['images'] = json_encode($paths);
        $data['is_published'] = $request->input('is_published') ? 1 : 0;

        Product::create($data);
    }

    public function update($request, $data, $product) {

        if ($request->hasFile('images')) {
            $images = json_decode($product->images);

            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
            $data['images'] = json_encode($images);
        }

        $data['is_published'] = $request->input('is_published') ? 1 : 0;

        $product->update($data);

        return redirect(route('products.index'));
    }
}
