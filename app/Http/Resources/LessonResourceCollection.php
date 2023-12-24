<?php

namespace App\Http\Resources;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LessonResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $data = $this->collection->transform(function ($lesson) use ($request) {
            $result = [
                'id' => $lesson->id,
                'name' => $lesson->name,
                'slug' => $lesson->slug,
                'video_url' => $lesson->file_url
            ];

            $checkChapterRelation = RequestHelper::doesQueryParamsHasValue($request->query('include'), 'chapter');
            if ($checkChapterRelation) {
                $result['chapter'] = new ChapterResource($lesson->chapter);
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
