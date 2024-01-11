<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseImage extends Model
{
    use HasFactory;

    protected $fillable = [ 'file_id', 'course_id' ];

    /** Relationships */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /** Accessors */
    protected function imageUrl(): Attribute
    {
        return new Attribute(
            get: fn () => ClientHelper::getFileUrlByID($this->file_id)
        );
    }
}
