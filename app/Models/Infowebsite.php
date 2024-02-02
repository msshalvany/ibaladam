<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infowebsite extends Model
{
    use HasFactory;
    protected $fillable = [
        'rols',
        'keyWord',
        'telegram',
        'instagram',
        'suporter',
        'info',
    ];
}
