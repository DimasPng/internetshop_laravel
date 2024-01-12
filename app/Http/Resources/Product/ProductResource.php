<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\Characteristic\CharacteristicResource;
use App\Http\Resources\Product\Review\ReviewResource;
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
        $filteredReviews = $this->reviews->filter(function ($review) {
            return $review->moderation_status === 0;
        });
        $sortReviews = $filteredReviews->sortByDesc('created_at');

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
            'characteristics' => CharacteristicResource::collection($this->characteristics),
            'reviews' => ReviewResource::collection($sortReviews)
        ];
    }
}
