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
        $chapters = $this->model;

        return $chapters->get();
    }

    public function save(Chapter $chapter)
    {
        $chapter->save();

        return $chapter;
    }
}
