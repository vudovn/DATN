<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;

class AttributeCategory extends Model
{
    use HasFactory, QueryScope;

    protected $fillable = [
        'name',
        'publish',
    ];

    protected $table = 'attribute_category'; 

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

}
