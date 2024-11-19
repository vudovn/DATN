<?php  
namespace App\Repositories\Category;
use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository{
    
    protected $model;

    public function __construct(
        Category $model
    ){
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function getAllPublish(){
        return $this->model->where('publish',1)->get();
    }

    public function getCategoryRoom(){
        return $this->model->where('publish',1)->where('is_room',1)->get();
    }

    public function getCategory(){
        return $this->model->where('publish',1)->where('is_room',2)->get();
    }

    public function searchCategory($keyword){
        return $this->model->where('name', 'like', '%' . $keyword . '%')->where('publish', 1)->get();
    }


}