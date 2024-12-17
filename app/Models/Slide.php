<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $fillable = [
        'collection_id',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

}

