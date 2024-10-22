<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_category_id',
        'value',
        'publish',
    ];

    public function attribute_category()
    {
        return $this->belongsTo(AttributeCategory::class);
    }
}
