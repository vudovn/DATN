<?php  
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Models\ProductVariant;

class ProductVariantRepository extends BaseRepository{
    
    protected $model;

    public function __construct(
        ProductVariant $model
    ){
        $this->model = $model;
    }

    public function findVariant($product_id, $code){
        return $this->model->where([
            ['product_id', $product_id],
            ['code', $code]
        ])->first();
    }




   
    


}