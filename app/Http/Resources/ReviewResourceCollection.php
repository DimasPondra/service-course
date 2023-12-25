<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $data = $this->collection->transform(function ($review) use ($request) {
            return [
                'id' => $review->id,
                'rate' => $review->rate,
                'note' => $review->note,
                'user' => [
                    'id' => $review->user_id,
                    'name' => $review->user_name,
                    'avatar_url' => $review->user_avatar_url
                ]
            ];
        });

        return ['data' => $data];
    }
}
