<?php

namespace App\Http\Resources;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'rate' => $this->rate,
            'note' => $this->note,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user_name
            ],

            'course' => $this->when(
                RequestHelper::doesQueryParamsHasValue($request->query('include'), 'course'),
                (new CourseResource($this->course))
            )
        ];
    }
}
