<?php

namespace App\Http\Resources;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
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
            'name' => $this->name,

            'course' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'course'),
                (new CourseResource($this->course))
            ),

            'lessons' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'lessons'),
                (new LessonResourceCollection($this->lessons))->toArray($request)['data']
            )
        ];
    }
}
