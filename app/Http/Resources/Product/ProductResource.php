<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\Characteristic\CharacteristicResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'images' => $this->imageUrl,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'hit' => $this->hit,
            'is_published' => $this->is_published,
            'uri_product' => $this->uri_product,
            'category' => new CategoryResource($this->category),
            'characteristics' => CharacteristicResource::collection($this->characteristics)
        ];
    }
}
