<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [ 'rate', 'note', 'user_id', 'course_id' ];

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

        if ($user) {
            $name = $user['data']['name'];
        }

        return new Attribute(
            get: fn () => $name
        );
    }

    protected function userAvatarUrl(): Attribute
    {
        $user = ClientHelper::getUserByID($this->user_id);
        $avatarUrl = null;

        if ($user) {
            $avatarUrl = $user['data']['avatar_url'];
        }

        return new Attribute(
            get: fn () => $avatarUrl
        );
    }
}
