<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyCourse extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'course_id' ];

    /** Relationships */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /** Accessors */
    protected function userName(): Attribute
    {
        $user = ClientHelper::getUserByID($this->user_id);
        $name = null;

        if (!empty($user)) {
            $name = $user['data']['name'];
        }

        return new Attribute(
            get: fn () => $name
        );
    }
}
