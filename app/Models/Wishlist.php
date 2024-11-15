<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\QueryScope;
use Spatie\Permission\Traits\HasRoles;

class Wishlist extends Model
{
    use HasFactory, Notifiable, QueryScope, HasRoles;

    protected $table = 'wishlists';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
