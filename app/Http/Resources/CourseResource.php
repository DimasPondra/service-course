<?php

namespace App\Http\Resources;

use App\Helpers\ClientHelper;
use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'description' => $this->description,
            'type' => $this->type,
            'certificate' => $this->certificate_status,
            'level' => $this->level,
            'status' => $this->status,
            'price' => $this->price,
            'thumbnail_url' => $this->file_url,
            'total_students' => $this->total_students,
            'total_videos' => $this->total_videos,

            'mentor' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'mentor'),
                ([
                    'id' => $this->mentor_user_id,
                    'name' => $this->mentor_name,
                    'avatar_url' => $this->mentor_avatar_url
                ])
            ),

            'chapters' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'chapters'),
                (new ChapterResourceCollection($this->chapters))->toArray($request)['data']
            ),

            'images' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'images'),
                (new CourseImageResourceCollection($this->images))->toArray($request)['data']
            ),

            'reviews' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'reviews'),
                (new ReviewResourceCollection($this->reviews))->toArray($request)['data']
            )

        ];
    }
}
