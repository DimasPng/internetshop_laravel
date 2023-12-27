<?php

namespace App\Http\Resources\Product\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): ?array
    {
            return [
                'id' => $this->id,
                'author_name' => $this->author_name,
                'comment' => $this->comment,
                'advantages' => $this->advantages,
                'disadvantages' => $this->disadvantages,
                'rating' => $this->rating,
                'recommend' => $this->recommend,
                'likes' => $this->likes,
                'dislikes' => $this->dislikes
            ];
    }
}
