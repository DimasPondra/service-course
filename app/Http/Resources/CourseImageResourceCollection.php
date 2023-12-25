<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseImageResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $data = $this->collection->transform(function ($courseImage) use ($request) {
            return [
                'id' => $courseImage->id,
                'image_url' => $courseImage->image_url
            ];
        });

        return ['data' => $data];
    }
}
