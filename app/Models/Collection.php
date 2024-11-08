<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;

class Collection extends Model
{
    use HasFactory,QueryScope;
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'publish',
        'meta_title',
        'meta_description',
        'created_at'
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'collection_product', 'collection_id', 'product_id');
    }
}
