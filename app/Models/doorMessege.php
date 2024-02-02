<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doorMessege extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'door_id',
        'img',
        'time',
        'text',
    ];
}
