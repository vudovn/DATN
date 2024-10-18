<?php  
namespace App\Repositories\Attribute;
use App\Repositories\BaseRepository;
use App\Models\AttributeCategory;

class AttributeCategoryRepository extends BaseRepository{
    
    protected $model;

    public function __construct(
        AttributeCategory $model
    ){
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->all();
    }


   
    


}