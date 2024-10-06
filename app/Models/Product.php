<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;
class Product extends Model
{
    use HasFactory, QueryScope;

    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'quantity',
        'price',
        'discount',
        'thumbnail',
        'albums',
        'publish',
        'is_featured',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
