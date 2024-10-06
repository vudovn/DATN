<?php  
namespace App\Repositories\Attribute;
use App\Repositories\BaseRepository;
use App\Models\AttributeValue;

class AttributeValueRepository extends BaseRepository{
    
    protected $model;

    public function __construct(
        AttributeValue $model
    ){
        $this->model = $model;
    }

    


}