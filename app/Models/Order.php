<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'user_id',
        'shipping_id',
        'total_amount',
        'status',
        'payment_methood'
    ];
    public function getWithPaginateBy($perPage = 10)
    {
        return $this->paginate($perPage);
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
}
