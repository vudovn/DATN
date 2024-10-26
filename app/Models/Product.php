<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;
class Product extends Model
{
    use HasFactory, QueryScope;

    protected $fillable = [
        'sku', 'name', 'slug', 'description', 'quantity', 'price', 
        'discount', 'thumbnail', 'albums', 'publish', 'is_featured', 
        'deleted_at', 'created_at', 'updated_at'
    ];
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_product', 'product_id', 'collection_id');
    }
}
