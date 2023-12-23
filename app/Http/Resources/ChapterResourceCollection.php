<?php

namespace App\Http\Resources;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChapterResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $data = $this->collection->transform(function ($chapter) use ($request) {
            $result = [
                'id' => $chapter->id,
                'name' => $chapter->name,
                'slug' => $chapter->slug,
            ];

            $checkCourseRelation = RequestHelper::doesQueryParamsHasValue($request->query('include'), 'course');
            if ($checkCourseRelation) {
                $result['course'] = new CourseResource($chapter->course);
            }

            return $result;
        });

        return [
            'status' => 'success',
            'message' => 'Successfully load data.',
            'data' => $data
        ];
    }
}
