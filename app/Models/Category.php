<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;

class Category extends Model
{
    use HasFactory, QueryScope;
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'parent_id',
        'is_room',
        'publish',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_at',
        'updated_at'
    ];
    // protected $table = 'categories';
    // public function posts(){
    //     return $this->belongsToMany(Post::class);
    // }
    // public function categories(){
    //     return $this->belongsToMany(Category::class,'category_id');
    // }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}
