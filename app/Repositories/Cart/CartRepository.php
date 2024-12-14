<?php
namespace App\Repositories\Cart;
use App\Repositories\BaseRepository;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartRepository extends BaseRepository
{

    protected $model;

    public function __construct(
        Cart $model
    ) {
        $this->model = $model;
    }
    public function deleteCart($id)
    {
        $this->model->where('user_id', $id)->delete();
    }

    public function getCartCount($id)
    {
        return $this->model->where('user_id', $id)->count();
    }
}