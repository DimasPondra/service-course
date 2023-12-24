<?php

namespace App\Repositories;

use App\Models\CourseImage;

class CourseImageRepository
{
    public function save(CourseImage $courseImage)
    {
        $courseImage->save();

        return $courseImage;
    }
}
