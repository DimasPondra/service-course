<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'type',
        'certificate', 'level', 'status', 'price',
        'thumbnail_file_id', 'mentor_user_id'
    ];

    /** Relationships */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CourseImage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(MyCourse::class);
    }

    /** Accessors */
    protected function certificateStatus(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->certificate ? 'available' : 'unavailable'
        );
    }

    protected function fileUrl(): Attribute
    {
        return new Attribute(
            get: fn () => ClientHelper::getFileUrlByID($this->thumbnail_file_id)
        );
    }

    protected function mentorName(): Attribute
    {
        $mentor = ClientHelper::getUserByID($this->mentor_user_id);
        $name = null;

        if (!empty($mentor)) {
            $name = $mentor['data']['name'];
        }

        return new Attribute(
            get: fn () => $name
        );
    }

    protected function mentorAvatarUrl(): Attribute
    {
        $mentor = ClientHelper::getUserByID($this->mentor_user_id);
        $avatarUrl = null;

        if (!empty($mentor)) {
            $avatarUrl = $mentor['data']['avatar_url'];
        }

        return new Attribute(
            get: fn () => $avatarUrl
        );
    }

    protected function totalStudents(): Attribute
    {
        return new Attribute(
            get: fn () => $this->students->count()
        );
    }

    protected function totalVideos(): Attribute
    {
        $total = $this->chapters->sum(function ($chapter) {
            return $chapter->lessons->count();
        });

        return new Attribute(
            get: fn () => $total
        );
    }
}
