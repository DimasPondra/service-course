<?php

namespace App\Http\Resources;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MyCourseResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $data = $this->collection->transform(function ($myCourse) use ($request) {
            $result = [
                'id' => $myCourse->id,
                'user' => [
                    'id' => $myCourse->user_id,
                    'name' => $myCourse->user_name
                ],
            ];

            $checkCourseRelation = RequestHelper::doesQueryParamsHasValue($request->query('include'), 'course');
            if ($checkCourseRelation) {
                $result['course'] = new CourseResource($myCourse->course);
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
