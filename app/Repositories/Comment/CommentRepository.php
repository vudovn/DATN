<?php

namespace App\Repositories\Comment;

use App\Repositories\BaseRepository;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    protected $model;

    public function __construct(
        Comment $model
    ) {
        $this->model = $model;
    }
    public function paginationComment(array $params = [])
    {
        return $this->model
            ->whereNull('deleted_at')
            ->condition($params['condition'] ?? [])
            ->keyword($params['keyword'] ?? [])
            ->orderBy($params['sort'][0], $params['sort'][1])
            ->paginate($params['perpage']);
    }
}
