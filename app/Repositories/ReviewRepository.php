<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    private $model;

    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    public function save(Review $review)
    {
        $review->save();

        return $review;
    }
}
