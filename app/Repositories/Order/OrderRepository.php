<?php  
namespace App\Repositories\Order;
use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository{
    
    protected $model;

    public function __construct(
        Order $model
    ){
        $this->model = $model;
    }

}