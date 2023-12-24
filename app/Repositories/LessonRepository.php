<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    private $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $lessons = $this->model;

        return $lessons->get();
    }

    public function save(Lesson $lesson)
    {
        $lesson->save();

        return $lesson;
    }
}
