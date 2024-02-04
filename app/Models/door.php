<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class door extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'time',
        'status',
        'topic',
        'grops',
        'subgrops',
        'img',
        'city',
        'price',
        'pin',
        'sort',
        'count',
        'password',
        'password_status',
        'messegeBlock'
    ];
    protected $hidden = [
        'password',
    ];
}
