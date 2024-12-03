<?php
namespace App\Repositories\Slide;
use App\Repositories\BaseRepository;
use App\Models\slide;
use Spatie\Permission\Traits\HasRoles;

class SlideRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        Slide $model
    ) {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('collection')->get();
    }



}