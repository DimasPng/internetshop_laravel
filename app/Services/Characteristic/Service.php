<?php

namespace App\Services\Characteristic;

use App\Models\ProductCharacteristic;

class Service
{
    public function store($data)
    {
        $characteristic = ProductCharacteristic::create($data);
        return [
            'id' => $characteristic->id,
            'characteristic_name' => $characteristic->characteristic_name,
        ];

    }
}
