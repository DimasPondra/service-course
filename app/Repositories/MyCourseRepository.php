<?php

namespace App\Repositories;

use App\Models\MyCourse;

class MyCourseRepository
{
    private $model;

    public function __construct(MyCourse $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $myCourses = $this->model
            ->when(!empty($params['search']['user_id']), function ($query) use ($params) {
                return $query->where('user_id', $params['search']['user_id']);
            });

        return $myCourses->get();
    }

    public function save(MyCourse $myCourse)
    {
        $myCourse->save();

        return $myCourse;
    }
}
