<?php

namespace App\Http\Resources;

use App\Helpers\ClientHelper;
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
            'mentor' => [
                'name' => $this->mentor_name,
                'avatar_url' => $this->mentor_avatar_url
            ]
        ];
    }
}
