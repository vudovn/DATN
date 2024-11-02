<?php

namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    protected $model;

    public function __construct(
        Category $model
    ) {
        $this->model = $model;
    }
    public function paginationCategory(array $params = [])
    {
        return $this->model
            ->where('is_room', 2)
            ->condition($params['condition'] ?? [])
            ->keyword($params['keyword'] ?? [])
            ->orderBy($params['sort'][0], $params['sort'][1])
            ->paginate($params['perpage']);
    }

    public function paginationRoom(array $params = [])
    {
        return $this->model
            ->where('is_room', 1)
            ->condition($params['condition'] ?? [])
            ->keyword($params['keyword'] ?? [])
            ->orderBy($params['sort'][0], $params['sort'][1])
            ->paginate($params['perpage']);
    }
}
