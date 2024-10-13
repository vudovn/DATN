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

    public function searchValue($attribute_id, $value){
        return $this->model
            ->where('attribute_id', $attribute_id)
            ->where('value', 'like', '%' . $value . '%')
            ->get();
    }
    

    


}