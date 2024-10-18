<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public function province(){
        return $this->belongsTo(Province::class, 'province_id', 'code');
    }
    public function district(){
        return $this->belongsTo(Districts::class, 'district_id', 'code');
    }
    public function ward(){
        return $this->belongsTo(Wards::class, 'ward_id', 'code');
    }
}
