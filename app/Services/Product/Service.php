<?php

namespace App\Services\Product;

use App\Models\Product;
use function PHPUnit\Framework\isEmpty;

class Service
{
    public function store($request, $data): void
    {

        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $absolutePath = storage_path('app/public/' . $path);
                chmod($absolutePath, 0777); 
                $paths[] = $path;
            }
        }

        $data['images'] = json_encode($paths);
        $data['hit'] = $request->input('hit') ? 1 : 0;
        $data['is_published'] = $request->input('is_published') ? 1 : 0;
        $characteristics = $data['characteristics'];
        $characteristicsArray = json_decode($characteristics, true);

        unset($data['characteristics']);

        $product = Product::create($data);

        $characteristics = [];
        foreach ($characteristicsArray as $characteristic) {
            list($characteristicId, $value) = explode('|', $characteristic);
            $characteristics[$characteristicId] = ['value' => $value];
        }
        $product->characteristics()->attach($characteristics);

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

        $data['hit'] = $request->input('hit') ? 1 : 0;
        $data['is_published'] = $request->input('is_published') ? 1 : 0;

        if(isset($data['characteristics'])) {
            $characteristics = $data['characteristics'];
            $characteristicsArray = json_decode($characteristics, true);
            $characteristicsArray = is_array($characteristicsArray) ? $characteristicsArray : [json_decode($characteristics)];
        }

        unset($data['characteristics']);

        $product->update($data);


            $dataToSync = [];
            foreach ($characteristicsArray as $characteristic) {

                    list($characteristicId, $value) = explode('|', $characteristic);
                    $dataToSync[$characteristicId] = ['value' => $value];

            }
            $product->characteristics()->sync($dataToSync);


        return redirect(route('products.index'));
    }
}
