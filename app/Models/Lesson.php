<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'slug', 'video_file_id', 'chapter_id' ];

    /** Relationships */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /** Accessors */
    protected function fileUrl(): Attribute
    {
        return new Attribute(
            get: fn () => ClientHelper::getFileUrlByID($this->video_file_id)
        );
    }
}
