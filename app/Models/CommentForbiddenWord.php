<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;

class CommentForbiddenWord extends Model
{
    use HasFactory, QueryScope;
    protected $fillable = [
        'word',
        'actions',
    ];

    protected $table = 'forbidden_words';
    protected $casts = [
        'actions' => 'array',
    ];

    const ACTION_DELETE = 'delete';
    const ACTION_BAN_USER = 'ban_user';
}
