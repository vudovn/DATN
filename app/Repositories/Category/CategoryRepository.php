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

   
    


}