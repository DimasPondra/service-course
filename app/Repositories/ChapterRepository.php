<?php

namespace App\Repositories;

use App\Models\Chapter;

class ChapterRepository
{
    private $model;

    public function __construct(Chapter $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $chapters = $this->model
            ->when(!empty($params['search']['course_id']), function ($query) use ($params) {
                return $query->where('course_id', $params['search']['course_id']);
            });

        return $chapters->get();
    }

    public function save(Chapter $chapter)
    {
        $chapter->save();

        return $chapter;
    }
}
