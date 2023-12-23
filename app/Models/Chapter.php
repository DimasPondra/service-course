<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'slug', 'course_id' ];

    /** Relationships */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
