<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'category_id',
        'validity',
        'premium',
        'price',
        'title',
        'region',
        'city',
        'content',
        'gallery',
    ];
}
