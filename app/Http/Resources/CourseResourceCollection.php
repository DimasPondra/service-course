<?php

namespace App\Http\Resources;

use App\Helpers\ClientHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $data = $this->collection->transform(function ($course) use ($request) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'slug' => $course->slug,
                'type' => $course->type,
                'level' => $course->level,
                'price' => $course->price,
                'thumbnail_url' => $course->file_url
            ];
        });

        return [
            'status' => 'success',
            'message' => 'Successfully load data.',
            'data' => $data
        ];
    }
}
