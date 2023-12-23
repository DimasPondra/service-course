<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    private $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $courses = $this->model
            ->when(!empty($params['search']['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['search']['name'] . '%');
            })
            ->when(!empty($params['search']['status']), function ($query) use ($params) {
                return $query->where('status', $params['search']['status']);
            });

        if (!empty($params['paginate'])) {
            return $courses->paginate($params['paginate']);
        }

        return $courses->get();
    }

    public function save(Course $course)
    {
        $course->save();

        return $course;
    }
}
