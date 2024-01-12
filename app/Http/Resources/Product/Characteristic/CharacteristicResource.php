<?php
namespace App\Http\Resources\Product\Characteristic;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CharacteristicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'characteristic_name' => $this->characteristic_name,
            'value' => $this->pivot->value,
        ];
    }
}
