<?php

namespace App\Http\Resources;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'video_url' => $this->file_url,

            'chapter' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'chapter'),
                (new ChapterResource($this->chapter))
            )
        ];
    }
}
