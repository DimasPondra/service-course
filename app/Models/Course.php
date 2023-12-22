<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "slug", "description", "type",
        "certificate", "level", "status", "price",
        "thumbnail_file_id", "mentor_user_id"
    ];
}
