<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository
{

    protected $model;

    public function __construct(
        Product $model
    ) {
        $this->model = $model;
    }
    public function filterProduct(array $params = [])
    {
        return $this->model
            ->relation($params['relation'] ?? [], $this->model)
            ->condition($params['condition'] ?? [])
            ->keyword($params['keyword'] ?? [])
            // ->orderBy($params['sort'][0], $params['sort'][1])
            ->paginate($params['perpage'])
        ;
    }




}