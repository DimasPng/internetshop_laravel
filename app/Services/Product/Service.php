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
}
